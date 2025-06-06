<?php include 'app/views/shares/header.php'; ?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg">
                <!-- Header với icon thành công -->
                <div class="card-header bg-success text-white text-center py-4">
                    <div class="mb-3">
                        <i class="fas fa-check-circle fa-4x animated pulse infinite"></i>
                    </div>
                    <h2 class="mb-0">Đặt hàng thành công!</h2>
                </div>
                
                <div class="card-body p-5">
                    <!-- Thông tin đơn hàng -->
                    <div class="text-center mb-5">
                        <p class="lead">Cảm ơn bạn đã đặt hàng. Đơn hàng của bạn đã được xử lý thành công.</p>
                        <div class="alert alert-light border p-3 mt-4">
                            <?php if(isset($order) && isset($order['id'])): ?>
                                <h5>Mã đơn hàng: <span class="badge bg-primary">#<?php echo $order['id']; ?></span></h5>
                            <?php else: ?>
                                <h5>Mã đơn hàng: <span class="badge bg-primary">#<?php echo rand(10000, 99999); ?></span></h5>
                            <?php endif; ?>
                            <p class="mb-0">Ngày đặt hàng: <?php echo date('d/m/Y H:i'); ?></p>
                        </div>
                    </div>
                    
                    <!-- Chi tiết đơn hàng -->
                    <?php if(isset($orderDetails) && !empty($orderDetails)): ?>
                    <div class="order-details mb-4">
                        <h4 class="border-bottom pb-2 mb-3"><i class="fas fa-shopping-bag me-2"></i>Chi tiết đơn hàng</h4>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Sản phẩm</th>
                                        <th class="text-center">Số lượng</th>
                                        <th class="text-end">Giá</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($orderDetails as $item): ?>
                                    <tr>
                                        <td><?php echo $item['product_name']; ?></td>
                                        <td class="text-center"><?php echo $item['quantity']; ?></td>
                                        <td class="text-end"><?php echo number_format($item['price'], 0, ',', '.'); ?> đ</td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <tr class="fw-bold">
                                        <td colspan="2">Tổng cộng:</td>
                                        <td class="text-end"><?php echo isset($order['total']) ? number_format($order['total'], 0, ',', '.') : number_format(0, 0, ',', '.'); ?> đ</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php endif; ?>
                    
                    <!-- Thông tin giao hàng -->
                    <?php if(isset($order)): ?>
                    <div class="shipping-info mb-4">
                        <h4 class="border-bottom pb-2 mb-3"><i class="fas fa-truck me-2"></i>Thông tin giao hàng</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Họ tên:</strong> <?php echo isset($order['name']) ? $order['name'] : 'Khách hàng'; ?></p>
                                <p><strong>Số điện thoại:</strong> <?php echo isset($order['phone']) ? $order['phone'] : 'N/A'; ?></p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Địa chỉ:</strong> <?php echo isset($order['address']) ? $order['address'] : 'N/A'; ?></p>
                                <p><strong>Phương thức thanh toán:</strong> <?php echo isset($order['payment_method']) ? $order['payment_method'] : 'Thanh toán khi nhận hàng'; ?></p>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    
                    <!-- Trạng thái đơn hàng -->
                    <div class="order-status mb-5">
                        <h4 class="border-bottom pb-2 mb-3"><i class="fas fa-info-circle me-2"></i>Trạng thái đơn hàng</h4>
                        <div class="progress" style="height: 25px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Đã xác nhận</div>
                            <div class="progress-bar bg-info" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">Đang chuẩn bị</div>
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">Đang giao hàng</div>
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">Hoàn thành</div>
                        </div>
                        <div class="mt-2 text-muted text-center">
                            <small>Chúng tôi đã nhận được đơn hàng của bạn và đang trong quá trình xử lý.</small>
                        </div>
                    </div>
                    
                    <!-- Các nút hành động -->
                    <div class="text-center mt-4">
                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <a href="/webbanhang/Product/list" class="btn btn-primary w-100">
                                    <i class="fas fa-shopping-cart me-2"></i>Tiếp tục mua sắm
                                </a>
                            </div>
                            <div class="col-md-4 mb-2">
                                <a href="/webbanhang/Orders/view" class="btn btn-outline-primary w-100">
                                    <i class="fas fa-list me-2"></i>Xem đơn hàng
                                </a>
                            </div>
                            <div class="col-md-4 mb-2">
                                <a href="#" onclick="window.print(); return false;" class="btn btn-outline-secondary w-100">
                                    <i class="fas fa-print me-2"></i>In đơn hàng
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Thông tin thêm -->
            <div class="card mt-4 border-0 shadow">
                <div class="card-body">
                    <h5><i class="fas fa-question-circle me-2 text-primary"></i>Bạn cần hỗ trợ?</h5>
                    <p class="mb-0">Nếu bạn có bất kỳ câu hỏi nào về đơn hàng, vui lòng liên hệ với Võ Hoàng Quân Store qua email <a href="mailto:support@vohoanquanstore.com">support@vohoanquanstore.com</a> hoặc gọi đến số <strong>1900 1234</strong>.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .animated {
        animation-duration: 2.5s;
        animation-fill-mode: both;
        animation-iteration-count: infinite;
    }
    
    @keyframes pulse {
        0% {transform: scale(1);}
        50% {transform: scale(1.1);}
        100% {transform: scale(1);}
    }
    
    .pulse {
        animation-name: pulse;
    }
    
    @media print {
        .navbar, .btn, footer {
            display: none !important;
        }
    }
</style>

<?php include 'app/views/shares/footer.php'; ?>