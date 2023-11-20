<?php
session_start();
if (isset($_SESSION['dangnhap'])) {
    require '../../bootstrap.php';

include_once 'partials/header.php';
include_once 'partials/heading.php';
include_once 'partials/nav.php';
include_once 'partials/main.php';
include_once 'partials/footer.php';
} else {
    header('Location: ../index.php');
}


?>  

