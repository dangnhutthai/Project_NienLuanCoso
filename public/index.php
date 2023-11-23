<?php
session_start();
require '../bootstrap.php';

if (isset($_GET['controller']) && ($_GET['controller'] == 'login' || $_GET['controller'] == 'signup')) {
    include_once '../view/user/partials/header.php';
    include_once '../view/user/partials/main.php';
} else {
    include_once '../view/user/partials/header.php';
    include_once '../view/user/partials/nav.php';
    include_once '../view/user/partials/main.php';
    include_once '../view/user/partials/footer.php';
}
