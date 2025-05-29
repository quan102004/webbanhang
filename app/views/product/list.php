<?php include 'app/views/shares/header.php'; ?>

<style>
    body {
        background-color: #f8f9fa;
    }
    .container-list {
        max-width: 900px;
        margin: 40px auto;
        padding: 20px 30px;
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgb(0 0 0 / 0.1);
    }
    h1 {
        font-weight: 700;
        color: #343a40;
        margin-bottom: 20px;
        text-align: center;
    }
    .btn-success {
        display: block;
        width: 200px;
        margin: 0 auto 30px auto;
        font-weight: 600;
        font-size: 18px;
        border-radius: 8px;
        padding: 10px;
    }
    .list-group-item {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 20px;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 15px;
        box-shadow: 0 2px 8px rgb(0 0 0 / 0.05);
        background-color: #fff;
        transition: box-shadow 0.3s ease;
    }
    .list-group-item:hover {
        box-shadow: 0 6px 20px rgb(0 0 0 / 0.15);
    }
    .product-image {
        flex: 0 0 100px;
        max-width: 100px;
        border-radius: 8px;
        object-fit: cover;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    .product-info {
        flex: 1 1 auto;
        min-width: 300px;
    }
    .product-info h2 {
        margin: 0 0 10px 0;
        font-size: 22px;
    }
    .product-info h2 a {
        color: #007bff;
        text-decoration: none;
    }
    .product-info h2 a:hover {
        text-decoration: underline;
    }
    .product-info p {
        margin: 4px 0;
        color: #555;
        font-size: 15px;
    }
    .product-actions {
        flex: 0 0 auto;
        display: flex;
        flex-direction: column;
        gap: 10px;
        min-width: 110px;
    }
    .btn-warning, .btn-danger {
        font-weight: 600;
        border-radius: 8px;
        padding: 8px;
        font-size: 14px;
        width: 100%;
        text-align: center;
    }
</style>

<div class="container-list">
    <h1>Danh sách sản phẩm</h1>
    <a href="/webbanhang/Product/add" class="btn btn-success">Thêm sản phẩm mới</a>
    <ul class="list-group">
        <?php foreach ($products as $product): ?>
            <li class="list-group-item">
                <?php if ($product->image): ?>
                    <img src="/webbanhang/<?php echo htmlspecialchars($product->image, ENT_QUOTES, 'UTF-8'); ?>" alt="Product Image" class="product-image">
                <?php else: ?>
                    <div style="width:100px; height:100px; background:#eee; border-radius:8px;"></div>
                <?php endif; ?>
                <div class="product-info">
                    <h2><a href="/webbanhang/Product/show/<?php echo $product->id; ?>"><?php
                       echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?></a></h2>
                    <p><?php echo htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8'); ?></p>
                    <p><strong>Giá:</strong> <?php echo number_format($product->price, 0, ',', '.'); ?> VND</p>
                    <p><strong>Danh mục:</strong> <?php echo htmlspecialchars($product->category_name, ENT_QUOTES, 'UTF-8'); ?></p>
                </div>
                <div class="product-actions">
                    <a href="/webbanhang/Product/edit/<?php echo $product->id; ?>" class="btn btn-warning">Sửa</a>
                    <a href="/webbanhang/Product/delete/<?php echo $product->id; ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">Xóa</a>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<?php include 'app/views/shares/footer.php'; ?>
