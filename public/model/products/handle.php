<?php

require '../../../bootstrap.php';



if (isset($_POST['addproduct'])) {
    $name = htmlspecialchars($_POST['name']);
    $code = htmlspecialchars($_POST['code']);
    $price = htmlspecialchars($_POST['price']);
    $price_sale = htmlspecialchars($_POST['price_sale']);
    $description = htmlspecialchars($_POST['description']);
    $content = htmlspecialchars($_POST['content']);
    $amount = htmlspecialchars($_POST['amount']);
    $idcate = htmlspecialchars($_POST['idcategory']);
    $image = htmlspecialchars($_FILES['image']['name']);
    $image_tmp = $_FILES['image']['tmp_name'];
    $sql_addproduct = "INSERT INTO tbl_sanpham (tensanpham, masanpham, gia, gia_sale, tomtat, noidung, soluong, id_danhmuc, hinhanh) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql_addproduct);
    $stmt->execute([
        $name,
        $code,
        $price,
        $price_sale,
        $description,
        $content,
        $amount,
        $idcate,
        $image
    ]);
    move_uploaded_file($image_tmp, '../../src/images/' . $image);
    header('Location: ../../admin/admin.php?controller=product&action=index');
} elseif (isset($_POST['updateproduct'])) {
    $name = htmlspecialchars($_POST['name']);
    $code = htmlspecialchars($_POST['code']);
    $price = htmlspecialchars($_POST['price']);
    $price_sale = htmlspecialchars($_POST['price_sale']);
    $description = htmlspecialchars($_POST['description']);
    $content = htmlspecialchars($_POST['content']);
    $amount = htmlspecialchars($_POST['amount']);
    $idcate = htmlspecialchars($_POST['idcategory']);
    $image = htmlspecialchars($_FILES['image']['name']);
    $image_tmp = $_FILES['image']['tmp_name'];
    if ($image != '') {
        move_uploaded_file($image_tmp, '../../src/images/' . $image);
        $sql_updateimage = "SELECT * FROM tbl_sanpham WHERE id_sanpham = '$_GET[idproduct]'";
        $stmt_image = $pdo->prepare($sql_updateimage);
        $stmt_image->execute();
        while ($row = $stmt_image->fetch()) {
            unlink('../../src/images/' . $row['image']);
        }
        $sql_update = "UPDATE tbl_sanpham SET tensanpham='" . $name . "',  masanpham='" . $code . "', gia='" . $price . "', 
        gia_sale='" . $price_sale . "', soluong ='" . $amount . "', tomtat='" . $description . "', hinhanh='" . $image . "', id_danhmuc='" . $id_brand . "' ";
    } else {
        $sql_update = "UPDATE tbl_sanpham SET tensanphame='" . $name . "',  masanpham='" . $code . "', gia='" . $price . "', 
        gia_sale='" . $price_sale . "', soluong ='" . $amount . "', tomtat='" . $description . "', id_danhmuc ='" . $id_brand . "' WHERE id_sanpham = '$_GET[idproduct]'";
    }
    $stmt_update = $pdo->prepare($sql_update);
    $stmt_update->execute();
    header('Location: ../../admin/admin.php?controller=product&action=index');

} else {
    $sql_deleteimage = "SELECT * FROM tbl_sanpham WHERE id_sanpham = '$_GET[idproduct]'";
    $stmt_image = $pdo->prepare($sql_deleteimage);
    $stmt_image->execute();
    while ($row = $stmt_image->fetch()) {
        unlink('../../src/images/' . $row['image']);
    }
    $sql_delete = "DELETE FROM tbl_sanpham WHERE id_sanpham = '$_GET[idproduct]'";
    $stmt = $pdo->prepare($sql_delete);
    $stmt->execute();
    header('Location: ../../admin/admin.php?controller=product&action=index');
}
