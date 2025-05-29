<?php include 'app/views/shares/header.php'; ?>

<style>
    body {
        background-color: #f8f9fa;
    }
    .container-form {
        max-width: 700px;
        margin: 40px auto;
        padding: 30px 40px;
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgb(0 0 0 / 0.1);
    }
    h1 {
        margin-bottom: 30px;
        font-weight: 700;
        color: #343a40;
        text-align: center;
    }
    .form-group label {
        font-weight: 600;
        color: #495057;
    }
    .btn-primary {
        width: 100%;
        font-weight: 600;
        padding: 12px;
        font-size: 18px;
        border-radius: 8px;
    }
    .btn-secondary {
        display: block;
        margin: 20px auto 0 auto;
        width: 200px;
        text-align: center;
        border-radius: 8px;
    }
    .alert-danger {
        max-width: 700px;
        margin: 20px auto;
        border-radius: 10px;
        font-size: 15px;
        font-weight: 500;
    }
    img.product-image {
        max-width: 100px;
        margin-top: 10px;
        border-radius: 6px;
        box-shadow: 0 0 6px rgba(0,0,0,0.1);
        display: block;
    }
</style>

<div class="container-form">
    <h1>Sửa sản phẩm</h1>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger" role="alert">
            <ul class="mb-0">
                <?php foreach ($errors as $error): ?>
                    <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" action="/webbanhang/Product/update" enctype="multipart/form-data" onsubmit="return validateForm();">
        <input type="hidden" name="id" value="<?php echo $product->id; ?>">

        <div class="form-group mb-3">
            <label for="name">Tên sản phẩm:</label>
            <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>" required>
        </div>

        <div class="form-group mb-3">
            <label for="description">Mô tả:</label>
            <textarea id="description" name="description" class="form-control" rows="4" required><?php echo htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8'); ?></textarea>
        </div>

        <div class="form-group mb-3">
            <label for="price">Giá:</label>
            <input type="number" id="price" name="price" class="form-control" step="0.01" min="0" value="<?php echo htmlspecialchars($product->price, ENT_QUOTES, 'UTF-8'); ?>" required>
        </div>

        <div class="form-group mb-3">
            <label for="category_id">Danh mục:</label>
            <select id="category_id" name="category_id" class="form-control" required>
                <option value="" disabled>-- Chọn danh mục --</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?php echo $category->id; ?>" <?php echo $category->id == $product->category_id ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8'); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group mb-4">
            <label for="image">Hình ảnh:</label>
            <input type="file" id="image" name="image" class="form-control" accept="image/*">
            <input type="hidden" name="existing_image" value="<?php echo htmlspecialchars($product->image, ENT_QUOTES, 'UTF-8'); ?>">
            <?php if ($product->image): ?>
                <img src="/<?php echo htmlspecialchars($product->image, ENT_QUOTES, 'UTF-8'); ?>" alt="Product Image" class="product-image">
            <?php endif; ?>
        </div>

        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
    </form>

    <a href="/webbanhang/Product/list" class="btn btn-secondary mt-3">Quay lại danh sách sản phẩm</a>
</div>

<?php include 'app/views/shares/footer.php'; ?>
