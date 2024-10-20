<?php
// โหลดระบบภาษา
require 'config/language.php';
// โหลด helpers.php
require 'config/helpers.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minimal Ecommerce</title>
    <!-- ใช้ base_url() ในการสร้างเส้นทางแบบไดนามิก -->
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/bootstrap/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="<?php echo base_url(); ?>"><?php echo $lang_data['home']; ?></a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="<?php echo base_url('products'); ?>"><?php echo $lang_data['products']; ?></a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo base_url('cart'); ?>"><?php echo $lang_data['cart']; ?></a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item"><a class="nav-link" href="<?php echo base_url('profile'); ?>"><?php echo $_SESSION['username']; ?></a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo base_url('logout'); ?>"><?php echo $lang_data['logout']; ?></a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="<?php echo base_url('login'); ?>"><?php echo $lang_data['login']; ?></a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo base_url('register'); ?>"><?php echo $lang_data['register']; ?></a></li>
                <?php endif; ?>
            </ul>
            <div class="ms-3">
                <a href="?lang=en" class="btn btn-outline-primary btn-sm">EN</a>
                <a href="?lang=th" class="btn btn-outline-primary btn-sm">TH</a>
            </div>
        </div>
    </div>
</nav>

