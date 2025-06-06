<?php include 'app/views/shares/header.php'; ?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white text-center">
                    <h3 class="mb-0">Đăng ký tài khoản</h3>
                </div>
                <div class="card-body p-4">
                    <?php if (isset($errors)): ?>
                    <div class="alert alert-danger" role="alert">
                        <ul class="mb-0">
                            <?php foreach ($errors as $err): ?>
                            <li><?php echo $err; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php endif; ?>

                    <form class="user needs-validation" action="/webbanhang/account/save" method="post" novalidate>
                        <div class="row mb-3">
                            <div class="col-sm-6">
                                <div class="form-floating mb-3 mb-sm-0">
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Tên đăng nhập" required>
                                    <label for="username">Tên đăng nhập</label>
                                    <div class="invalid-feedback">Vui lòng nhập tên đăng nhập</div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Họ và tên" required>
                                    <label for="fullname">Họ và tên</label>
                                    <div class="invalid-feedback">Vui lòng nhập họ và tên</div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-sm-6">
                                <div class="form-floating mb-3 mb-sm-0">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Mật khẩu" minlength="6" required>
                                    <label for="password">Mật khẩu</label>
                                    <div class="invalid-feedback">Mật khẩu phải có ít nhất 6 ký tự</div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-floating">
                                    <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Xác nhận mật khẩu" required>
                                    <label for="confirmpassword">Xác nhận mật khẩu</label>
                                    <div class="invalid-feedback">Mật khẩu xác nhận không khớp</div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-lg px-5 py-2">
                                <i class="fas fa-user-plus me-2"></i>Đăng ký
                            </button>
                        </div>
                        <hr>
                        <div class="text-center">
                            <p>Đã có tài khoản? <a href="/webbanhang/account/login" class="text-primary fw-bold">Đăng nhập ngay</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Xác thực form
    (function() {
        'use strict';
        var forms = document.querySelectorAll('.needs-validation');
        Array.prototype.slice.call(forms).forEach(function(form) {
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                
                // Kiểm tra mật khẩu xác nhận
                var password = document.getElementById('password');
                var confirm = document.getElementById('confirmpassword');
                
                if (password.value !== confirm.value) {
                    confirm.setCustomValidity('Mật khẩu xác nhận không khớp');
                    event.preventDefault();
                    event.stopPropagation();
                } else {
                    confirm.setCustomValidity('');
                }
                
                form.classList.add('was-validated');
            }, false);
        });
    })();
</script>
<?php include 'app/views/shares/footer.php'; ?>