<?php
// --------------------------------------
// base_url จะถูกเรียกใช้งาน
// เพื่อป้องกันการเปิดข้อผิดพลาดเมื่อใช้ XAMPP
// --------------------------------------
// ฟังก์ชันสำหรับสร้าง Base URL แบบไดนามิก
function base_url($path = '') {
    // ตรวจสอบว่าใช้งาน HTTPS หรือ HTTP
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://";
    // $_SERVER['HTTP_HOST'] = localhost
    $host = $_SERVER['HTTP_HOST'];
    // เอาเฉพาะเส้นทางของแอป เช่น /multivendor-ecommerce/
    $appPath = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/';
    // กำจัด / ที่ซ้ำซ้อนระหว่าง base URL และ path
    return $protocol . $host . $appPath . ltrim($path, '/');
}