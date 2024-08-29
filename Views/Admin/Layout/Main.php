<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
switch ($page) {
    case 'home':
        include '../Manager/EmployeeManager.php';
        break;
    case 'customer':
        include '../Manager/CustomerManager.php';
        break;
    case 'orders':
        include '../Manager/OrdersManager.php';
        break;
    case 'orders/?id=1':
        include '../Manager/orderDetail.php';
        break;
    case 'products':
        include '../Manager/ProductsManager.php';
        break;
    case 'importProduct':
        include '../Manager/importProducts.php';
        break;
    default:
        include '404.php';
        break;
}
