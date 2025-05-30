<?php include 'app/views/shares/header.php'; ?>

<div class="container-fluid p-3">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h1 class="h4 mb-0"><i class="fas fa-shopping-cart me-2"></i>Giỏ hàng của bạn</h1>
                </div>
                <div class="card-body p-0">
                    <?php if (empty($cart)): ?>
                        <div class="p-5 text-center">
                            <h3>Giỏ hàng trống</h3>
                            <img src="<?php echo htmlspecialchars('/webbanhang/images/empty-cart.png', ENT_QUOTES, 'UTF-8'); ?>" class="img-fluid mb-3" style="max-width: 200px;">
                            <p class="text-muted mb-4">Bạn chưa có sản phẩm nào trong giỏ hàng.</p>
                            <a href="/webbanhang/Product/list" class="btn btn-primary btn-lg px-5">Tiếp tục mua sắm</a>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" width="100">Ảnh</th>
                                        <th scope="col">Sản phẩm</th>
                                        <th scope="col" class="text-end">Đơn giá</th>
                                        <th scope="col" class="text-center">Số lượng</th>
                                        <th scope="col" class="text-end">Thành tiền</th>
                                        <th scope="col" width="50"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $totalAmount = 0;
                                    foreach ($cart as $id => $item): 
                                        $subtotal = $item['price'] * $item['quantity'];
                                        $totalAmount += $subtotal;
                                    ?>
                                    <tr>
                                        <td class="align-middle">
                                            <?php if ($item['image']): ?>
                                                <img src="/webbanhang/<?php echo htmlspecialchars($item['image'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8'); ?>" 
                                                     class="img-thumbnail" style="max-width: 80px; max-height: 80px;">
                                            <?php else: ?>
                                                <div class="bg-light d-flex align-items-center justify-content-center" 
                                                     style="width: 80px; height: 80px;">
                                                    <i class="fas fa-image text-muted"></i>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                        <td class="align-middle">
                                            <h6 class="mb-0"><?php echo htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8'); ?></h6>
                                        </td>
                                        <td class="align-middle text-end">
                                            <?php echo number_format($item['price'], 0, ',', '.'); ?> VND
                                        </td>
                                        <td class="align-middle text-center">
                                            <div class="input-group input-group-sm mx-auto" style="width: 120px;">
                                                <a href="/webbanhang/Product/updateCart/<?php echo $id; ?>?action=decrease" class="btn btn-outline-secondary">
                                                    <i class="fas fa-minus"></i>
                                                </a>
                                                <input type="text" class="form-control text-center" value="<?php echo $item['quantity']; ?>" readonly>
                                                <a href="/webbanhang/Product/updateCart/<?php echo $id; ?>?action=increase" class="btn btn-outline-secondary">
                                                    <i class="fas fa-plus"></i>
                                                </a>
                                            </div>
                                        </td>
                                        <td class="align-middle text-end fw-bold">
                                            <?php echo number_format($subtotal, 0, ',', '.'); ?> VND
                                        </td>
                                        <td class="align-middle text-center">
                                            <a href="/webbanhang/Product/removeFromCart/<?php echo $id; ?>" 
                                               class="btn btn-sm btn-danger" 
                                               onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot class="table-light">
                                    <tr>
                                        <td colspan="4" class="text-end fw-bold">Tổng cộng:</td>
                                        <td class="text-end fw-bold text-danger h5"><?php echo number_format($totalAmount, 0, ',', '.'); ?> VND</td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="card-footer bg-white d-flex justify-content-between p-3">
                            <a href="/webbanhang/Product/list" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Tiếp tục mua sắm
                            </a>
                            <a href="/webbanhang/Product/checkout" class="btn btn-success px-4">
                                Thanh toán<i class="fas fa-arrow-right ms-2"></i>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>
