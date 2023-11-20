<?php

if (isset($_GET['controller']) && isset($_GET['action'])) {
    $main = $_GET['controller'];
    $action = $_GET['action'];
} else {
    $main = '';
    $action = 'index';

}

if ($main == '' || $main == 'product' && $action == 'index') {
    include_once '../../view/product.php';
} elseif ( $main == 'product' && $action == 'add') {
    include_once '../../view/addproduct.php';
} elseif ( $main == 'product' && $action == 'update') {
    include_once '../../view/updateproduct.php';
} elseif ( $main == 'brand' && $action == 'index') {
    include_once '../../view/brand.php';
} elseif ( $main == 'brand' && $action == 'add') {
    include_once '../../view/addbrand.php';
} elseif ( $main == 'account' && $action == 'index') {
    include_once '../../view/manageaccounts.php';
} elseif ( $main == 'brand' && $action == 'update') {
    include_once '../../view/updatebrand.php';
} elseif ( $main == 'order' && $action == 'index') {
    include_once '../../view/order.php';
} elseif ( $main == 'order' && $action == 'check') {
    include_once '../../view/orderdetails.php';
}

?>