<?php
require_once '../bootstrap.php';

$id_user = $_SESSION['iduser'];
$sql_select_acc = "SELECT * FROM tbl_user WHERE id_user = ?";
$stmt = $pdo->prepare($sql_select_acc);
$stmt->execute([
    $id_user
]);
$row = $stmt->fetch();
$tongtien = 0;
foreach ($_SESSION['cart'] as $cart_item) :

    $thanhtien = $cart_item['gia_sale'] * $cart_item['soluong'];
    $tongtien += $thanhtien;
    $i++;
endforeach
?>

<div class="container">
    <div class="row text-center my-4">
        <div class="d-flex position-absolute mt-2">
            <a class="btn login-btn" href="index.php?controller=confirmorder"><i class="fa-solid fa-backward" style="color: #ffffff;"></i></a>
        </div>
        <div class="d-inline-flex p-2 justify-content-center">
            <h2 class="title rounded-pill py-2 px-4 my-2 text-white ">Xác nhận đơn hàng</h2>
        </div>
        <div class="col border me-2 ">
            <div class="row">
                <h3>Thông tin người nhận</h3>
                <div class="col-4 fs-4 text-start mt-2">
                    <p>
                        <strong> Tên người nhận:</strong>
                    </p>
                    <p>
                        <strong> Địa chỉ:</strong>
                    </p>
                    <p>
                        <strong> Số điện thoại:</strong>
                    </p>
                    <p>
                        <strong for="changeaddress"> Ghi chú:</strong>
                    </p>
                </div>
                <div class="col-8 fs-4 text-start mt-2">
                    <p> <?= htmlspecialchars($row['hovaten']) ?></p>
                    <p> <?= htmlspecialchars($row['diachi']) ?></p>
                    <p> <?= htmlspecialchars($row['sodienthoai']) ?></p>
                    <form action="model/orders/handle.php" method="POST" enctype="multipart/form-data">
                    <div class="col-sm-5 my-1">
                        <textarea rows="2" class="form-control" name="note" placeholder="Có gì căn dặn không ạ?"></textarea>
                    </div>
                </div>




            </div>

        </div>
        <div class="col-4 border">
            <h3 class="mb-3">Phương thức thanh toán</h3>

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
            <h3 class="mt-3 ">Tổng tiền: <?= number_format($tongtien, 0, ',', '.') . ' VND'; ?> </h3>
            <button class="login-btn py-2 px-3 my-2" type="submit" name="pay">Thanh toán</button>
            </form>
        </div>
    </div>
    <div class="row">
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
                            <td> <?= htmlspecialchars($product['tendanhmuc']) ?> </td>
                            <td> <?= htmlspecialchars(number_format($cart_item['gia_sale'], 0, ',', '.') . ' VND') ?> </td>
                            <td> <?= htmlspecialchars($cart_item['soluong']) ?> </td>
                            <td> <?= htmlspecialchars(number_format($thanhtien, 0, ',', '.')) . 'VND' ?> </td>
                        </tr>
            </tbody>


    <?php endforeach;
                endif;
    ?>
        </table>
    </div>
</div>