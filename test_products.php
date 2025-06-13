<?php
require_once('app/config/database.php');
require_once('app/models/ProductModel.php');

// Create a connection
$db = (new Database())->getConnection();
$productModel = new ProductModel($db);

// Get products
$products = $productModel->getProducts();

// Output
echo '<pre>';
echo 'Number of products: ' . count($products) . "\n\n";
print_r($products);
echo '</pre>';
?>
