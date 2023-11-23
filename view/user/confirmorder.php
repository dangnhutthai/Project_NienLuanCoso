<?php

require_once("../bootstrap.php");
$id_user = $_SESSION['iduser'];
$sql_select_acc = "SELECT * FROM tbl_user WHERE id_user = ?";
$stmt = $pdo->prepare($sql_select_acc);
$stmt->execute([
    $id_user
]);
$row = $stmt->fetch();
?>
<form id="changeacc" action="./model/accounts/handle.php?iduser=<?= htmlspecialchars($id_user) ?>" method="post">
    <div class="container">
        <div class="row my-4">
            <div class="d-flex position-absolute mt-2">
                <a class="btn login-btn" href="index.php?controller=cart"><i class="fa-solid fa-backward" style="color: #ffffff;"></i></a>
            </div>
            <div class="d-inline-flex p-2 justify-content-center">
                <h2 class="title rounded-pill py-2 px-4 my-2 text-white ">Xác nhận đơn hàng</h2>
            </div>
            <div class="col-sm-7 offset-sm-3">
                <div class="card my-5">
                    <div class="card-header text-center">
                        <h3>Thông tin người nhận</h3>
                    </div>
                    <div class="card-body">
                        <form id="signupForm">
                            <div class="form-group row">
                                <label class="col-sm-4 offset-1 col-form-label" for="changeusername">Tên người nhận</label>
                                <div class="col-sm-5">
                                    <input type="text" required class="form-control" id="changeusername" name="changeusername" value="<?= htmlspecialchars($row['hovaten']) ?>" />
                                </div>
                            </div>

                            <div class="form-group row my-2">
                                <label class="col-sm-4 offset-1 col-form-label" for="changephone">Số điện thoại người nhận</label>
                                <div class="col-sm-5">
                                    <input type="text" required class="form-control" id="changephone" name="changephone" value="<?= htmlspecialchars($row['sodienthoai']) ?>" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 offset-1 col-form-label" for="changeaddress">Địa chỉ giao hàng</label>
                                <div class="col-sm-5">
                                    <input type="text" required class="form-control w-100" id="changeaddress" name="changeaddress" value="<?= htmlspecialchars($row['diachi']) ?>" />
                                </div>
                            </div>
                            <div class="row my-1">
                                <div class="col-sm-5 offset-sm-4 text-center my-2">
                                    <button type="submit" class="login-btn py-2 px-3" name="updateacc">
                                        Cập nhật thông tin
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</form>

<div class="container mb-4">
    <table class="table table-bordered">
        <thead class="text-center">
            <tr>
                <th>STT</th>
                <th>Tên sản phẩm</th>
                <th class="w-25">Hình ảnh</th>
                <th>Loại</th>
                <th>Giá tiền</th>
                <th>Số lượng</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $thanhtien = 0;
            $tongtien = 0;
            $i = 0;
            if (isset($_SESSION['cart'])) :

                foreach ($_SESSION['cart'] as $cart_item) :
                    $id_sanpham = $cart_item['id_sanpham'];
                    $id_danhmuc = $cart_item['id_danhmuc'];
                    $sql_product = "SELECT * FROM tbl_sanpham, tbl_danhmuc WHERE tbl_sanpham.id_danhmuc = tbl_danhmuc.id_danhmuc AND tbl_sanpham.id_sanpham = $id_sanpham";
                    $stmt = $pdo->prepare($sql_product);
                    $stmt->execute();
                    $product = $stmt->fetch();
                    $thanhtien = $cart_item['gia_sale'] * $cart_item['soluong'];
                    $tongtien += $thanhtien;
                    $i++;
            ?>
                    <tr class="text-center">
                        <th><?= $i ?></th>
                        <td> <?= htmlspecialchars($cart_item['tensanpham']) ?> </td>
                        <td> <img class="img-thumbnail w-50" src="src/images/<?= htmlspecialchars($cart_item['hinhanh']) ?>" alt=""> </td>
                        <td> <?= htmlspecialchars($product['tendanhmuc'])  ?> </td>
                        <td> <?= htmlspecialchars(number_format($cart_item['gia_sale'], 0, ',', '.') . ' VND') ?> </td>
                        <td> <?= htmlspecialchars($cart_item['soluong']) ?> </td>
                        <td> <?= htmlspecialchars(number_format($thanhtien, 0, ',', '.')) . 'VND' ?> </td>
                    </tr>
        </tbody>


<?php endforeach;
            endif;
?>
    </table>
    <div class="row">
        <div class="col d-flex flex-row-reverse">
            <strong class="order-1 m-0 pt-2 me-2 fs-4">Tổng tiền: <?= number_format($tongtien, 0, ',', ',') . ' VND' ?></strong>
            <button class="login-btn py-2 px-3" name="agree"><a class="text-decoration-none text-white" href="index.php?controller=pay">Xác nhận</a></button>
        </div>
    </div>



</div>
<script src="js/script.js">
</script>