<?php 
require_once('app/helpers/SessionHelper.php');
include 'app/views/shares/header.php'; 
?>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="display-5 fw-bold text-primary"><i class="fas fa-boxes me-2"></i>Danh sách sản phẩm</h1>
        <a href="/webbanhang/Product/add" class="btn btn-success d-flex align-items-center">
            <i class="fas fa-plus-circle me-2"></i>Thêm sản phẩm mới
        </a>
    </div>

    <div class="row mb-4">
        <div class="col-md-6 col-lg-4">
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0"><i class="fas fa-search text-muted"></i></span>
                <input type="text" id="product-search" class="form-control border-start-0"
                    placeholder="Tìm kiếm sản phẩm...">
            </div>
        </div>
    </div>

    <div class="row" id="product-container">
        <!-- Danh sách sản phẩm sẽ được tải từ API và hiển thị tại đây -->
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>

<script>
document.addEventListener("DOMContentLoaded", function () {    const token = localStorage.getItem('jwtToken');
    if (!token) {
        Swal.fire({
            title: 'Yêu cầu đăng nhập',
            text: 'Vui lòng đăng nhập để xem danh sách sản phẩm',
            icon: 'info',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Đăng nhập ngay'
        }).then((result) => {
            window.location.href = '/webbanhang/account/login'; 
        });
        return;
    }
    
    fetch('/webbanhang/api/product', {        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + token
        }
    })
    .then(response => {        if (!response.ok) {
            if (response.status === 401) {
                localStorage.removeItem('jwtToken'); // Xóa token không hợp lệ
                Swal.fire({
                    title: 'Phiên đăng nhập hết hạn',
                    text: 'Vui lòng đăng nhập lại để tiếp tục',
                    icon: 'warning',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Đăng nhập lại'
                }).then(() => {
                    window.location.href = '/webbanhang/account/login';
                });
                throw new Error('Unauthorized');
            }
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        console.log('API response:', data);
        // Gọi hàm renderProducts để hiển thị sản phẩm
        renderProducts(data);
    })
    .catch(error => {        console.error('Fetch Product Error:', error);
        // Unauthorized error is handled in the previous .then by redirecting.
        // This catch will handle other network errors or issues with response.json() if not 401.
        if (error.message !== 'Unauthorized') {
            Swal.fire({
                title: 'Lỗi',
                text: 'Không thể tải danh sách sản phẩm. Vui lòng thử lại.',
                icon: 'error'
            });
            const productContainer = document.getElementById('product-container');
            if (productContainer) {
                productContainer.innerHTML = `<div class="col-12 text-center"><p class="text-danger">Lỗi tải dữ liệu sản phẩm.</p></div>`;
            }
        }
    });
});

