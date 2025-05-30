<?php include 'app/views/shares/header.php'; ?>

<div class="container py-4">
    <!-- Page Header -->
    <div class="d-flex flex-column flex-md-row align-items-center justify-content-between mb-4 pb-2 border-bottom">
        <h2 class="fw-bold text-primary">
            <i class="fas fa-list-ul me-2"></i>Danh sách sản phẩm
        </h2>
        <div class="d-flex mt-3 mt-md-0">
            <a href="/webbanhang/Product/cart" class="btn btn-outline-primary me-2">
                <i class="fas fa-shopping-cart me-2"></i>Giỏ hàng
                <?php if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
                <span class="badge bg-danger"><?php echo count($_SESSION['cart']); ?></span>
                <?php endif; ?>
            </a>
            <a href="/webbanhang/Product/add" class="btn btn-custom-primary">
                <i class="fas fa-plus-circle me-2"></i>Thêm sản phẩm mới
            </a>
        </div>
    </div>

    <!-- Search and Filter Section -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="fas fa-search"></i></span>
                        <input type="text" id="searchInput" class="form-control" placeholder="Tìm kiếm sản phẩm...">
                    </div>
                </div>
                <div class="col-md-3">
                    <select id="categoryFilter" class="form-select">
                        <option value="">Tất cả danh mục</option>
                        <!-- Có thể thêm các option từ PHP -->
                    </select>
                </div>
                <div class="col-md-3">
                    <select id="sortOrder" class="form-select">
                        <option value="name_asc">Tên (A-Z)</option>
                        <option value="name_desc">Tên (Z-A)</option>
                        <option value="price_asc">Giá (Thấp - Cao)</option>
                        <option value="price_desc">Giá (Cao - Thấp)</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Products Grid -->
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-4 g-4">
        <?php foreach ($products as $product): ?>
            <div class="col product-item">
                <div class="card h-100 shadow-sm hover-shadow">
                    <!-- Product Image -->
                    <div class="card-img-container position-relative" style="height: 200px; overflow: hidden;">
                        <?php if ($product->image): ?>
                            <img src="/webbanhang/<?php echo htmlspecialchars($product->image, ENT_QUOTES, 'UTF-8'); ?>"
                                class="card-img-top h-100 w-100 object-fit-cover"
                                alt="<?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>">
                        <?php else: ?>
                            <div class="bg-light d-flex align-items-center justify-content-center h-100">
                                <i class="fas fa-image fa-3x text-secondary"></i>
                            </div>
                        <?php endif; ?>
                        
                        <!-- Added: Quick Add to Cart Button -->
                        <a href="/webbanhang/Product/addToCart/<?php echo $product->id; ?>" 
                           class="btn btn-sm btn-success position-absolute top-0 end-0 m-2 add-to-cart-btn">
                            <i class="fas fa-cart-plus"></i>
                        </a>
                    </div>

                    <!-- Product Info -->
                    <div class="card-body">
                        <h5 class="card-title fw-bold text-truncate">
                            <a href="/webbanhang/Product/show/<?php echo $product->id; ?>"
                                class="text-decoration-none">
                                <?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>
                            </a>
                        </h5>
                        <p class="card-text small text-muted mb-2 product-category">
                            <i class="fas fa-tag me-1"></i>
                            <?php echo htmlspecialchars($product->category_name, ENT_QUOTES, 'UTF-8'); ?>
                        </p>
                        <p class="card-text product-description text-truncate">
                            <?php echo htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8'); ?>
                        </p>
                        <h6 class="fw-bold text-primary mb-0">
                            <?php echo number_format($product->price, 0, ',', '.'); ?> VND
                        </h6>
                    </div>

                    <!-- Product Actions -->
                    <div class="card-footer bg-white border-top-0 d-flex justify-content-between">
                        <div class="btn-group w-100">
                            <a href="/webbanhang/Product/addToCart/<?php echo $product->id; ?>"
                                class="btn btn-sm btn-outline-success action-btn add-to-cart-main">
                                <i class="fas fa-cart-plus me-1"></i>Thêm vào giỏ
                            </a>
                            <a href="/webbanhang/Product/edit/<?php echo $product->id; ?>"
                                class="btn btn-sm btn-outline-primary action-btn">
                                <i class="fas fa-edit me-1"></i>Sửa
                            </a>
                            <a href="/webbanhang/Product/delete/<?php echo $product->id; ?>"
                                class="btn btn-sm btn-outline-danger action-btn delete-btn"
                                data-id="<?php echo $product->id; ?>">
                                <i class="fas fa-trash-alt me-1"></i>Xóa
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Empty State -->
    <?php if (empty($products)): ?>
        <div class="text-center py-5">
            <div class="mb-3">
                <i class="fas fa-box-open fa-4x text-secondary"></i>
            </div>
            <h3>Không có sản phẩm nào</h3>
            <p class="text-muted">Hãy thêm sản phẩm mới để bắt đầu.</p>
            <a href="/webbanhang/Product/add" class="btn btn-custom-primary mt-3">
                <i class="fas fa-plus-circle me-2"></i>Thêm sản phẩm
            </a>
        </div>
    <?php endif; ?>
