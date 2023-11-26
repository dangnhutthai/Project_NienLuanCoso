<?php 

require '../../../bootstrap.php';


if (isset($_POST['addcategory'])) {
    $tendanhmuc = $_POST['category'];
    $sql_addcate = "INSERT INTO tbl_danhmuc (tendanhmuc) VALUES (?)";
    $stmt = $pdo->prepare($sql_addcate);
    $stmt->execute([
        $tendanhmuc
    ]);

    
    echo "<script>alert('Thêm tên loại thành công')</script>";
    header('Location: ../../admin.php?controller=category&action=index');
} elseif (isset($_POST['deletecategory'])) {
    $idcate = $_GET['idcategory'];
    $sql_deletecate = "DELETE FROM tbl_danhmuc WHERE id_danhmuc= ?";
    $stmt = $pdo->prepare($sql_deletecate);
    $stmt->execute([
        $idcate
    ]);
    echo "<script>alert('Xóa tên loại thành công')</script>";
    header('Location: ../../admin.php?controller=category&action=index');
} elseif (isset($_POST['updatecategory'])) {
    $idcate = $_GET['idcategory'];
    $tendanhmuc = $_POST['tendanhmuc'];
    $sql_updatecate = "UPDATE tbl_danhmuc SET tendanhmuc = ? WHERE id_danhmuc= ?";
    $stmt = $pdo->prepare($sql_updatecate);
    $stmt->execute([
        $tendanhmuc,
        $idcate
    ]);
    echo "<script>alert('Cập nhật tên loại thành công')</script>";
    echo "<script>window.open('../../admin.php?controller=category&action=index', '_self')</script>";
}


?>