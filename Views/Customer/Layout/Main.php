<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
switch ($page) {
    case 'home':
        include '../Customer/home.php';
        break;
    case 'history':
        include '../Customer/history.php';
        break;
    case 'coupon':
        include '../Customer/coupon.php';
        break;
    default:
        include '404.php';
        break;
}
