<?php
// เริ่มต้น session และเชื่อมต่อกับฐานข้อมูล
session_start();
require 'config/database.php';
require 'routes/web.php'; // โหลดไฟล์ routing

// ตรวจสอบเส้นทาง (route) และเรียกหน้าที่ตรงกับเส้นทางนั้น
$url = isset($_GET['url']) ? $_GET['url'] : '/';
handleRouting($url);
