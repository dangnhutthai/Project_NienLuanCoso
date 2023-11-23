<?php 

require '../../../bootstrap.php';


if (isset($_POST['addcategory'])) {
    $tendanhmuc = htmlspecialchars($_POST['category']);
    $sql_addcate = "INSERT INTO tbl_danhmuc (tendanhmuc) VALUES ('$tendanhmuc')";
    $stmt = $pdo->prepare($sql_addcate);
    $stmt->execute();
    header('Location: ../../admin.php?controller=category&action=index');

} elseif (isset($_POST['deletecategory'])) {
    $idcate = htmlspecialchars($_GET['idcategory']);
    $sql_deletecate = "DELETE FROM tbl_danhmuc WHERE id_danhmuc= '$idcate'";
    $stmt = $pdo->prepare($sql_deletecate);
    $stmt->execute();
    header('Location: ../../admin.php?controller=category&action=index');
} elseif (isset($_POST['updatecategory'])) {
    $idcate = htmlspecialchars($_GET['idcategory']);
    $tendanhmuc = htmlspecialchars($_POST['tendanhmuc']);
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