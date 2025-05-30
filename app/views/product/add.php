<?php include 'app/views/shares/header.php'; ?>

<div class="container py-4">
    <!-- Page Header -->
    <div class="d-flex flex-column flex-md-row align-items-center justify-content-between mb-4 pb-2 border-bottom">
        <h2 class="fw-bold text-primary">
            <i class="fas fa-plus-circle me-2"></i>Thêm sản phẩm mới
        </h2>
        <div class="d-flex mt-3 mt-md-0">
            <a href="/webbanhang/Product/index" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Quay lại danh sách
            </a>
        </div>
    </div>

    <!-- Hiển thị lỗi nếu có -->
    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger shadow-sm">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <strong>Đã xảy ra lỗi:</strong>
            <ul class="mb-0 mt-2">
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <!-- Form Card -->
    <div class="card shadow-sm border-0 rounded-3 mb-4">
        <div class="card-body p-4">
            <form method="POST" action="/webbanhang/Product/save" enctype="multipart/form-data" onsubmit="return validateForm();" id="productForm">
                <div class="row g-4">
                    <!-- Form Left Column -->
                    <div class="col-lg-8">
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">
                                <i class="fas fa-box me-1"></i>Tên sản phẩm
                            </label>
                            <input type="text" id="name" name="name" class="form-control form-control-lg" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label fw-semibold">
                                <i class="fas fa-align-left me-1"></i>Mô tả sản phẩm
                            </label>
                            <textarea id="description" name="description" class="form-control" rows="5" required></textarea>
                            <div class="form-text">Mô tả chi tiết về sản phẩm, tính năng và đặc điểm nổi bật.</div>
                        </div>
                    </div>

                    <!-- Form Right Column -->
                    <div class="col-lg-4">
                        <div class="card bg-light border-0 h-100">
                            <div class="card-body">
                                <h5 class="card-title mb-3">
                                    <i class="fas fa-cog me-1"></i>Thông tin cấu hình
                                </h5>

                                <div class="mb-3">
                                    <label for="price" class="form-label fw-semibold">
                                        <i class="fas fa-tag me-1"></i>Giá
                                    </label>
                                    <div class="input-group">
                                        <input type="number" id="price" name="price" class="form-control" step="1000" min="0" required>
                                        <span class="input-group-text">VND</span>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="category_id" class="form-label fw-semibold">
                                        <i class="fas fa-folder me-1"></i>Danh mục
                                    </label>
                                    <select id="category_id" name="category_id" class="form-select" required>
                                        <option value="" selected disabled>-- Chọn danh mục --</option>
                                        <?php foreach ($categories as $category): ?>
                                            <option value="<?= $category->id ?>"><?= htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8') ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="image" class="form-label fw-semibold">
                                        <i class="fas fa-image me-1"></i>Hình ảnh
                                    </label>
                                    <input type="file" id="image" name="image" class="form-control" accept="image/*">
                                    <div class="form-text">Chọn hình ảnh với định dạng JPG, PNG hoặc GIF.</div>
                                </div>

                                <div class="image-preview mt-3 text-center d-none" id="imagePreview">
                                    <img id="preview" class="img-thumbnail" style="max-height: 200px; max-width: 100%;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Form Actions -->
                <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                    <button type="reset" class="btn btn-outline-secondary">
                        <i class="fas fa-undo me-1"></i>Đặt lại
                    </button>
                    <button type="submit" class="btn btn-custom-primary">
                        <i class="fas fa-save me-1"></i>Lưu sản phẩm
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Image Preview JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const imageInput = document.getElementById('image');
    const previewContainer = document.getElementById('imagePreview');
    const preview = document.getElementById('preview');

    imageInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
                previewContainer.classList.remove('d-none');
            }
            
            reader.readAsDataURL(this.files[0]);
        } else {
            previewContainer.classList.add('d-none');
        }
    });
    
    const validateForm = function() {
        const name = document.getElementById('name').value;
        const description = document.getElementById('description').value;
        const price = document.getElementById('price').value;
        const category = document.getElementById('category_id').value;
        
        if (!name || !description || !price || !category) {
            alert('Vui lòng điền đầy đủ thông tin bắt buộc!');
            return false;
        }
        
        return true;
    };
    
    document.getElementById('productForm').onsubmit = validateForm;
});
</script>

<?php include 'app/views/shares/footer.php'; ?>
