<?php include 'app/views/shares/header.php'; ?>

<!-- Bắt đầu giao diện -->
<div class="container mt-5 mb-5" style="max-width: 700px;">
    <h2 class="mb-4 text-center">🆕 Thêm sản phẩm mới</h2>

    <!-- Hiển thị lỗi nếu có -->
    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <!-- Form thêm sản phẩm -->
    <form method="POST" action="/webbanhang/Product/save" enctype="multipart/form-data" onsubmit="return validateForm();">
        <div class="mb-3">
            <label for="name" class="form-label">📦 Tên sản phẩm:</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">📝 Mô tả:</label>
            <textarea id="description" name="description" class="form-control" rows="4" required></textarea>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">💰 Giá:</label>
            <input type="number" id="price" name="price" class="form-control" step="0.01" required>
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">📂 Danh mục:</label>
            <select id="category_id" name="category_id" class="form-select" required>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category->id ?>"><?= htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8') ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-4">
            <label for="image" class="form-label">🖼️ Hình ảnh:</label>
            <input type="file" id="image" name="image" class="form-control">
        </div>

        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-success">➕ Thêm sản phẩm</button>
            <a href="/webbanhang/Product/list" class="btn btn-secondary">⬅️ Quay lại danh sách</a>
        </div>
    </form>
</div>

<?php include 'app/views/shares/footer.php'; ?>
