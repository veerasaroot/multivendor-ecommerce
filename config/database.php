<?php
// ตั้งค่าการเชื่อมต่อฐานข้อมูล
$host = 'localhost';         // ชื่อโฮสต์ (ปกติ localhost)
$dbname = 'ecommerce_db';    // ชื่อฐานข้อมูลของคุณ
$username = 'root';          // ชื่อผู้ใช้ฐานข้อมูล (ปกติ root)
$password = '';              // รหัสผ่านของฐานข้อมูล (ถ้าไม่มีให้เว้นว่าง)

try {
    // สร้างการเชื่อมต่อฐานข้อมูลด้วย PDO
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    // ตั้งค่าให้ PDO แสดงข้อผิดพลาดเมื่อมีปัญหา
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // แสดงข้อความเมื่อการเชื่อมต่อผิดพลาด
    echo "Database connection failed: " . $e->getMessage();
    exit;
}
?>
