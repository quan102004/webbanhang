<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý sản phẩm</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2ecc71;
            --dark-color: #34495e;
            --light-color: #ecf0f1;
            --danger-color: #e74c3c;
            --warning-color: #f39c12;
        }

        body {
            font-family: 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--dark-color);
        }

        .navbar-custom {
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 0.8rem 1rem;
        }

        .nav-link {
            color: var(--dark-color);
            font-weight: 500;
            padding: 0.5rem 1rem;
            transition: all 0.3s ease;
            border-radius: 5px;
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

<body>
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="/webbanhang/">
                <i class="fas fa-box-open me-2"></i>Quản lý sản phẩm
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="/webbanhang/Product/index">
                            <i class="fas fa-list nav-icon"></i>Danh sách sản phẩm
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/webbanhang/Product/add">
                            <i class="fas fa-plus-circle nav-icon"></i>Thêm sản phẩm
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-th-large nav-icon"></i>Danh mục
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="/webbanhang/Category/index">Xem danh mục</a></li>
                            <li><a class="dropdown-item" href="/webbanhang/Category/add">Thêm danh mục</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">