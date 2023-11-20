<?php
require_once '../bootstrap.php';

$id_acc = $_SESSION['iduser'];
$sql_select_acc = "SELECT * FROM accounts WHERE id_acc = ?";
$stmt = $pdo->prepare($sql_select_acc);
$stmt->execute([
    $id_acc
]);
$row = $stmt->fetch();
?>

<div class="container">
    <div class="row text-center my-5">
        <div class="col border me-2 ">
            <div class="row">
                <h3>Thông tin người nhận</h3>



                <div class="col-4 fs-4 text-start">
                    <p>
                        <strong> Tên người nhận:</strong>
                    </p>
                    <p>
                        <strong> Địa chỉ:</strong>
                    </p>
                    <p>
                        <strong> Số điện thoại:</strong>
                    </p>
                </div>
                <div class="col-5 fs-4 text-start">
                    <p> <?= htmlspecialchars($row['name']) ?></p>
                    <p> <?= htmlspecialchars($row['address']) ?></p>
                    <p> <?= htmlspecialchars($row['phone']) ?></p>
                </div>

            </div>
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
                                <td> <?= htmlspecialchars($cart_item['size']) ?> </td>
                                <td> <?= htmlspecialchars(number_format($cart_item['price_sale'], 0, ',', '.') . ' VND') ?> </td>
                                <td> <?= htmlspecialchars($cart_item['amount']) ?> </td>
                                <td> <?= htmlspecialchars(number_format($thanhtien, 0, ',', '.')) . 'VND' ?> </td>
                            </tr>
                </tbody>


        <?php endforeach;
                    endif;
        ?>
            </table>
        </div>
        <div class="col-4 border">
            <h3 class="mb-3">Phương thức thanh toán</h3>
            <form action="model/orders/handle.php" method="POST" enctype="multipart/form-data">
                <div class=" row justify-content-center">
                    <div class="col-8 offset-2">
                        <div class="text-start">

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment" id="flexRadioDefault1 " checked value="tienmat">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    <i class="fa-solid fa-dollar-sign" style="color: #000000;"></i> Tiền mặt
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment" id="flexRadioDefault2" value="chuyenkhoan">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    <i class="fa-solid fa-credit-card" style="color: #000000;"></i> Chuyển khoản
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment" id="flexRadioDefault2" value="momo">
                                <img src="src/images/momo.png" width="40px" alt="" class="rounded">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Momo
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment" id="flexRadioDefault2" value="paypal">
                                <img src="src/images/paypal.png" width="40px" alt="">

                                <label class="form-check-label" for="flexRadioDefault2">
                                    Paypal
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <h3 class="mt-3 ">Tổng tiền: <?= number_format($tongtien, 0, ',','.'). ' VND'; ?> </h3>
                <button class="login-btn py-2 px-3 mt-2" type="submit" name="pay">Thanh toán</button>
            </form>
        </div>
    </div>
</div>