<?php include 'app/views/shares/header.php'; ?>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title mb-0">
                        <i class="fas fa-plus-circle me-2"></i>Thêm sản phẩm mới
                    </h3>
                </div>
                <div class="card-body p-4">
                    <form id="add-product-form">
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
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-save me-2"></i>Lưu sản phẩm
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
    // Hiển thị loading spinner cho select
    const categorySelect = document.getElementById('category_id');
    categorySelect.innerHTML = '<option value="" disabled selected>Đang tải danh mục...</option>';
    
    // Tải danh sách danh mục
    fetch('/webbanhang/api/category')
        .then(response => response.json())
        .then(data => {
            // Xóa loading option
            categorySelect.innerHTML = '<option value="" disabled selected>Chọn danh mục</option>';
            
            // Thêm các danh mục
            data.forEach(category => {
                const option = document.createElement('option');
                option.value = category.id;
                option.textContent = category.name;
                categorySelect.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Lỗi khi tải danh mục:', error);
            categorySelect.innerHTML = '<option value="" disabled selected>Lỗi tải danh mục</option>';
        });

    // Xử lý form submit với validation
    const form = document.getElementById('add-product-form');
    
    form.addEventListener('submit', function (event) {
        event.preventDefault();
        
        // Basic validation
        const name = document.getElementById('name').value.trim();
        const description = document.getElementById('description').value.trim();
        const price = document.getElementById('price').value;
        const categoryId = categorySelect.value;
        
        // Reset validation styles
        form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
        
        let isValid = true;
        
        // Validate name
        if (name === '') {
            document.getElementById('name').classList.add('is-invalid');
            isValid = false;
        }
        
        // Validate description
        if (description === '') {
            document.getElementById('description').classList.add('is-invalid');
            isValid = false;
        }
        
        // Validate price
        if (price === '' || isNaN(price) || parseFloat(price) < 0) {
            document.getElementById('price').classList.add('is-invalid');
            isValid = false;
        }
        
        // Validate category
        if (categoryId === '' || categoryId === null) {
            categorySelect.classList.add('is-invalid');
            isValid = false;
        }
        
        if (!isValid) {
            return;
        }
        
        // Disable button and show loading state
        const submitBtn = form.querySelector('button[type="submit"]');
        const originalBtnText = submitBtn.innerHTML;
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Đang xử lý...';
        
        // Collect form data
        const formData = new FormData(this);
        const jsonData = {};
        formData.forEach((value, key) => {
            jsonData[key] = value;
        });

        // Send data to API
        fetch('/webbanhang/api/product', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(jsonData)
        })
        .then(response => response.json())
        .then(data => {
            console.log('Response:', data);
            if (data.message === 'Product created successfully') {
                // Show success notification
                Swal.fire({
                    icon: 'success',
                    title: 'Thành công!',
                    text: 'Sản phẩm đã được thêm thành công',
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
                    text: 'Không thể thêm sản phẩm. Vui lòng kiểm tra lại thông tin.',
                    confirmButtonColor: '#3085d6'
                });
                
                // Reset button
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalBtnText;
            }
        })
        .catch(error => {
            console.error('Lỗi khi gửi dữ liệu:', error);
            
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
