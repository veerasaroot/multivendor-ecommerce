<?php
// ตรวจสอบว่า Session ยังไม่ได้เริ่มต้น
if (session_status() == PHP_SESSION_NONE) {
    session_start();  // เริ่มต้น Session ถ้ายังไม่มีการเริ่ม
}

// ตั้งค่าเริ่มต้นเป็นภาษาอังกฤษ
if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'en'; // ค่าเริ่มต้นเป็นภาษาอังกฤษ
}

// ตรวจสอบว่าผู้ใช้เลือกเปลี่ยนภาษา
if (isset($_GET['lang'])) {
    $_SESSION['lang'] = $_GET['lang'];
}

// โหลดไฟล์ภาษา
$lang = $_SESSION['lang'];
$language_file = "languages/$lang.php";

if (file_exists($language_file)) {
    $lang_data = require $language_file;
} else {
    // กรณีไม่พบไฟล์ภาษา
    $lang_data = require 'languages/en.php'; // โหลดภาษาอังกฤษเป็นค่าเริ่มต้น
}
?>