function renderProducts(products) {    console.log('Starting renderProducts with:', products);
    const productContainer = document.getElementById('product-container');
    console.log('Product container element:', productContainer);
    productContainer.innerHTML = '';
    
    if (!Array.isArray(products) || products.length === 0) {        console.log('No products or invalid data format');
        productContainer.innerHTML = `
            <div class="col-12 text-center py-5">
                <div class="text-muted">
                    <i class="fas fa-search fa-3x mb-3"></i>
                    <h4>Không tìm thấy sản phẩm</h4>
                    <p>Vui lòng thử lại sau</p>
                </div>
            </div>
        `;
        return;
    }

    products.forEach(product => {
            const productCol = document.createElement('div');
            productCol.className = 'col-md-6 col-lg-4 mb-4';

            // Format price with commas
            const formattedPrice = new Intl.NumberFormat('vi-VN').format(product.price);

            // Truncate description if too long
            const shortDesc = product.description.length > 80 ?
                product.description.substring(0, 80) + '...' : product.description;

            productCol.innerHTML = `
                <div class="card product-card h-100 shadow-sm border">
                    <div class="card-header bg-white border-bottom-0 pt-3 pb-0">
                        <span class="badge bg-info float-end">${product.category_name}</span>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="/webbanhang/Product/show/${product.id}" class="text-decoration-none text-dark">${product.name}</a>
                        </h5>
                        <p class="card-text text-muted small">${shortDesc}</p>
                        <h4 class="text-primary fw-bold">${formattedPrice} VND</h4>
                    </div>                    <div class="card-footer bg-white border-top-0">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <button class="btn btn-primary w-100" onclick="addToCart(${product.id})">
                                <i class="fas fa-cart-plus me-1"></i> Thêm vào giỏ
                            </button>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="/webbanhang/Product/edit/${product.id}" class="btn btn-outline-warning btn-sm">
                                <i class="fas fa-edit me-1"></i> Sửa
                            </a>
                            <button class="btn btn-outline-danger btn-sm" onclick="deleteProduct(${product.id})">
                                <i class="fas fa-trash-alt me-1"></i> Xóa
                            </button>
                        </div>
                    </div>
                </div>
            `;            productContainer.appendChild(productCol);
        });
}

    function deleteProduct(id) {
        Swal.fire({
            title: 'Xác nhận xóa?',
            text: 'Bạn có chắc chắn muốn xóa sản phẩm này?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e74c3c',
            cancelButtonColor: '#7f8c8d',
            confirmButtonText: 'Xóa',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/webbanhang/api/product/${id}`, {
                    method: 'DELETE'
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.message === 'Product deleted successfully') {
                            Swal.fire({
                                title: 'Đã xóa!',
                                text: 'Sản phẩm đã được xóa thành công',
                                icon: 'success',
                                timer: 1500,
                                showConfirmButton: false
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                title: 'Lỗi!',
                                text: 'Xóa sản phẩm thất bại',
                                icon: 'error'
                            });
                        }
                    });
            }
        });
    }

    function addToCart(id) {
        // Hiệu ứng nút khi được click
        const button = event.currentTarget;
        const originalText = button.innerHTML;
        button.disabled = true;
        button.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Đang thêm...';

        // Gửi yêu cầu thêm sản phẩm vào giỏ hàng
        fetch(`/webbanhang/Product/addToCart/${id}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            }
        })
            .then(response => {
                // Kiểm tra nếu chuyển hướng đến trang đăng nhập (status 302)
                if (response.redirected && response.url.includes('login')) {
                    window.location.href = response.url;
                    return;
                }

                if (response.ok) {
                    // Hiển thị thông báo thành công
                    Swal.fire({
                        title: 'Đã thêm vào giỏ hàng!',
                        text: 'Sản phẩm đã được thêm vào giỏ hàng',
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false
                    });

                    // Hiển thị mini cart dropdown hoặc cập nhật số lượng sản phẩm trong giỏ hàng
                    updateCartCount();
                } else {
                    throw new Error('Không thể thêm sản phẩm vào giỏ hàng');
                }
            })
            .catch(error => {
                console.error('Lỗi:', error);
                Swal.fire({
                    title: 'Lỗi!',
                    text: 'Không thể thêm sản phẩm vào giỏ hàng',
                    icon: 'error'
                });
            })
            .finally(() => {
                // Khôi phục trạng thái nút
                button.disabled = false;
                button.innerHTML = originalText;
            });
    }

    // Hàm cập nhật số lượng sản phẩm trong giỏ hàng trên thanh điều hướng    function updateCartCount() {
        fetch('/webbanhang/Product/getCartCount')
            .then(response => response.json())
            .then(data => {
                const cartCountElement = document.getElementById('cart-count');
                if (cartCountElement) {
                    cartCountElement.textContent = data.count;
                    cartCountElement.style.display = data.count > 0 ? 'inline-block' : 'none';
                } else {
                    console.log('Cart count element not found');
                }
            })
            .catch(error => console.error('Lỗi khi cập nhật giỏ hàng:', error));
    }
    
</script>