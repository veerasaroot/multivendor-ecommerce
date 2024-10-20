<?php
require_once 'models/Product.php';

class CartController {
    // เพิ่มสินค้าไปยังตะกร้า
    public function addToCart($productId, $quantity = 1) {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId]['quantity'] += $quantity;
        } else {
            $product = Product::findById($productId);
            if ($product) {
                $_SESSION['cart'][$productId] = [
                    'name' => $product['name'],
                    'price' => $product['price'],
                    'quantity' => $quantity,
                    'thumbnail' => $product['thumbnail']
                ];
            }
        }
    }

    // ลบสินค้าออกจากตะกร้า
    public function removeFromCart($productId) {
        if (isset($_SESSION['cart'][$productId])) {
            unset($_SESSION['cart'][$productId]);
        }
    }

    // บันทึกคำสั่งซื้อและรายการสินค้าในตะกร้าลงในฐานข้อมูล
    public function placeOrder($userId) {
        global $db;

        if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
            return false; // ตะกร้าสินค้าว่างเปล่า
        }

        // คำนวณยอดรวมของคำสั่งซื้อ
        $total = $this->calculateTotal();

        // บันทึกข้อมูลคำสั่งซื้อในตาราง orders
        $query = "INSERT INTO orders (user_id, total) VALUES (:user_id, :total)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':total', $total);
        $stmt->execute();

        // รับ ID ของคำสั่งซื้อที่เพิ่งบันทึกลงไป
        $orderId = $db->lastInsertId();

        // บันทึกรายการสินค้าที่อยู่ในตะกร้าในตาราง order_items
        foreach ($_SESSION['cart'] as $productId => $item) {
            $query = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (:order_id, :product_id, :quantity, :price)";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':order_id', $orderId);
            $stmt->bindParam(':product_id', $productId);
            $stmt->bindParam(':quantity', $item['quantity']);
            $stmt->bindParam(':price', $item['price']);
            $stmt->execute();
        }

        // เคลียร์ตะกร้าสินค้าหลังจากสั่งซื้อสำเร็จ
        unset($_SESSION['cart']);

        return $orderId; // ส่งคืน ID ของคำสั่งซื้อ
    }

    // คำนวณยอดรวมของสินค้าทั้งหมดในตะกร้า
    public static function calculateTotal() {
        $total = 0;
        if (isset($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $item) {
                $total += $item['price'] * $item['quantity'];
            }
        }
        return $total;
    }

    // แสดงตะกร้าสินค้า
    public function showCart() {
        include 'views/templates/header.php';
        include 'views/cart.php';
        include 'views/templates/footer.php';
    }

    public function checkout() {
        // ตรวจสอบว่าเข้าสู่ระบบหรือไม่
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login'); // ถ้ายังไม่ได้เข้าสู่ระบบให้พาไปที่หน้า Login
            exit();
        }
    
        include 'views/templates/header.php';
        include 'views/checkout.php';
        include 'views/templates/footer.php';
    }
    
    public function processCheckout() {
        global $db;
    
        // ตรวจสอบว่าเข้าสู่ระบบหรือไม่
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit();
        }
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_SESSION['user_id'];
            $shippingName = $_POST['shipping_name'];
            $shippingAddress = $_POST['shipping_address'];
            $shippingPhone = $_POST['shipping_phone'];
            $paymentMethod = $_POST['payment_method'];
    
            // บันทึกข้อมูลคำสั่งซื้อในตาราง orders
            $query = "INSERT INTO orders (user_id, total, shipping_name, shipping_address, shipping_phone, payment_method) VALUES (:user_id, :total, :shipping_name, :shipping_address, :shipping_phone, :payment_method)";
            $stmt = $db->prepare($query);
            $total = CartController::calculateTotal();
            $stmt->bindParam(':user_id', $userId);
            $stmt->bindParam(':total', $total);
            $stmt->bindParam(':shipping_name', $shippingName);
            $stmt->bindParam(':shipping_address', $shippingAddress);
            $stmt->bindParam(':shipping_phone', $shippingPhone);
            $stmt->bindParam(':payment_method', $paymentMethod);
    
            if ($stmt->execute()) {
                // บันทึกรายการสินค้าที่อยู่ในตะกร้าในตาราง order_items
                $orderId = $db->lastInsertId();
    
                foreach ($_SESSION['cart'] as $productId => $item) {
                    $query = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (:order_id, :product_id, :quantity, :price)";
                    $stmt = $db->prepare($query);
                    $stmt->bindParam(':order_id', $orderId);
                    $stmt->bindParam(':product_id', $productId);
                    $stmt->bindParam(':quantity', $item['quantity']);
                    $stmt->bindParam(':price', $item['price']);
                    $stmt->execute();
                }
    
                // ล้างตะกร้าหลังจากการสั่งซื้อสำเร็จ
                unset($_SESSION['cart']);
    
                // Redirect ไปยังหน้าขอบคุณ
                header('Location: /thankyou');
            } else {
                echo "Error processing order.";
            }
        }
    }    
}