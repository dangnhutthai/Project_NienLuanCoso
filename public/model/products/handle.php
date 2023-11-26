<?php

require '../../../bootstrap.php';



if (isset($_POST['addproduct'])) {
    $name = $_POST['name'];
    $code = $_POST['code'];
    $price = $_POST['price'];
    $price_sale = $_POST['price_sale'];
    $description = $_POST['description'];
    $content = $_POST['content'];
    $amount = $_POST['amount'];
    $idcate = $_POST['idcategory'];
    $image = $_FILES['image']['name'];
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
    header('Location: ../../admin.php?controller=product&action=index');
} elseif (isset($_POST['updateproduct'])) {
    $idproduct = $_GET['idproduct'];
    $name = $_POST['name'];
    $code = $_POST['code'];
    $price = $_POST['price'];
    $price_sale = $_POST['price_sale'];
    $description = $_POST['description'];
    $content = $_POST['content'];
    $amount = $_POST['amount'];
    $idcate = $_POST['idcategory'];
    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    if ($image != '') {
        move_uploaded_file($image_tmp, '../../src/images/' . $image);
        $sql_updateimage = "SELECT * FROM tbl_sanpham WHERE id_sanpham = ?";
        $stmt_image = $pdo->prepare($sql_updateimage);
        $stmt_image->execute([
            $idproduct
        ]);
        while ($row = $stmt_image->fetch()) {
            unlink('../../src/images/' . $row['hinhanh']);
        }
        $sql_update = "UPDATE tbl_sanpham SET tensanpham = ?,  masanpham = ?, gia = ?, noidung = ?,
        gia_sale= ?, soluong = ?, tomtat= ?, hinhanh= ?, id_danhmuc= ? WHERE id_sanpham = ?";
        $stmt_update = $pdo->prepare($sql_update);
        $stmt_update->execute([
            $name,
            $code,
            $price,
            $content,
            $price_sale,
            $amount,
            $description,
            $image,
            $idcate,
            $idproduct
        ]);
    } else {
        $sql_update = "UPDATE tbl_sanpham SET tensanpham = ?,  masanpham = ?, gia = ?, noidung = ?,
        gia_sale= ?, soluong = ?, tomtat= ?, id_danhmuc = ? WHERE id_sanpham = ?";
    $stmt_update = $pdo->prepare($sql_update);
    $stmt_update->execute([
        $name,
        $code,
        $price,
        $content,
        $price_sale,
        $amount,
        $description,
        $idcate,
        $idproduct
    ]);
}
    header('Location: ../../admin.php?controller=product&action=index');
} elseif (isset($_POST['deleteproduct'])) {
    $idproduct = $_GET['idproduct'];
    $sql_deleteimage = "SELECT * FROM tbl_sanpham WHERE id_sanpham = ?";
    $stmt_image = $pdo->prepare($sql_deleteimage);
    $stmt_image->execute([
        $idproduct
    ]);
    while ($row = $stmt_image->fetch()) {
        unlink('../../src/images/' . $row['hinhanh']);
    }
    $sql_delete = "DELETE FROM tbl_sanpham WHERE id_sanpham = ?";
    $stmt = $pdo->prepare($sql_delete);
    $stmt->execute([
        $idproduct
    ]);
    header('Location: ../../admin.php?controller=product&action=index');
} elseif (isset($_POST['addtank'])) {
    $name = $_POST['name'];
    $code = $_POST['code'];
    $price = $_POST['price'];
    $size = $_POST['size'];
    $amount = $_POST['amount'];
    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $sql_addproduct = "INSERT INTO tbl_mauho (tenmauho, mamauho, gia, kichthuoc, soluong, hinhanh) 
        VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql_addproduct);
    $stmt->execute([
        $name,
        $code,
        $price,
        $size,
        $amount,
        $image
    ]);
    move_uploaded_file($image_tmp, '../../src/images/' . $image);
    header('Location: ../../admin.php?controller=tank&action=index');
} elseif (isset($_POST['updatetank'])) {
    $idtank = $_GET['idtank'];
    $name = $_POST['name'];
    $code = $_POST['code'];
    $price = $_POST['price'];
    $size = $_POST['size'];
    $amount = $_POST['amount'];
    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    if ($image != '') {
        move_uploaded_file($image_tmp, '../../src/images/' . $image);
        $sql_updateimage = "SELECT * FROM tbl_mauho WHERE id_mauho = ?";
        $stmt_image = $pdo->prepare($sql_updateimage);
        $stmt_image->execute([
            $idtank
        ]);
        while ($row = $stmt_image->fetch()) {
            unlink('../../src/images/' . $row['hinhanh']);
        }
        $sql_update = "UPDATE tbl_mauho SET tenmauho = ?,  mamauho = ?, gia= ?, soluong = ?, kichthuoc = ?, hinhanh = ? WHERE id_mauho = ?";
        $stmt_update = $pdo->prepare($sql_update);
        $stmt_update->execute([
            $name,
            $code,
            $price,
            $amount,
            $size,
            $image,
            $idtank
        ]);
    } else {
        $sql_update = "UPDATE tbl_mauho SET tenmauho = ?,  mamauho = ?, gia= ?, kichthuoc = ?, soluong = ? WHERE id_mauho = ?";
        $stmt_update = $pdo->prepare($sql_update);
        $stmt_update->execute([
            $name,
            $code,
            $price,
            $size,
            $amount,
            $idtank
        ]);
    }

    header('Location: ../../admin.php?controller=tank&action=index');
}
