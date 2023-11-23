<?php

$id_acc = $_SESSION['iduser'];
$sql_selectacc = "SELECT * FROM tbl_user WHERE id_user = ?";
$stmt = $pdo->prepare($sql_selectacc);
$stmt->execute([
    $id_acc
]);
$row = $stmt->fetchAll();

 foreach ($row as $row) : 
?>

<div class="container-fluid">
    <div class="row">
        <h1 class="text-center my-3"><i class="fa-solid fa-cube fs-4" style="color: #000000;"></i> Thông tin tài khoản <i class="fa-solid fa-cube fs-4" style="color: #000000;"></i></h1>
        
        <div class="col-10 offset-1 border my-5">
            <div class="row">
                <div class="col-2">
                <div class="m-2">
                <a class="btn btn-success disabled w-100" href="">Tài khoản</a> 

                </div>
                <div class="m-2">
                    <a class="btn btn-success w-100" href="index.php?controller=changepw">Đổi mật khẩu</a> 
                </div>
                </div>
                <div class="col-3 fs-4">
                <p>
                    <strong>  Tên người dùng:</strong>
                </p> 
                <p>
                    <strong>  Địa chỉ:</strong>
                </p> <p>
                    <strong>  Số điện thoại:</strong>
                </p> <p>
                    <strong>  Email:</strong>
                </p> 
                </div>
                <div class="col-7 fs-4">
                <p>   <?= htmlspecialchars($row['tentaikhoan']) ?></p>
                <p> <?= htmlspecialchars($row['diachi']) ?></p>
                <p>    <?= htmlspecialchars($row['sodienthoai']) ?></p>
                <p> <?= htmlspecialchars($row['email']) ?></p>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach ?>
</div>