</div>

<style>
    .hover-shadow:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.12) !important;
        transition: all 0.3s ease;
    }

    .card {
        transition: all 0.3s ease;
        border-radius: 10px;
    }

    .card-img-container {
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        background-color: #f8f9fa;
        position: relative;
    }

    .card-title a {
        color: var(--dark-color);
    }

    .card-title a:hover {
        color: var(--primary-color);
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
    
    .action-btn {
        position: relative;
        z-index: 10;
        transition: all 0.2s ease;
        font-size: 0.8rem;
        padding: 0.375rem 0.5rem;
    }
    
    .action-btn:hover {
        transform: translateY(-3px);
    }
    
    .delete-btn:hover {
        background-color: var(--danger-color);
        border-color: var(--danger-color);
        color: white;
    }
    
    .btn-outline-success:hover {
        background-color: #28a745;
        border-color: #28a745;
        color: white;
    }
    
    .badge {
        position: relative;
        top: -1px;
    }
    
    /* New styles for add to cart button */
    .add-to-cart-btn {
        opacity: 0;
        transition: all 0.3s ease;
        z-index: 20;
        border-radius: 50%;
        width: 35px;
        height: 35px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    }
    
    .card:hover .add-to-cart-btn {
        opacity: 1;
    }
    
    /* Animation for add to cart */
    @keyframes addedToCart {
        0% {transform: scale(1);}
        50% {transform: scale(1.5);}
        100% {transform: scale(1);}
    }
    
    .added-animation {
        animation: addedToCart 0.5s ease;
    }
    
    /* Cart badge animation */
    @keyframes cartBadgePulse {
        0% {transform: scale(1);}
        50% {transform: scale(1.3);}
        100% {transform: scale(1);}
    }
    
    .cart-badge-animation {
        animation: cartBadgePulse 0.5s ease;
    }
</style>

<!-- Filter and Sort JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Search functionality
        const searchInput = document.getElementById('searchInput');
        searchInput.addEventListener('input', filterProducts);

        // Category filter
        const categoryFilter = document.getElementById('categoryFilter');
        categoryFilter.addEventListener('change', filterProducts);

        // Sort functionality
        const sortOrder = document.getElementById('sortOrder');
        sortOrder.addEventListener('change', sortProducts);
        
        // Xử lý nút xóa sản phẩm
        const deleteButtons = document.querySelectorAll('.delete-btn');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                
                if (confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')) {
                    window.location.href = this.getAttribute('href');
                }
            });
        });
        
        // Xử lý tất cả các nút thêm vào giỏ hàng
        const allAddToCartButtons = document.querySelectorAll('a[href^="/webbanhang/Product/addToCart/"]');
        allAddToCartButtons.forEach(button => {
            button.addEventListener('click', handleAddToCart);
        });
        
        function handleAddToCart(e) {
            e.preventDefault();
            const cartUrl = this.getAttribute('href');
            const isQuickAddBtn = this.classList.contains('add-to-cart-btn');
            
            // Hiệu ứng khi nhấn nút
            if (isQuickAddBtn) {
                this.classList.add('added-animation');
                setTimeout(() => this.classList.remove('added-animation'), 500);
            }
            
            // Hiệu ứng sản phẩm bay vào giỏ hàng
            const productCard = this.closest('.card');
            const productImg = productCard.querySelector('img')?.cloneNode(true) ||
                               productCard.querySelector('.fa-image')?.cloneNode(true);
            
            if (productImg) {
                // Tạo hiệu ứng sản phẩm bay vào giỏ hàng
                const imgFly = document.createElement('div');
                imgFly.classList.add('img-fly');
                imgFly.style.cssText = `
                    position: fixed;
                    z-index: 9999;
                    width: 50px;
                    height: 50px;
                    border-radius: 50%;
                    overflow: hidden;
                    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
                `;
                
                if (productImg.tagName === 'IMG') {
                    imgFly.appendChild(productImg);
                    productImg.style.cssText = 'width: 100%; height: 100%; object-fit: cover;';
                } else {
                    imgFly.style.backgroundColor = '#f8f9fa';
                    imgFly.style.display = 'flex';
                    imgFly.style.alignItems = 'center';
                    imgFly.style.justifyContent = 'center';
                    imgFly.appendChild(productImg);
                }
                
                document.body.appendChild(imgFly);
                
                // Lấy vị trí của nút và giỏ hàng
                const btnRect = this.getBoundingClientRect();
                const cartIcon = document.querySelector('a[href="/webbanhang/Product/cart"]');
                const cartIconRect = cartIcon.getBoundingClientRect();
                
                // Đặt vị trí bắt đầu
                imgFly.style.top = btnRect.top + 'px';
                imgFly.style.left = btnRect.left + 'px';
                
                // Animation
                setTimeout(() => {
                    imgFly.style.transition = 'all 0.8s cubic-bezier(0.165, 0.84, 0.44, 1)';
                    imgFly.style.top = cartIconRect.top + 'px';
                    imgFly.style.left = cartIconRect.left + 'px';
                    imgFly.style.opacity = '0.5';
                    imgFly.style.transform = 'scale(0.3)';
                    
                    setTimeout(() => {
                        imgFly.remove();
                        
                        // Cập nhật giỏ hàng bằng Ajax để không reload trang
                        fetch(cartUrl)
                            .then(response => {
                                // Hiệu ứng nhấp nháy cho badge giỏ hàng
                                const badge = cartIcon.querySelector('.badge');
                                if (badge) {
                                    // Cập nhật số lượng và thêm hiệu ứng
                                    const currentCount = parseInt(badge.textContent);
                                    badge.textContent = currentCount + 1;
                                    badge.classList.add('cart-badge-animation');
                                    setTimeout(() => badge.classList.remove('cart-badge-animation'), 500);
                                } else {
                                    // Tạo badge mới nếu chưa có
                                    const newBadge = document.createElement('span');
                                    newBadge.className = 'badge bg-danger cart-badge-animation';
                                    newBadge.textContent = '1';
                                    cartIcon.appendChild(newBadge);
                                }
                            })
                            .catch(error => {
                                console.error('Lỗi khi thêm vào giỏ hàng:', error);
                            });
                    }, 800);
                }, 10);
            } else {
                // Nếu không có hình ảnh, gửi yêu cầu trực tiếp
                fetch(cartUrl);
            }
        }

        function filterProducts() {
            const searchTerm = searchInput.value.toLowerCase();
            const category = categoryFilter.value.toLowerCase();
            const productItems = document.querySelectorAll('.product-item');

            productItems.forEach(item => {
                const title = item.querySelector('.card-title').textContent.toLowerCase();
                const description = item.querySelector('.product-description').textContent.toLowerCase();
                const productCategory = item.querySelector('.product-category').textContent.toLowerCase();

                const matchesSearch = title.includes(searchTerm) || description.includes(searchTerm);
                const matchesCategory = category === '' || productCategory.includes(category);

                if (matchesSearch && matchesCategory) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
        }

        function sortProducts() {
            const products = Array.from(document.querySelectorAll('.product-item'));
            const productsContainer = document.querySelector('.row-cols-1');
            const sortType = sortOrder.value;

            products.sort((a, b) => {
                if (sortType === 'name_asc') {
                    return a.querySelector('.card-title').textContent.localeCompare(b.querySelector('.card-title').textContent);
                } else if (sortType === 'name_desc') {
                    return b.querySelector('.card-title').textContent.localeCompare(a.querySelector('.card-title').textContent);
                } else if (sortType === 'price_asc' || sortType === 'price_desc') {
                    const priceA = parseFloat(a.querySelector('h6').textContent.replace(/[^\d]/g, ''));
                    const priceB = parseFloat(b.querySelector('h6').textContent.replace(/[^\d]/g, ''));

                    return sortType === 'price_asc' ? priceA - priceB : priceB - priceA;
                }
                return 0;
            });

            products.forEach(product => productsContainer.appendChild(product));
        }
    });
</script>

<?php include 'app/views/shares/footer.php'; ?>