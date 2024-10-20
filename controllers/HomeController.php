<?php
require_once 'controllers/ProductController.php';

class HomeController {
    public function index() {
        // ดึงสินค้าที่แนะนำมาแสดงในหน้าแรก
        $featuredProducts = ProductController::getFeaturedProducts();

        // แสดงส่วน header, home, และ footer
        include 'views/templates/header.php';
        include 'views/home.php';
        include 'views/templates/footer.php';
    }
}

