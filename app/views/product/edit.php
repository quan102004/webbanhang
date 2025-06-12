<?php include 'app/views/shares/header.php'; ?>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-warning text-dark">
                    <h3 class="card-title mb-0">
                        <i class="fas fa-edit me-2"></i>Chỉnh sửa sản phẩm
                    </h3>
                </div>
                <div class="card-body p-4">
                    <div id="loading-indicator" class="text-center py-5">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Đang tải...</span>
                        </div>
                        <p class="mt-2">Đang tải thông tin sản phẩm...</p>
                    </div>

                    <form id="edit-product-form" style="display: none;">
                        <input type="hidden" id="id" name="id">

                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <input type="text" id="name" name="name" class="form-control" placeholder="Tên sản phẩm" required>
                                    <label for="name">Tên sản phẩm</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <textarea id="description" name="description" class="form-control" placeholder="Mô tả sản phẩm" style="height: 120px" required></textarea>
                                    <label for="description">Mô tả sản phẩm</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="number" id="price" name="price" class="form-control" step="1" min="0" placeholder="Giá sản phẩm" required>
                                    <label for="price">Giá (VND)</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <select id="category_id" name="category_id" class="form-select" required>
                                        <option value="" disabled selected>Chọn danh mục</option>
                                        <!-- Các danh mục sẽ được tải từ API và hiển thị tại đây -->
                                    </select>
                                    <label for="category_id">Danh mục sản phẩm</label>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="/webbanhang/Product/list" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Quay lại
                            </a>
                            <button type="submit" class="btn btn-warning px-4">
                                <i class="fas fa-save me-2"></i>Lưu thay đổi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const productId = <?= $id ?>;
    const loadingIndicator = document.getElementById('loading-indicator');
    const editForm = document.getElementById('edit-product-form');
    const categorySelect = document.getElementById('category_id');

    // Tải thông tin sản phẩm hiện tại
    fetchProductAndCategories(productId);

    function fetchProductAndCategories(id) {
        // Gọi API lấy thông tin sản phẩm
        fetch(`/webbanhang/api/product/${id}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Không thể tải thông tin sản phẩm');
                }
                return response.json();
            })
            .then(product => {
                // Gọi API lấy danh sách danh mục
                return Promise.all([
                    Promise.resolve(product),
                    fetch('/webbanhang/api/category').then(res => res.json())
                ]);
            })
            .then(([product, categories]) => {
                // Điền thông tin sản phẩm vào form
                document.getElementById('id').value = product.id;
                document.getElementById('name').value = product.name;
                document.getElementById('description').value = product.description;
                document.getElementById('price').value = product.price;

                // Xây dựng danh sách danh mục
                categorySelect.innerHTML = '';
                categories.forEach(category => {
                    const option = document.createElement('option');
                    option.value = category.id;
                    option.textContent = category.name;
                    
                    // Chọn danh mục hiện tại của sản phẩm
                    if (parseInt(category.id) === parseInt(product.category_id)) {
                        option.selected = true;
                    }
                    
                    categorySelect.appendChild(option);
                });

                // Ẩn loading, hiển thị form
                loadingIndicator.style.display = 'none';
                editForm.style.display = 'block';
            })
            .catch(error => {
                console.error('Lỗi:', error);
                
                // Hiển thị thông báo lỗi thay vì loading
                loadingIndicator.innerHTML = `
                    <div class="text-danger">
                        <i class="fas fa-exclamation-circle fa-3x mb-3"></i>
                        <h5>Không thể tải thông tin sản phẩm</h5>
                        <p>${error.message}</p>
                        <a href="/webbanhang/Product/list" class="btn btn-outline-secondary mt-3">
                            <i class="fas fa-arrow-left me-2"></i>Quay lại danh sách
                        </a>
                    </div>
                `;
            });
    }

    // Xử lý submit form
    editForm.addEventListener('submit', function (event) {
        event.preventDefault();
        
        // Basic validation
        const name = document.getElementById('name').value.trim();
        const description = document.getElementById('description').value.trim();
        const price = document.getElementById('price').value;
        
        // Reset validation styles
        editForm.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
        
        let isValid = true;
        
        // Validate fields
        if (name === '') {
            document.getElementById('name').classList.add('is-invalid');
            isValid = false;
        }
        
        if (description === '') {
            document.getElementById('description').classList.add('is-invalid');
            isValid = false;
        }
        
        if (price === '' || isNaN(price) || parseFloat(price) < 0) {
            document.getElementById('price').classList.add('is-invalid');
            isValid = false;
        }
        
        if (!isValid) {
            return;
        }

        // Disable button and show loading state
        const submitBtn = editForm.querySelector('button[type="submit"]');
        const originalBtnText = submitBtn.innerHTML;
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Đang cập nhật...';

        // Collect form data
        const formData = new FormData(this);
        const jsonData = {};
        formData.forEach((value, key) => {
            jsonData[key] = value;
        });

        fetch(`/webbanhang/api/product/${jsonData.id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(jsonData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.message === 'Product updated successfully') {
                // Show success notification
                Swal.fire({
                    icon: 'success',
                    title: 'Thành công!',
                    text: 'Sản phẩm đã được cập nhật thành công',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    location.href = '/webbanhang/Product/list';
                });
            } else {
                // Show error notification
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi!',
                    text: 'Không thể cập nhật sản phẩm. Vui lòng thử lại.',
                    confirmButtonColor: '#3085d6'
                });
                
                // Reset button
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalBtnText;
            }
        })
        .catch(error => {
            console.error('Lỗi khi cập nhật:', error);
            
            // Show error notification
            Swal.fire({
                icon: 'error',
                title: 'Lỗi!',
                text: 'Đã xảy ra lỗi khi xử lý yêu cầu. Vui lòng thử lại sau.',
                confirmButtonColor: '#3085d6'
            });
            
            // Reset button
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalBtnText;
        });
    });
});
</script>
