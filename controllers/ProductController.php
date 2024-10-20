<?php
require_once 'models/Product.php';

class ProductController {
    // ดึงรายการสินค้าทั้งหมด
    public function listProducts() {
        $products = Product::getAllProducts();
        include 'views/templates/header.php';
        include 'views/products.php'; // หน้าแสดงสินค้าทั้งหมด
        include 'views/templates/footer.php';
    }

    // ดึงข้อมูลสินค้าตาม ID
    public function showProduct($productId) {
        $product = Product::findById($productId);
        if (!$product) {
            // สินค้าไม่พบ แสดง 404
            http_response_code(404);
            echo "404 - Product not found";
            return;
        }
        include 'views/templates/header.php';
        include 'views/product.php'; // หน้าแสดงรายละเอียดสินค้า
        include 'views/templates/footer.php';
    }

    // ดึงสินค้าที่แนะนำ (Featured Products)
    public static function getFeaturedProducts() {
        return Product::getFeatured(); // เรียกใช้งานฟังก์ชันจาก Product Model
    }

    // ดึงรูปภาพเพิ่มเติมของสินค้า
    public static function getProductImages($productId) {
        return Product::getImages($productId);
    }
}
