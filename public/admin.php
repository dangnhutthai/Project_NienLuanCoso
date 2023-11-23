<?php
session_start();
if (isset($_SESSION['dangnhap']) && !isset($_SESSION['iduser'])) {
    require '../bootstrap.php';

include_once '../view/admin/partials/header.php';
include_once '../view/admin/partials/heading.php';
include_once '../view/admin/partials/nav.php';
include_once '../view/admin/partials/main.php';
include_once '../view/admin/partials/footer.php';
} else {
    header('Location: index.php');
}


?>  

