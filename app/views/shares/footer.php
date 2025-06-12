</div> <!-- Đóng container từ header -->

<footer class="mt-5 pt-4 pb-3 bg-dark text-white">
    <div class="container">
        <div class="row g-4">
            <!-- Thông tin hệ thống -->
            <div class="col-md-4">
                <h5 class="mb-3 fw-bold">Hệ thống quản lý sản phẩm</h5>
                <p class="mb-3">Giải pháp quản lý sản phẩm chuyên nghiệp, dễ dàng và hiệu quả cho doanh nghiệp của bạn.
                </p>
                <p class="mb-0">
                    <small class="text-muted">© 2025 Quản lý sản phẩm. All rights reserved.</small>
                </p>
            </div>

            <!-- Liên kết nhanh -->
            <div class="col-md-4">
                <h5 class="mb-3 fw-bold">Liên kết nhanh</h5>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="/webbanhang/Product/index" class="text-decoration-none text-light">
                            <i class="fas fa-chevron-right me-1 small"></i> Danh sách sản phẩm
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="/webbanhang/Product/add" class="text-decoration-none text-light">
                            <i class="fas fa-chevron-right me-1 small"></i> Thêm sản phẩm mới
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="/webbanhang/Category/index" class="text-decoration-none text-light">
                            <i class="fas fa-chevron-right me-1 small"></i> Quản lý danh mục
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Liên hệ -->
            <div class="col-md-4">
                <h5 class="mb-3 fw-bold">Liên hệ</h5>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <i class="fas fa-map-marker-alt me-2"></i> 
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-phone me-2"></i> 
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-envelope me-2"></i> i
                    </li>
                </ul>
                <!-- Social Media Icons -->
                <div class="mt-3">
                    <a href="#" class="text-white me-3"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-white me-3"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Custom JS -->
<script>
// Global theme for SweetAlert2
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true
});

// Cập nhật số lượng sản phẩm trong giỏ hàng khi trang được tải
document.addEventListener("DOMContentLoaded", function() {
    // Hàm cập nhật số lượng sản phẩm trong giỏ hàng
    function updateCartCount() {
        fetch('/webbanhang/Product/getCartCount')
            .then(response => response.json())
            .then(data => {
                const cartCountElement = document.getElementById('cart-count');
                if (cartCountElement) {
                    cartCountElement.textContent = data.count;
                    cartCountElement.style.display = data.count > 0 ? 'inline-block' : 'none';
                }
            })
            .catch(error => console.error('Lỗi khi cập nhật giỏ hàng:', error));
    }
    
    // Cập nhật giỏ hàng khi trang được tải
    updateCartCount();
});
</script>
</body>

</html>