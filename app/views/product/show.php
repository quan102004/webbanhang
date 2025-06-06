<?php include 'app/views/shares/header.php'; ?>

<div class="container mt-4">
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <?php if ($product): ?>
                <div class="row g-0">
                    <!-- Ảnh sản phẩm -->
                    <div class="col-lg-6 p-4 text-center">
                        <?php if ($product->image): ?>
                            <img src="/webbanhang/<?php echo htmlspecialchars($product->image, ENT_QUOTES, 'UTF-8'); ?>" 
                                 class="img-fluid rounded shadow-sm mb-3" 
                                 alt="<?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>" 
                                 style="max-height: 400px; object-fit: contain;">
                        <?php else: ?>
                            <img src="/webbanhang/images/no-image.png" 
                                 class="img-fluid rounded shadow-sm mb-3" 
                                 alt="Không có ảnh">
                        <?php endif; ?>
                        
                        <!-- Gallery nhỏ nếu có nhiều ảnh -->
                        <div class="row mt-2 gx-2 product-thumbnails">
                            <div class="col-3">
                                <img src="/webbanhang/<?php echo htmlspecialchars($product->image, ENT_QUOTES, 'UTF-8'); ?>" 
                                     class="img-thumbnail active" 
                                     alt="Thumbnail 1">
                            </div>
                            <!-- Có thể thêm thumbnails khác nếu có -->
                        </div>
                    </div>

                    <!-- Thông tin sản phẩm -->
                    <div class="col-lg-6 p-4 bg-white">
                        <!-- Breadcrumb -->
                        <nav aria-label="breadcrumb" class="mb-3">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/webbanhang/" class="text-decoration-none">Trang chủ</a></li>
                                <li class="breadcrumb-item"><a href="/webbanhang/Product/list" class="text-decoration-none">Sản phẩm</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?></li>
                            </ol>
                        </nav>

                        <!-- Tên sản phẩm -->
                        <h2 class="fw-bold mb-3"><?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?></h2>
                        
                        <!-- Danh mục -->
                        <p class="mb-3">
                            <span class="badge bg-light text-dark border">
                                <i class="fas fa-tag me-1"></i>
                                <?php echo !empty($product->category_name) ? 
                                    htmlspecialchars($product->category_name, ENT_QUOTES, 'UTF-8') : 'Chưa có danh mục'; ?>
                            </span>
                            
                            <!-- Có thể thêm trạng thái như còn hàng hay hết hàng -->
                            <span class="badge bg-success ms-2">
                                <i class="fas fa-check-circle me-1"></i> Còn hàng
                            </span>
                        </p>

                        <!-- Giá và khuyến mãi -->
                        <div class="mb-3">
                            <h3 class="text-danger fw-bold">
                                <?php echo number_format($product->price, 0, ',', '.'); ?> VND
                            </h3>
                            <?php if (isset($product->original_price) && $product->original_price > $product->price): ?>
                            <p class="text-muted text-decoration-line-through">
                                <?php echo number_format($product->original_price, 0, ',', '.'); ?> VND
                            </p>
                            <?php endif; ?>
                        </div>

                        <!-- Mô tả ngắn -->
                        <div class="mb-4">
                            <h5 class="fw-bold">Mô tả sản phẩm</h5>
                            <p class="text-secondary">
                                <?php echo nl2br(htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8')); ?>
                            </p>
                        </div>

                        <!-- Số lượng và thêm vào giỏ hàng -->
                        <div class="mb-4">
                            <form action="/webbanhang/Product/addToCart/<?php echo $product->id; ?>" method="post" class="d-flex align-items-center">
                                <div class="input-group me-3" style="width: 130px;">
                                    <button class="btn btn-outline-secondary btn-quantity" type="button" data-action="decrease">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <input type="number" class="form-control text-center" value="1" min="1" max="99" name="quantity" id="quantity">
                                    <button class="btn btn-outline-secondary btn-quantity" type="button" data-action="increase">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                                <button type="submit" class="btn btn-custom-primary">
                                    <i class="fas fa-shopping-cart me-2"></i> Thêm vào giỏ hàng
                                </button>
                            </form>
                        </div>
                        
                        <!-- Các chính sách -->
                        <div class="border-top pt-4">
                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-truck text-primary fs-4 me-2"></i>
                                        <div>
                                            <h6 class="mb-0 fw-bold">Giao hàng miễn phí</h6>
                                            <small class="text-muted">Cho đơn hàng từ 500k</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-exchange-alt text-primary fs-4 me-2"></i>
                                        <div>
                                            <h6 class="mb-0 fw-bold">Đổi trả dễ dàng</h6>
                                            <small class="text-muted">Trong vòng 7 ngày</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-check-circle text-primary fs-4 me-2"></i>
                                        <div>
                                            <h6 class="mb-0 fw-bold">Sản phẩm chính hãng</h6>
                                            <small class="text-muted">100% hàng chính hãng</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-shield-alt text-primary fs-4 me-2"></i>
                                        <div>
                                            <h6 class="mb-0 fw-bold">Bảo hành chính hãng</h6>
                                            <small class="text-muted">Theo chính sách nhà SX</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Chia sẻ sản phẩm -->
                        <div class="mt-4">
                            <p class="fw-bold mb-2">Chia sẻ sản phẩm:</p>
                            <div class="d-flex gap-2">
                                <a href="#" class="btn btn-sm btn-outline-primary"><i class="fab fa-facebook-f"></i></a>
                                <a href="#" class="btn btn-sm btn-outline-info"><i class="fab fa-twitter"></i></a>
                                <a href="#" class="btn btn-sm btn-outline-danger"><i class="fab fa-pinterest"></i></a>
                                <a href="#" class="btn btn-sm btn-outline-success"><i class="fab fa-whatsapp"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Thông tin chi tiết sản phẩm và đánh giá -->
                <div class="row mt-4">
                    <div class="col-12">
                        <ul class="nav nav-tabs" id="productTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true">
                                    Chi tiết sản phẩm
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="specs-tab" data-bs-toggle="tab" data-bs-target="#specs" type="button" role="tab" aria-controls="specs" aria-selected="false">
                                    Thông số kỹ thuật
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab" aria-controls="reviews" aria-selected="false">
                                    Đánh giá (0)
                                </button>
                            </li>
                        </ul>
                        
                        <div class="tab-content p-4 border border-top-0" id="productTabContent">
                            <!-- Chi tiết sản phẩm -->
                            <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                                <h4 class="mb-3">Chi tiết sản phẩm</h4>
                                <p><?php echo nl2br(htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8')); ?></p>
                                
                                <!-- Có thể thêm thông tin chi tiết hơn -->
                                <div class="my-4">
                                    <h5>Tính năng nổi bật</h5>
                                    <ul>
                                        <li>Chất lượng cao</li>
                                        <li>Thiết kế hiện đại</li>
                                        <li>Dễ dàng sử dụng</li>
                                        <li>Bền bỉ theo thời gian</li>
                                    </ul>
                                </div>
                            </div>
                            
                            <!-- Thông số kỹ thuật -->
                            <div class="tab-pane fade" id="specs" role="tabpanel" aria-labelledby="specs-tab">
                                <h4 class="mb-3">Thông số kỹ thuật</h4>
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <th scope="row" style="width: 30%;">Tên sản phẩm</th>
                                            <td><?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Mã sản phẩm</th>
                                            <td>SKU-<?php echo $product->id; ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Danh mục</th>
                                            <td><?php echo !empty($product->category_name) ? 
                                                htmlspecialchars($product->category_name, ENT_QUOTES, 'UTF-8') : 'Chưa có danh mục'; ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Thương hiệu</th>
                                            <td><?php echo isset($product->brand) ? htmlspecialchars($product->brand, ENT_QUOTES, 'UTF-8') : 'Chưa có thương hiệu'; ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Xuất xứ</th>
                                            <td><?php echo isset($product->origin) ? htmlspecialchars($product->origin, ENT_QUOTES, 'UTF-8') : 'Chưa có thông tin'; ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Bảo hành</th>
                                            <td>12 tháng</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            
                            <!-- Đánh giá -->
                            <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                                <h4 class="mb-3">Đánh giá từ khách hàng</h4>
                                <div class="mb-4">
                                    <div class="d-flex align-items-center mb-3">
                                        <div>
                                            <h5 class="mb-0">0.0</h5>
                                            <div>
                                                <i class="far fa-star text-warning"></i>
                                                <i class="far fa-star text-warning"></i>
                                                <i class="far fa-star text-warning"></i>
                                                <i class="far fa-star text-warning"></i>
                                                <i class="far fa-star text-warning"></i>
                                            </div>
                                            <small class="text-muted">0 đánh giá</small>
                                        </div>
                                    </div>
                                    
                                    <!-- Form đánh giá -->
                                    <div class="card border shadow-sm">
                                        <div class="card-body">
                                            <h5 class="card-title">Viết đánh giá của bạn</h5>
                                            <form>
                                                <div class="mb-3">
                                                    <label class="form-label">Đánh giá của bạn</label>
                                                    <div class="rating-stars mb-2">
                                                        <i class="far fa-star fs-5 text-warning" data-rating="1"></i>
                                                        <i class="far fa-star fs-5 text-warning" data-rating="2"></i>
                                                        <i class="far fa-star fs-5 text-warning" data-rating="3"></i>
                                                        <i class="far fa-star fs-5 text-warning" data-rating="4"></i>
                                                        <i class="far fa-star fs-5 text-warning" data-rating="5"></i>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="reviewContent" class="form-label">Nội dung đánh giá</label>
                                                    <textarea class="form-control" id="reviewContent" rows="3"></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-custom-primary">
                                                    <i class="fas fa-paper-plane me-2"></i> Gửi đánh giá
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Danh sách đánh giá (hiển thị khi có) -->
                                <div class="alert alert-info text-center">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Chưa có đánh giá nào cho sản phẩm này. Hãy là người đầu tiên đánh giá!
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Sản phẩm tương tự -->
                <div class="row mt-5">
                    <div class="col-12">
                        <h3 class="mb-4">Sản phẩm tương tự</h3>
                        <div class="row">
                            <!-- Chỗ này có thể thêm vòng lặp hiển thị sản phẩm tương tự -->
                            <div class="col-6 col-md-4 col-lg-3 mb-4">
                                <div class="card h-100 border-0 shadow-sm">
                                    <img src="/webbanhang/images/no-image.png" class="card-img-top" alt="Sản phẩm tương tự">
                                    <div class="card-body">
                                        <h5 class="card-title">Sản phẩm tương tự</h5>
                                        <p class="card-text text-danger fw-bold">150.000 VND</p>
                                        <a href="#" class="btn btn-sm btn-outline-primary">Xem chi tiết</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php else: ?>
                <div class="alert alert-danger text-center p-5">
                    <i class="fas fa-exclamation-triangle fa-3x mb-3"></i>
                    <h4>Không tìm thấy sản phẩm!</h4>
                    <p class="mb-3">Sản phẩm bạn đang tìm kiếm không tồn tại hoặc đã bị xóa.</p>
                    <a href="/webbanhang/Product/list" class="btn btn-primary">
                        <i class="fas fa-arrow-left me-2"></i> Quay lại danh sách sản phẩm
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- JavaScript để xử lý tăng giảm số lượng và chọn thumbnail -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Xử lý nút tăng/giảm số lượng
    const quantityInput = document.getElementById('quantity');
    const btnQuantity = document.querySelectorAll('.btn-quantity');
    
    btnQuantity.forEach(btn => {
        btn.addEventListener('click', function() {
            const action = this.getAttribute('data-action');
            let currentVal = parseInt(quantityInput.value);
            
            if (action === 'increase') {
                if (currentVal < 99) quantityInput.value = currentVal + 1;
            } else if (action === 'decrease') {
                if (currentVal > 1) quantityInput.value = currentVal - 1;
            }
        });
    });
    
    // Xử lý chọn thumbnail (nếu có)
    const thumbnails = document.querySelectorAll('.product-thumbnails img');
    const mainImage = document.querySelector('.col-lg-6.p-4.text-center > img');
    
    thumbnails.forEach(thumb => {
        thumb.addEventListener('click', function() {
            // Xóa class active
            thumbnails.forEach(t => t.classList.remove('active'));
            // Thêm class active cho thumbnail được chọn
            this.classList.add('active');
            // Thay đổi ảnh chính
            if (mainImage) {
                mainImage.src = this.src;
            }
        });
    });
    
    // Xử lý đánh giá sao
    const ratingStars = document.querySelectorAll('.rating-stars i');
    
    ratingStars.forEach(star => {
        star.addEventListener('click', function() {
            const rating = parseInt(this.getAttribute('data-rating'));
            
            // Reset tất cả các sao về trạng thái chưa chọn
            ratingStars.forEach(s => {
                s.classList.remove('fas');
                s.classList.add('far');
            });
            
            // Đánh dấu sao đã chọn
            for (let i = 0; i < rating; i++) {
                ratingStars[i].classList.remove('far');
                ratingStars[i].classList.add('fas');
            }
        });
    });
});
</script>

<?php include 'app/views/shares/footer.php'; ?>
