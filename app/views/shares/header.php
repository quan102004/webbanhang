 <!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý sản phẩm</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- SweetAlert2 -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="/webbanhang/public/css/custom.css" rel="stylesheet">    <style>
        :root {
            --primary-color: #3a5f8a;
            --primary-hover: #2c4b6e;
            --secondary-color: #f0ae2c;
            --secondary-hover: #dea017;
            --accent-color: #e55934;
            --light-color: #f8f9fa;
            --dark-color: #2c3e50;
            --text-color: #333;
            --border-radius: 0.5rem;
            --box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.08);
            --transition: all 0.3s ease;
        }

        body {
            font-family: 'Roboto', 'Segoe UI', sans-serif;
            background-color: #f8f9fa;
            color: var(--text-color);
            line-height: 1.6;
        }

        .navbar-brand {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--primary-color);
            letter-spacing: 0.5px;
        }

        .navbar-custom {
            background-color: #fff;
            box-shadow: var(--box-shadow);
            padding: 0.8rem 1rem;
        }

        .nav-link {
            font-family: 'Poppins', sans-serif;
            color: var(--dark-color);
            font-weight: 500;
            padding: 0.5rem 1rem;
            transition: var(--transition);
            border-radius: var(--border-radius);
            margin: 0 3px;
        }

        .nav-link:hover,
        .nav-link.active {
            background-color: var(--primary-color);
            color: white;
        }

        .nav-icon {
            margin-right: 5px;
        }

        .btn-custom-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .btn-custom-primary:hover {
            background-color: #2980b9;
            border-color: #2980b9;
            color: white;
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .dropdown-item {
            padding: 0.7rem 1.2rem;
            font-weight: 500;
        }

        .dropdown-item:hover {
            background-color: #f1f5f9;
        }
    </style>
</head>

<body><nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">            <a class="navbar-brand" href="/webbanhang/">
                <img src="/webbanhang/uploads/laptop.jpg" alt="Logo" width="40" height="40" class="d-inline-block align-text-top me-2 rounded">
                <span>Quản lý sản phẩm</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">                    <li class="nav-item">
                        <a class="nav-link" href="/webbanhang/">
                            <i class="fas fa-home me-2"></i>Trang chủ
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/webbanhang/Product/list">
                            <i class="fas fa-box me-2"></i>Sản phẩm
                        </a>
                    </li>                    <li class="nav-item">
                        <a class="nav-link" href="/webbanhang/Product/add">
                            <i class="fas fa-plus-circle me-2"></i>Thêm sản phẩm
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/webbanhang/Product/cart">
                            <i class="fas fa-shopping-cart me-2"></i>Giỏ hàng
                            <span id="cart-count" class="badge rounded-pill bg-danger" style="display: none;">0</span>
                        </a>
                    </li><li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-th-large me-2"></i>Danh mục
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="/webbanhang/Category/index"><i class="fas fa-folder me-2"></i>Xem danh mục</a></li>
                            <li><a class="dropdown-item" href="/webbanhang/Category/add"><i class="fas fa-folder-plus me-2"></i>Thêm danh mục</a></li>
                        </ul>
                    </li>
                    
                    <?php if (SessionHelper::isLoggedIn()): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-circle me-2"></i><?php echo htmlspecialchars($_SESSION['username']); ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                            <li><span class="dropdown-item-text text-muted small"><i class="fas fa-user-tag me-2"></i><?php echo SessionHelper::getRole(); ?></span></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="/webbanhang/account/logout"><i class="fas fa-sign-out-alt me-2"></i>Đăng xuất</a></li>
                        </ul>
                    </li>
                    <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/webbanhang/account/login">
                            <i class="fas fa-sign-in-alt me-2"></i>Đăng nhập
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page header with breadcrumb -->
    <div class="bg-light py-3 mb-4 border-bottom shadow-sm">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="/webbanhang/" class="text-decoration-none"><i class="fas fa-home"></i></a></li>
                    <?php
                    $uri_parts = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
                    if (count($uri_parts) > 1) {
                        $controller = ucfirst($uri_parts[1]);
                        echo '<li class="breadcrumb-item"><a href="/webbanhang/' . $controller . '" class="text-decoration-none">' . $controller . '</a></li>';
                        
                        if (count($uri_parts) > 2) {
                            $action = $uri_parts[2];
                            echo '<li class="breadcrumb-item active" aria-current="page">' . ucfirst($action) . '</li>';
                        }
                    }
                    ?>
                </ol>
            </nav>
        </div>
    </div>
<script>
     function logout() { 
        localStorage.removeItem('jwtToken'); 
        location.href = '/webbanhang/account/login'; 
    } 
 
    document.addEventListener("DOMContentLoaded", function() { 
        const token = localStorage.getItem('jwtToken'); 
        if (token) { 
            document.getElementById('nav-login').style.display = 'none'; 
            document.getElementById('nav-logout').style.display = 'block'; 
        } else { 
            document.getElementById('nav-login').style.display = 'block'; 
            document.getElementById('nav-logout').style.display = 'none'; 
        } 
    }); 
</script>