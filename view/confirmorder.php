<?php

require_once("../bootstrap.php");
$id_acc = $_SESSION['iduser'];
$sql_select_acc = "SELECT * FROM accounts WHERE id_acc = ?";
$stmt = $pdo->prepare($sql_select_acc);
$stmt->execute([
    $id_acc
]);
$row = $stmt->fetch();
?>
<form id="changeacc" action="./model/orders/handle.php?id_user=<?= htmlspecialchars($id_acc) ?>" method="post">
    <div class="container dangky">
        <div class="row my-5">
            <div class="col-sm-7 offset-sm-3 my-5">
                <div class="card my-5">
                    <div class="card-header text-center">
                        <h3>Thông tin người nhận</h3>
                    </div>
                    <div class="card-body">
                        <form id="signupForm" method="post" class="form-horizontal" action="model/accounts/handle.php">
                            <div class="form-group row">
                                <label class="col-sm-4 offset-1 col-form-label" for="changeusername">Tên người nhận</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="changeusername" name="changeusername" value="<?= htmlspecialchars($row['name']) ?>" />
                                </div>
                            </div>

                            <div class="form-group row my-2">
                                <label class="col-sm-4 offset-1 col-form-label" for="changephone">Số điện thoại người nhận</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="changephone" name="changephone" value="<?= htmlspecialchars($row['phone']) ?>" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 offset-1 col-form-label" for="changeaddress">Địa chỉ giao hàng</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control w-100" id="changeaddress" name="changeaddress" value="<?= htmlspecialchars($row['address']) ?>" />
                                </div>
                            </div>

                            <div class="row my-1">
                                <div class="col-sm-5 offset-sm-4 text-center">
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

<div class="container my-4">
    <h3 class="text-center">Xác nhận đơn hàng</h3>
    <table class="table table-bordered">
        <thead class="text-center">
            <tr>
                <th>STT</th>
                <th>Tên sản phẩm</th>
                <th class="w-25">Hình ảnh</th>
                <th>Size</th>
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
                    $id = $cart_item['id'];
                    $sql_product = "SELECT * FROM products WHERE id = $id LIMIT 1";
                    $stmt = $pdo->prepare($sql_product);
                    $stmt->execute();
                    $product = $stmt->fetch();
                    $thanhtien = $cart_item['price_sale'] * $cart_item['amount'];
                    $tongtien += $thanhtien;
                    $i++;
            ?>
                    <tr class="text-center">
                        <th><?= $i ?></th>
                        <td> <?= htmlspecialchars($cart_item['name']) ?> </td>
                        <td> <img class="img-thumbnail w-50" src="src/images/<?= htmlspecialchars($cart_item['image']) ?>" alt=""> </td>
                        <td> <?= htmlspecialchars($cart_item['size'])  ?> </td>
                        <td> <?= htmlspecialchars(number_format($cart_item['price_sale'], 0, ',', '.') . ' VND') ?> </td>
                        <td> <?= htmlspecialchars($cart_item['amount']) ?> </td>
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