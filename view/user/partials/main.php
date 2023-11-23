<?php

if (isset($_GET['controller'])) {
    $main = $_GET['controller'];
} else {
    $main = '';
}

if ($main == '' || $main == 'home') {
    include_once __DIR__ . '/../home.php';
} elseif ($main == 'favproduct') {
    include_once __DIR__ . '/../favproduct.php';
} elseif ($main == 'cart') {
    include_once __DIR__ . '/../cart.php';
} elseif ($main == 'details') {
    include_once __DIR__ . '/../details.php';
} elseif ($main == 'login') {
    include_once __DIR__ . '/../login.php';
} elseif ($main == 'signup') {
    include_once __DIR__ . '/../signup.php';
} elseif ($main == 'search') {
    include_once __DIR__ . '/../search.php';
} elseif ($main == 'category') {
    include_once __DIR__ . '/../categories.php';
} elseif ($main == 'account') {
    include_once __DIR__ . '/../account.php';
} elseif ($main == 'changepw') {
    include_once __DIR__ . '/../changepw.php';
}elseif ($main == 'confirmorder') {
    include_once __DIR__ . '/../confirmorder.php';
} elseif ($main == 'pay') {
    include_once __DIR__ . '/../pay.php';
} elseif ($main == 'thanks') {
    include_once __DIR__ . '/../thanks.php';
} elseif ($main == 'tank') {
    include_once __DIR__ . '/../tank.php';
} elseif ($main == 'detailstank') {
    include_once __DIR__ . '/../detailstank.php';
} elseif ($main == 'introduce') {
    include_once __DIR__ . '/../introduce.php';
}

?>