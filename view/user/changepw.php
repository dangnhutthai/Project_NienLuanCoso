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

            <div class="col-6 offset-3 border my-5">
                <div class="row">
                    <div class="col-3">
                        <div class="m-2">
                            <a class="btn btn-success w-100" href="index.php?controller=account">Tài khoản</a>

                        </div>
                        <div class="m-2">
                            <a class="btn btn-success disabled w-100" href="index.php?controller=changpw">Đổi mật khẩu</a>
                        </div>
                    </div>
                    <div class="col-9 justify-content-center">
                        <h3 class="text-center">Đổi mật khẩu</h3>
                        <div class="d-flex justify-content-center">

                            <form id="changepwForm" action="model/accounts/handle.php" method="POST">
                                <input type="password" id="oldpassword" name="oldpassword" class="form-control" placeholder="Nhập mật khẩu cũ">
                                <input type="password" id="password" name="password" class="form-control my-2" placeholder="Nhập mật khẩu mới">
                                <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Xác nhận mật khẩu mới">
                                <button type="submit" name="changepw" class="login-btn my-3 p-2 ms-5">Xác nhận</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach ?>
    </div>
    <script src="js/script.js">

    </script>