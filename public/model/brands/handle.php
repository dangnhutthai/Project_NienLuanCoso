<?php 

require '../../../bootstrap.php';


if (isset($_POST['addbrand'])) {
    $namebrand = htmlspecialchars($_POST['namebrand']);
    $sql_addbrand = "INSERT INTO brands (brand) VALUES ('$namebrand')";
    $stmt = $pdo->prepare($sql_addbrand);
    $stmt->execute();
    header('Location: ../../admin/admin.php?controller=brand&action=index');

} elseif (isset($_POST['deletebrand'])) {
    $idbrand = htmlspecialchars($_GET['idbrand']);
    $sql_deletebrand = "DELETE FROM brands WHERE id_brand = '$idbrand'";
    $stmt = $pdo->prepare($sql_deletebrand);
    $stmt->execute();
    header('Location: ../../admin/admin.php?controller=brand&action=index');
} elseif (isset($_POST['updatebrand'])) {
    $idbrand = htmlspecialchars($_GET['id_brand']);
    $brand = htmlspecialchars($_POST['brand']);
    $sql_updatebrand = "UPDATE brands SET brand = ? WHERE id_brand = ?";
    $stmt = $pdo->prepare($sql_updatebrand);
    $stmt->execute([
        $brand,
        $idbrand
    ]);
    echo "<script>alert('Cập nhật tên thương hiệu thành công')</script>";
    echo "<script>window.open('../../admin/admin.php?controller=brand&action=index', '_self')</script>";
}


?>