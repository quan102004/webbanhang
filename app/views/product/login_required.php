<?php include 'app/views/shares/header.php'; ?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 text-center">
            <div class="card shadow-sm border-0">
                <div class="card-body p-5">
                    <div class="mb-4">
                        <i class="fas fa-user-lock text-primary" style="font-size: 4rem;"></i>
                    </div>
                    <h2 class="fw-bold mb-3">Yêu cầu đăng nhập</h2>
                    <p class="text-muted mb-4">Bạn cần đăng nhập để xem thông tin chi tiết sản phẩm và thực hiện các thao tác mua hàng.</p>
                    <div class="d-grid gap-2">
                        <a href="/webbanhang/account/login" class="btn btn-primary">
                            <i class="fas fa-sign-in-alt me-2"></i> Đăng nhập ngay
                        </a>
                        <a href="/webbanhang/account/register" class="btn btn-outline-secondary">
                            <i class="fas fa-user-plus me-2"></i> Đăng ký tài khoản mới
                        </a>
                        <a href="/webbanhang" class="btn btn-link">
                            <i class="fas fa-home me-2"></i> Về trang chủ
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    Swal.fire({
        title: 'Yêu cầu đăng nhập',
        text: 'Bạn cần đăng nhập để xem thông tin chi tiết sản phẩm',
        icon: 'info',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Đã hiểu'
    });
});
</script>

<?php include 'app/views/shares/footer.php'; ?>
