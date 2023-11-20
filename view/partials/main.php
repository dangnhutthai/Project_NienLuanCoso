<?php

if (isset($_GET['controller'])) {
    $main = $_GET['controller'];
} else {
    $main = '';
}

if ($main == '') {
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
} elseif ($main == 'brand') {
    include_once __DIR__ . '/../shoes.php';
} elseif ($main == 'account') {
    include_once __DIR__ . '/../account.php';
} elseif ($main == 'changepw') {
    include_once __DIR__ . '/../changepw.php';
}elseif ($main == 'confirm_order') {
    include_once __DIR__ . '/../confirmorder.php';
} elseif ($main == 'pay') {
    include_once __DIR__ . '/../pay.php';
} elseif ($main == 'thanks') {
    include_once __DIR__ . '/../thanks.php';
} elseif ($main == 'contact') {
    include_once __DIR__ . '/../contact.php';
} elseif ($main == 'introduce') {
    include_once __DIR__ . '/../introduce.php';
}

?>