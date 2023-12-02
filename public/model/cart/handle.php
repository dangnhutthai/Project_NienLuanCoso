<?php
session_start();
require_once('../../../bootstrap.php');

if (isset($_POST['addcart'])) {
    // session_destroy();
    $id_sanpham = htmlspecialchars($_GET['idproduct']);
    $sql_addcart = "SELECT * FROM tbl_sanpham WHERE id_sanpham  = ? LIMIT 1";
    $stmt = $pdo->prepare($sql_addcart);
    $stmt->execute([
        $id_sanpham
    ]);

    if ($row = $stmt->fetch()) {
        $new_product[] = array(
            'id_sanpham' => $id_sanpham, 'tensanpham' => $row['tensanpham'], 'soluong' => 1, 'masanpham' => $row['masanpham'], 'gia' => $row['gia'],
            'gia_sale' => $row['gia_sale'], 'tomtat' => $row['tomtat'], 'noidung' => $row['noidung'], 'hinhanh' => $row['hinhanh'], 'id_danhmuc' => $row['id_danhmuc']
        );
        if (isset($_SESSION['cart'])) {
            $found = false;
            foreach ($_SESSION['cart'] as $cart_item) {
                if ($cart_item['id_sanpham'] == $id_sanpham) {
                    $soluong = $cart_item['soluong'];
                    $product[] = array(
                        'id_sanpham' => $id_sanpham, 'tensanpham' => $cart_item['tensanpham'], 'soluong' => $soluong + 1, 'masanpham' => $cart_item['masanpham'], 'gia' => $cart_item['gia'],
                        'gia_sale' => $cart_item['gia_sale'], 'tomtat' => $cart_item['tomtat'], 'noidung' => $cart_item['noidung'], 'hinhanh' => $cart_item['hinhanh'], 'id_danhmuc' => $cart_item['id_danhmuc']
                    );
                    $found = true;
                } else {
                    $product[] = array(
                        'id_sanpham' => $cart_item['id_sanpham'], 'tensanpham' => $cart_item['tensanpham'], 'soluong' => $cart_item['soluong'], 'masanpham' => $cart_item['masanpham'], 'gia' => $cart_item['gia'],
                        'gia_sale' => $cart_item['gia_sale'], 'tomtat' => $cart_item['tomtat'], 'noidung' => $cart_item['noidung'], 'hinhanh' => $cart_item['hinhanh'], 'id_danhmuc' => $cart_item['id_danhmuc']
                    );
                }
            }
            if ($found == false) {
                $_SESSION['cart'] = array_merge($product, $new_product);
            } else {

                $_SESSION['cart'] = $product;
            }
        }  else {
            $_SESSION['cart'] = $new_product;
        }
    }

    echo '<script>window.open("../../index.php?controller=cart","_self")</script>';
} elseif (isset($_POST['deletecart'])) {
    $id_sanpham = $_GET['idproduct'];
    foreach ($_SESSION['cart'] as $cart_item) {
        if ($cart_item['id_sanpham'] != $id_sanpham) {
            $product[] = array(
                'id_sanpham' => $cart_item['id_sanpham'], 'tensanpham' => $cart_item['tensanpham'], 'soluong' => $cart_item['soluong'], 'masanpham' => $cart_item['masanpham'], 'gia' => $cart_item['gia'],
                'gia_sale' => $cart_item['gia_sale'], 'tomtat' => $cart_item['tomtat'], 'noidung' => $cart_item['noidung'], 'hinhanh' => $cart_item['hinhanh'], 'id_danhmuc' => $cart_item['id_danhmuc']
            );
        }
    }
    $_SESSION['cart'] = $product;
    echo '<script>alert("Xóa sản phẩm thành công")</script>';
    echo '<script>window.open("../../index.php?controller=cart","_self")</script>';
} elseif (isset($_POST['deleteall'])) {
    unset($_SESSION['cart']);
    echo '<script>alert("Xóa tất cả sản phẩm thành công")</script>';
    echo '<script>window.open("../../index.php?controller=cart","_self")</script>';
} elseif (isset($_POST['updatecart'])) {
    $id_sanpham = $_GET['idproduct'];
    $soluong = $_POST['soluong'];
    $i = 0;
    $count = count($_SESSION['cart']);
    foreach ($_SESSION['cart'] as $cart_item) {
        if ($cart_item['id_sanpham'] == $id_sanpham) {
            $update_product[] = array(
                'id_sanpham' => $id_sanpham, 'tensanpham' => $cart_item['tensanpham'], 'soluong' => $soluong, 'masanpham' => $cart_item['masanpham'], 'gia' => $cart_item['gia'],
                'gia_sale' => $cart_item['gia_sale'], 'tomtat' => $cart_item['tomtat'], 'noidung' => $cart_item['noidung'], 'hinhanh' => $cart_item['hinhanh'], 'id_danhmuc' => $cart_item['id_danhmuc']
            );
        } else {
            $product[] = array(
                'id_sanpham' => $cart_item['id_sanpham'], 'tensanpham' => $cart_item['tensanpham'], 'soluong' => $cart_item['soluong'], 'masanpham' => $cart_item['masanpham'], 'gia' => $cart_item['gia'],
                'gia_sale' => $cart_item['gia_sale'], 'tomtat' => $cart_item['tomtat'], 'noidung' => $cart_item['noidung'], 'hinhanh' => $cart_item['hinhanh'], 'id_danhmuc' => $cart_item['id_danhmuc']
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
} elseif (isset($_POST['favorite'])) {
    $idproduct = $_GET['idproduct'];
    $iduser = $_SESSION['iduser'];
    $sql_addfav = "SELECT * FROM tbl_user WHERE id_user = ? LIMIT 1";
    $stmt_addfav = $pdo->prepare($sql_addfav);
    $stmt_addfav->execute([
        $iduser
    ]);
    $row_addfav = $stmt_addfav->fetch();
    $sql_pro = "SELECT * FROM tbl_sanpham WHERE id_sanpham = ? LIMIT 1";
    $stmt_pro = $pdo->prepare($sql_pro);
    $stmt_pro->execute([
        $idproduct
    ]);
    $row_pro = $stmt_pro->fetch();
    $masanpham = $row_pro['masanpham'];
    if ($row_addfav['pro_fav'] == '') {
        $sql_fav = "UPDATE tbl_user SET pro_fav = ? WHERE id_user = ? LIMIT 1";
        $stmt_fav = $pdo->prepare($sql_fav);
        $stmt_fav->execute([
            $masanpham,
            $iduser
        ]);
        echo '<script>alert("Đã thêm ' . $row_pro['tensanpham'] . ' vào yêu thích!")</script>';
        echo '<script>window.open("/","_self")</script>';
    } elseif (substr_count($row_addfav['pro_fav'], $row_pro['masanpham']) == 0) {
        $str = $row_addfav['pro_fav'];
        $str_fav = $str . $row_pro['masanpham'];
        $sql_fav = "UPDATE tbl_user SET pro_fav = ? WHERE id_user = ? LIMIT 1";
        $stmt_fav = $pdo->prepare($sql_fav);
        $stmt_fav->execute([
            $str_fav,
            $iduser
        ]);
        echo '<script>alert("Đã thêm ' . $row_pro['tensanpham'] . ' vào yêu thích!")</script>';
        echo '<script>window.open("/","_self")</script>';
    } else {
        $str = $row_addfav['pro_fav'];
        $str_fav = str_replace($row_pro['masanpham'], '', $str);
        $sql_fav = "UPDATE tbl_user SET pro_fav = ? WHERE id_user = ? LIMIT 1";
        $stmt_fav = $pdo->prepare($sql_fav);
        $stmt_fav->execute([
            $str_fav,
            $iduser
        ]);
        echo '<script>alert("Đã xóa ' . $row_pro['tensanpham'] . ' khỏi yêu thích!")</script>';
        echo '<script>window.open("/","_self")</script>';
    }
} elseif (isset($_POST['buynow'])) {
    $id_sanpham = htmlspecialchars($_GET['idproduct']);
    $sql_addcart = "SELECT * FROM tbl_sanpham WHERE id_sanpham  = ? LIMIT 1";
    $stmt = $pdo->prepare($sql_addcart);
    $stmt->execute([
        $id_sanpham
    ]);

    if ($row = $stmt->fetch()) {
        $new_product[] = array(
            'id_sanpham' => $id_sanpham, 'tensanpham' => $row['tensanpham'], 'soluong' => 1, 'masanpham' => $row['masanpham'], 'gia' => $row['gia'],
            'gia_sale' => $row['gia_sale'], 'tomtat' => $row['tomtat'], 'noidung' => $row['noidung'], 'hinhanh' => $row['hinhanh'], 'id_danhmuc' => $row['id_danhmuc']
        );
    }
    $_SESSION['cart'] = $new_product;
    echo '<script>window.open("../../index.php?controller=confirmorder","_self")</script>';
}