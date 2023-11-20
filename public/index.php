<?php
session_start();
require '../bootstrap.php';

if (isset($_GET['controller']) && ($_GET['controller'] == 'login' || $_GET['controller'] == 'signup')) {
    include_once '../view/partials/header.php';
    include_once '../view/partials/main.php';
    include_once '../view/partials/footer.php';
} else {
    include_once '../view/partials/header.php';
    include_once '../view/partials/nav.php';
    include_once '../view/partials/main.php';
    include_once '../view/partials/footer.php';
}
