<?php include 'app/views/shares/header.php'; ?>
<div class="container py-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Thanh toán</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="/webbanhang/Product/processCheckout" class="needs-validation" novalidate>
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Họ tên:</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                            <div class="invalid-feedback">Vui lòng nhập họ tên</div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="phone" class="form-label">Số điện thoại:</label>
                            <input type="text" id="phone" name="phone" class="form-control" pattern="[0-9]{10}" required>
                            <div class="invalid-feedback">Vui lòng nhập số điện thoại hợp lệ</div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="address" class="form-label">Địa chỉ:</label>
                            <textarea id="address" name="address" class="form-control" rows="3" required></textarea>
                            <div class="invalid-feedback">Vui lòng nhập địa chỉ</div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="payment" class="form-label">Phương thức thanh toán:</label>
                            <select id="payment" name="payment" class="form-control" required>
                                <option value="">Chọn phương thức thanh toán</option>
                                <option value="cod">Thanh toán khi nhận hàng (COD)</option>
                                <option value="banking">Chuyển khoản ngân hàng</option>
                                <option value="momo">Ví điện tử MoMo</option>
                                <option value="vnpay">VNPay</option>
                            </select>
                            <div class="invalid-feedback">Vui lòng chọn phương thức thanh toán</div>
                        </div>
                        
                        <!-- Phần hiển thị thông tin đơn hàng -->
                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">Thông tin đơn hàng</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Sản phẩm</th>
                                                <th>Số lượng</th>
                                                <th class="text-end">Giá</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $total = 0;
                                            if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): 
                                                foreach($_SESSION['cart'] as $item):
                                                    $total += $item['price'] * $item['quantity'];
                                            ?>
                                            <tr>
                                                <td><?php echo $item['name']; ?></td>
                                                <td><?php echo $item['quantity']; ?></td>
                                                <td class="text-end"><?php echo number_format($item['price'] * $item['quantity'], 0, ',', '.'); ?> đ</td>
                                            </tr>
                                            <?php 
                                                endforeach; 
                                            endif;
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="2">Tổng tiền</th>
                                                <th class="text-end"><?php echo number_format($total, 0, ',', '.'); ?> đ</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between mt-4">
                            <a href="/webbanhang/Product/cart" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Quay lại giỏ hàng
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-credit-card"></i> Hoàn tất thanh toán
                            </button>
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
                form.classList.add('was-validated');
            }, false);
        });
        
        // Hiện thông tin thanh toán bổ sung dựa trên phương thức được chọn
        document.getElementById('payment').addEventListener('change', function() {
            const paymentMethod = this.value;
            const bankingInfo = document.getElementById('banking-info');
            const walletInfo = document.getElementById('wallet-info');
            
            // Ẩn tất cả thông tin thanh toán
            if (bankingInfo) bankingInfo.style.display = 'none';
            if (walletInfo) walletInfo.style.display = 'none';
            
            // Hiện thông tin dựa trên lựa chọn
            if (paymentMethod === 'banking' && bankingInfo) {
                bankingInfo.style.display = 'block';
            } else if ((paymentMethod === 'momo' || paymentMethod === 'vnpay') && walletInfo) {
                walletInfo.style.display = 'block';
            }
        });
    })();
</script>
<?php include 'app/views/shares/footer.php'; ?>
