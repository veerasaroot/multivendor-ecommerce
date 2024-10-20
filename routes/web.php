<?php
// ฟังก์ชัน handleRouting จะตรวจสอบเส้นทาง (route) และโหลดหน้าที่เกี่ยวข้อง
function handleRouting($url)
{
    switch ($url) {
        case '/':
            require 'controllers/HomeController.php';
            $homeController = new HomeController();
            $homeController->index();
            break;

        case 'products':
            require 'controllers/ProductController.php';
            $productController = new ProductController();
            $productController->listProducts();
            break;

        case (preg_match('/^product\/(\d+)$/', $url, $matches) ? true : false):
            require 'controllers/ProductController.php';
            $productController = new ProductController();
            $productController->showProduct($matches[1]);
            break;

        case 'cart':
            require 'controllers/CartController.php';
            $cartController = new CartController();
            $cartController->showCart();
            break;

        case 'cart/add':
            require 'controllers/CartController.php';
            $cartController = new CartController();
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $productId = $_POST['product_id'];
                $quantity = $_POST['quantity'] ?? 1;
                $cartController->addToCart($productId, $quantity);
            }
            header('Location: /cart');
            break;

        case 'cart/remove':
            require 'controllers/CartController.php';
            $cartController = new CartController();
            if (isset($_POST['product_id'])) {
                $productId = $_POST['product_id'];
                $cartController->removeFromCart($productId);
            }
            header('Location: /cart');
            break;

        case 'cart/checkout':
            require 'controllers/CartController.php';
            $cartController = new CartController();
            $userId = $_SESSION['user_id'] ?? 1; // จำลอง user_id สำหรับตัวอย่าง
            $orderId = $cartController->placeOrder($userId);
            if ($orderId) {
                echo "Order placed successfully. Your order ID is: $orderId";
            } else {
                echo "Failed to place order.";
            }
            break;
        case 'login':
            require 'controllers/AuthController.php';
            $authController = new AuthController();
            $authController->login();
            break;

        case 'register':
            require 'controllers/AuthController.php';
            $authController = new AuthController();
            $authController->register();
            break;

        case 'logout':
            require 'controllers/AuthController.php';
            $authController = new AuthController();
            $authController->logout();
            break;
        case 'checkout':
            require 'controllers/CartController.php';
            $cartController = new CartController();
            $cartController->checkout();
            break;

        case 'checkout/process':
            require 'controllers/CartController.php';
            $cartController = new CartController();
            $cartController->processCheckout();
            break;

        default:
            http_response_code(404);
            echo "404 - Page not found";
            break;
    }
}
