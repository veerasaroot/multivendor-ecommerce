<?php
class AuthController
{
    public function register() {
        global $db;
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // เข้ารหัสรหัสผ่าน
    
            // ตรวจสอบว่าอีเมลมีอยู่ในฐานข้อมูลหรือไม่
            $query = "SELECT * FROM users WHERE email = :email";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
    
            if ($stmt->rowCount() > 0) {
                $error = "This email is already registered.";
            } else {
                // บันทึกผู้ใช้ใหม่ลงฐานข้อมูล
                $query = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
                $stmt = $db->prepare($query);
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':password', $password);
    
                if ($stmt->execute()) {
                    header('Location: /login');
                } else {
                    $error = "Error registering user.";
                }
            }
        }
    
        include 'views/templates/header.php';
        include 'views/register.php';
        include 'views/templates/footer.php';
    }    

    public function login() {
        global $db;
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
    
            // ตรวจสอบข้อมูลผู้ใช้จากฐานข้อมูล
            $query = "SELECT * FROM users WHERE email = :email";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($user && password_verify($password, $user['password'])) {
                // สร้าง session สำหรับผู้ใช้
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                header('Location: /');
            } else {
                $error = "Invalid email or password.";
            }
        }
    
        include 'views/templates/header.php';
        include 'views/login.php';
        include 'views/templates/footer.php';
    }
    

    public function logout()
    {
        // ลบ session ทั้งหมดเพื่อออกจากระบบ
        session_unset();
        session_destroy();
        header('Location: /login');
    }
}
?>