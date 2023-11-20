<?php
session_start();
require_once('../../../bootstrap.php');

if (isset($_POST['addcart'])) {
    // session_destroy();
    $id = htmlspecialchars($_GET['idproduct']);
    $size = $_POST['size'];
    $sql_addcart = "SELECT * FROM products WHERE id='$id' LIMIT 1";
    $stmt = $pdo->prepare($sql_addcart);
    $stmt->execute();
    // $row = $stmt->fetchAll();
    // print_r($row);
    // echo "<pre>";
    // print_r($row[0]['name']);
    if ($row = $stmt->fetch()) {
        $new_product[] = array(
            'id' => $id, 'name' => $row['name'], 'size' => $size, 'amount' => 1, 'code' => $row['code'],
            'price' => $row['price'], 'price_sale' => $row['price_sale'], 'description' => $row['description'], 'image' => $row['image'], 'id_brand' => $row['id_brand']
        );
        if (isset($_SESSION['cart'])) {
            $found = false;
            foreach ($_SESSION['cart'] as $cart_item) {
                if ($cart_item['id'] == $id) {
                    $amount = $cart_item['amount'];
                    $product[] = array(
                        'id' => $cart_item['id'], 'name' => $cart_item['name'], 'amount' => $amount + 1, 'code' => $cart_item['code'], 'size' => $size ,
                        'price' => $cart_item['price'], 'price_sale' => $cart_item['price_sale'], 'description' => $cart_item['description'], 'image' => $cart_item['image'], 'id_brand' => $cart_item['id_brand']
                    );
                    $found = true;
                } else {
                    $product[] = array(
                        'id' => $cart_item['id'], 'name' => $cart_item['name'], 'amount' => $cart_item['amount'], 'code' => $cart_item['code'], 'size' => $cart_item['size'],
                        'price' => $cart_item['price'], 'price_sale' => $cart_item['price_sale'], 'description' => $cart_item['description'], 'image' => $cart_item['image'], 'id_brand' => $cart_item['id_brand']
                    );
                }
            }
            if ($found == false) {
                $_SESSION['cart'] = array_merge($product, $new_product);
            } else {

                $_SESSION['cart'] = $product;
            }
        } elseif (!$_SESSION['cart']) {
            $_SESSION['cart'] = $new_product;
        }
    }

    echo "<pre>";
    print_r($_SESSION["cart"]);
    echo '<script>window.open("../../index.php?controller=cart","_self")</script>';
}
if (isset($_POST['deletecart'])) {
    $id = $_GET['idproduct'];
    if ($id == 'all') {
        unset($_SESSION['cart']);
        echo '<script>alert("Xóa tất cả sản phẩm thành công")</script>';
        echo '<script>window.open("../../index.php?controller=cart","_self")</script>';
    } else {
        foreach ($_SESSION['cart'] as $cart_item) {
            if ($cart_item['id'] != $id) {
                $product[] = array(
                    'id' => $cart_item['id'], 'name' => $cart_item['name'], 'amount' => $cart_item['amount'], 'size' => $cart_item['size'], 'code' => $cart_item['code'],
                    'price' => $cart_item['price'], 'price_sale' => $cart_item['price_sale'], 'description' => $cart_item['description'], 'image' => $cart_item['image'], 'id_brand' => $cart_item['id_brand']
                );
            }
            $_SESSION['cart'] = $product;
            echo '<script>alert("Xóa sản phẩm thành công")</script>';
            echo '<script>window.open("../../index.php?controller=cart","_self")</script>';
        }
    }
}

if (isset($_POST['updatecart'])) {
    $id = $_GET['idproduct'];
    $amount = $_POST['amount'];
    $size = $_POST['size'];
    $i = 0;
    $count = count($_SESSION['cart']);
    foreach ($_SESSION['cart'] as $cart_item) {
        if ($cart_item['id'] == $id) {
            $update_product[] = array(
                'id' => $cart_item['id'], 'name' => $cart_item['name'], 'amount' => $amount, 'size' => $size, 'code' => $cart_item['code'],
                'price' => $cart_item['price'], 'price_sale' => $cart_item['price_sale'], 'description' => $cart_item['description'], 'image' => $cart_item['image'], 'id_brand' => $cart_item['id_brand']
            );
        } else {
            $product[] = array(
                'id' => $cart_item['id'], 'name' => $cart_item['name'], 'amount' => $cart_item['amount'], 'size' => $cart_item['size'], 'code' => $cart_item['code'],
                'price' => $cart_item['price'], 'price_sale' => $cart_item['price_sale'], 'description' => $cart_item['description'], 'image' => $cart_item['image'], 'id_brand' => $cart_item['id_brand']
            );
        }
    }
    if ($count == 1) {
        $_SESSION['cart'] = $update_product;
    } else {
        $_SESSION['cart'] = array_merge($update_product, $product);
    }
    // print_r ($_SESSION['cart']);
    echo '<script>alert("Cập nhật sản phẩm thành công")</script>';
    echo '<script>window.open("../../index.php?controller=cart","_self")</script>';
}

if (isset($_POST['favorite'])) {
    $idproduct = $_GET['idproduct'];
    $iduser = $_SESSION['iduser'];
    $sql_addfav = "SELECT * FROM tbl_user WHERE id_user = '$iduser' LIMIT 1";
    $stmt_addfav = $pdo->prepare($sql_addfav);
    $stmt_addfav->execute();
    $row_addfav = $stmt_addfav->fetch();
    $sql_pro = "SELECT * FROM tbl_sanpham WHERE id_sanpham = '$idproduct' LIMIT 1";
    $stmt_pro = $pdo->prepare($sql_pro);
    $stmt_pro->execute();
    $row_pro = $stmt_pro->fetch();
    $code = $row_pro['masanpham'];
    if ($row_addfav['pro_fav'] == '') {
        $sql_fav = "UPDATE tbl_user SET pro_fav = ? WHERE id_user = $iduser LIMIT 1";
        $stmt_fav = $pdo->prepare($sql_fav);
        $stmt_fav->execute([
            $code
        ]);
        echo '<script>alert("Đã thêm ' . $row_pro['tensanpham'] . ' vào yêu thích!")</script>';
        echo '<script>window.open("/","_self")</script>';
    } elseif (substr_count($row_addfav['pro_fav'], $row_pro['masanpham']) == 0) {
        $str = $row_addfav['pro_fav'];
        $str_fav = $str.$row_pro['masanpham'];
        $sql_fav = "UPDATE tbl_user SET pro_fav = ? WHERE id_user = $iduser LIMIT 1";
        $stmt_fav = $pdo->prepare($sql_fav);
        $stmt_fav->execute([
            $str_fav
        ]);
        echo '<script>alert("Đã thêm ' . $row_pro['tensanpham'] . ' vào yêu thích!")</script>';
        echo '<script>window.open("/","_self")</script>';
        
    } else {
        $str = $row_addfav['pro_fav'];
        $str_fav = str_replace($row_pro['masanpham'], '', $str);
        $sql_fav = "UPDATE tbl_user SET pro_fav = ? WHERE id_user = $iduser LIMIT 1";
        $stmt_fav = $pdo->prepare($sql_fav);
        $stmt_fav->execute([
            $str_fav
        ]);
        echo '<script>alert("Đã xóa ' . $row_pro['tensanpham'] . ' khỏi yêu thích!")</script>';
        echo '<script>window.open("/","_self")</script>';
    }
}
