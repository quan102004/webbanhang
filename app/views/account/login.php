<?php include 'app/views/shares/header.php'; ?>

<div class="container py-5">
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card shadow-lg border-0" style="border-radius: 1rem;">
                <div class="card-body p-5">
                    <form action="/webbanhang/account/checklogin" method="post" class="needs-validation" novalidate>
                        <div class="text-center mb-4">
                            <h2 class="fw-bold mb-2">Đăng nhập</h2>
                            <p class="text-muted">Đăng nhập để truy cập vào tài khoản của bạn tại Võ Hoàng Quân Store
                            </p>

                            <?php if (isset($error)): ?>
                                <div class="alert alert-danger" role="alert">
                                    <i class="fas fa-exclamation-circle me-2"></i><?php echo $error; ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="form-floating mb-4">
                            <input type="text" name="username" id="username" class="form-control form-control-lg"
                                required />
                            <label for="username">Tên đăng nhập</label>
                            <div class="invalid-feedback">Vui lòng nhập tên đăng nhập</div>
                        </div>

                        <div class="form-floating mb-4">
                            <input type="password" name="password" id="password" class="form-control form-control-lg"
                                required />
                            <label for="password">Mật khẩu</label>
                            <div class="invalid-feedback">Vui lòng nhập mật khẩu</div>
                        </div>

                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" value="" id="remember-me"
                                name="remember-me">
                            <label class="form-check-label" for="remember-me">
                                Ghi nhớ đăng nhập
                            </label>
                        </div>

                        <div class="text-center">
                            <button class="btn btn-primary btn-lg w-100 mb-4" type="submit">
                                <i class="fas fa-sign-in-alt me-2"></i>Đăng nhập
                            </button>

                            <p class="text-center mb-4">
                                <a href="/webbanhang/account/forgotpassword" class="text-primary">Quên mật khẩu?</a>
                            </p>

                            <div class="d-flex justify-content-center mb-4">
                                <a href="#!" class="btn btn-outline-primary mx-2">
                                    <i class="fab fa-facebook-f me-2"></i>Facebook
                                </a>
                                <a href="#!" class="btn btn-outline-danger mx-2">
                                    <i class="fab fa-google me-2"></i>Google
                                </a>
                            </div>

                            <hr>

                            <p class="mb-0">Chưa có tài khoản?
                                <a href="/webbanhang/account/register" class="text-primary fw-bold">Đăng ký ngay</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Xác thực form
    document.getElementById('login-form').addEventListener('submit', function (event) {
        event.preventDefault();
        const formData = new FormData(this);
        const jsonData = {};
        formData.forEach((value, key) => {
            jsonData[key] = value;
        });
        fetch('/webbanhang/account/checkLogin', {
            method: 'POST',
            headers: {
            },
            body: JSON.stringify(jsonData)
        })
            .then(response => response.json())
            .then(data => {
                if (data.token) {
                    localStorage.setItem('jwtToken', data.token);
                    location.href = '/webbanhang/Product';
                } else {
                }
            });
        'Content-Type': 'application/json'
        alert('Đăng nhập thất bại');
    }); 
</script>
<?php include 'app/views/shares/footer.php'; ?>