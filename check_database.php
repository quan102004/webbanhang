<?php
// Thêm các file cần thiết
require_once('app/config/database.php');

// Kết nối đến cơ sở dữ liệu
try {
    $db = (new Database())->getConnection();
    echo '<h2>Thông tin trạng thái cơ sở dữ liệu</h2>';
    echo '<pre>';
    echo "Kết nối cơ sở dữ liệu: Thành công\n";
    
    // Kiểm tra bảng product
    $stmt = $db->query("SELECT COUNT(*) as count FROM product");
    $productCount = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    echo "Số lượng sản phẩm trong cơ sở dữ liệu: " . $productCount . "\n";
    
    if ($productCount > 0) {
        // Hiển thị danh sách sản phẩm nếu có
        $stmt = $db->query("SELECT * FROM product LIMIT 10");
        echo "\nDanh sách sản phẩm (tối đa 10):\n";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "ID: " . $row['id'] . " | Tên: " . $row['name'] . " | Giá: " . $row['price'] . "\n";
        }
    } else {
        echo "\nKhông có sản phẩm nào trong cơ sở dữ liệu. Hãy thêm một số sản phẩm trước.\n";
    }
    
    // Kiểm tra bảng category
    $stmt = $db->query("SELECT COUNT(*) as count FROM category");
    $categoryCount = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    echo "\nSố lượng danh mục trong cơ sở dữ liệu: " . $categoryCount . "\n";
    
    echo '</pre>';
} catch (PDOException $e) {
    echo '<h2>Lỗi kết nối cơ sở dữ liệu</h2>';
    echo '<pre>';
    echo "Lỗi: " . $e->getMessage() . "\n";
    echo "Vui lòng kiểm tra cấu hình cơ sở dữ liệu trong app/config/database.php";
    echo '</pre>';
}
?>
