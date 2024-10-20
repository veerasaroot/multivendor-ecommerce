<?php
class Product {
    // ดึงสินค้าทั้งหมด
    public static function getAllProducts() {
        global $db;
        $query = "SELECT * FROM products"; // ดึงสินค้าทั้งหมด
        $stmt = $db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ดึงสินค้าตาม ID
    public static function findById($id) {
        global $db;
        $query = "SELECT * FROM products WHERE id = :id"; // ดึงสินค้าตาม ID
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ดึงสินค้าที่แนะนำ (Featured Products)
    public static function getFeatured() {
        global $db;
        $query = "SELECT * FROM products WHERE is_featured = 1 LIMIT 8"; // ดึงสินค้าที่ถูกระบุว่าเป็นสินค้าที่แนะนำ
        $stmt = $db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ดึงรูปภาพเพิ่มเติมของสินค้า
    public static function getImages($productId) {
        global $db;
        $query = "SELECT * FROM product_images WHERE product_id = :product_id"; // ดึงรูปภาพของสินค้า
        $stmt = $db->prepare($query);
        $stmt->bindParam(':product_id', $productId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
