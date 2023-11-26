<?php

if (isset($_GET['controller']) && isset($_GET['action'])) {
    $main = $_GET['controller'];
    $action = $_GET['action'];
} else {
    $main = '';
    $action = 'index';

}

if ($main == '' || $main == 'product' && $action == 'index') {
    include_once '../view/admin/product.php';
} elseif ( $main == 'product' && $action == 'add') {
    include_once '../view/admin/addproduct.php';
} elseif ( $main == 'product' && $action == 'update') {
    include_once '../view/admin/updateproduct.php';
} elseif ( $main == 'category' && $action == 'index') {
    include_once '../view/admin/category.php';
} elseif ( $main == 'category' && $action == 'add') {
    include_once '../view/admin/addcategory.php';
} elseif ( $main == 'account' && $action == 'index') {
    include_once '../view/admin/manageaccounts.php';
} elseif ( $main == 'category' && $action == 'update') {
    include_once '../view/admin/updatecategory.php';
} elseif ( $main == 'order' && $action == 'index') {
    include_once '../view/admin/order.php';
} elseif ( $main == 'order' && $action == 'check') {
    include_once '../view/admin/orderdetails.php';
} elseif ( $main == 'search' && $action == 'index') {
    include_once '../view/admin/search.php';
} elseif ( $main == 'statistic' && $action == 'index') {
    include_once '../view/admin/statistic.php';
} elseif ( $main == 'tank' && $action == 'index') {
    include_once '../view/admin/tank.php';
} elseif ( $main == 'tank' && $action == 'update') {
    include_once '../view/admin/updatetank.php';
} elseif ( $main == 'tank' && $action == 'add') {
    include_once '../view/admin/addtank.php';
}

?>