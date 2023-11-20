<?php

if (isset($_GET['controller'])) {
    $main = $_GET['controller'];
} else {
    $main = '';
}

if ($main == '' || $main == 'home') {
    include_once __DIR__ . '/../user/home.php';
} elseif ($main == 'favproduct') {
    include_once __DIR__ . '/../user/favproduct.php';
} elseif ($main == 'cart') {
    include_once __DIR__ . '/../user/cart.php';
} elseif ($main == 'details') {
    include_once __DIR__ . '/../user/details.php';
} elseif ($main == 'login') {
    include_once __DIR__ . '/../user/login.php';
} elseif ($main == 'signup') {
    include_once __DIR__ . '/../user/signup.php';
} elseif ($main == 'search') {
    include_once __DIR__ . '/../user/search.php';
} elseif ($main == 'category') {
    include_once __DIR__ . '/../user/categories.php';
} elseif ($main == 'account') {
    include_once __DIR__ . '/../user/account.php';
} elseif ($main == 'changepw') {
    include_once __DIR__ . '/../user/changepw.php';
}elseif ($main == 'confirm_order') {
    include_once __DIR__ . '/../user/confirmorder.php';
} elseif ($main == 'pay') {
    include_once __DIR__ . '/../user/pay.php';
} elseif ($main == 'thanks') {
    include_once __DIR__ . '/../user/thanks.php';
} elseif ($main == 'contact') {
    include_once __DIR__ . '/../user/contact.php';
} elseif ($main == 'introduce') {
    include_once __DIR__ . '/../user/introduce.php';
}

?>