<?php

require_once("../bootstrap.php");
// include_once ('../public/model/carts/handle.php');
// session_start();
?>


<div class="container my-4">
    <div class="row">

        <div class="d-inline-flex p-2 justify-content-center">
            <h2 class="title rounded-pill py-2 px-4 my-2 text-white ">Giỏ hàng</h2>
        </div>
    </div>
    <?php if (isset($_SESSION['cart'])) : ?>
        <form action="model/cart/handle.php?idproduct=all" method="post">
            <button onclick="return confirm('Bạn có muốn xóa tất cả sản phẩm trong giỏ hàng?');" type="submit" class="btn btn-danger mb-2" name="deleteall">
                <i class="fa-solid fa-trash-can" style="color: #ffffff;"></i> Xóa tất cả
            </button>
        </form>

    <?php endif ?>
    <table class="table table-bordered my-5">
        <thead>
            <tr>
                <th>STT</th>
                <th>Mã</th>
                <th>Tên sản phẩm</th>
                <th class="w-25">Hình ảnh</th>
                <th>Giá tiền</th>
                <th>Số lượng</th>
                <th>Thành tiền</th>
                <th>Quản lý</th>
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
                    $sql_product = "SELECT * FROM tbl_sanpham WHERE id_sanpham = $id_sanpham LIMIT 1";
                    $stmt = $pdo->prepare($sql_product);
                    $stmt->execute();
                    $product = $stmt->fetch();
                    $thanhtien = $cart_item['gia_sale'] * $cart_item['soluong'];
                    $tongtien += $thanhtien;
                    $i++;
            ?>
                    <tr>
                        <form action="./model/cart/handle.php?idproduct=<?= htmlspecialchars($cart_item['id_sanpham']) ?>&soluong=<?= htmlspecialchars($cart_item['soluong']) ?> " method="POST">
                            <th><?php echo $i ?></th>
                            <td> <?php echo htmlspecialchars($cart_item['masanpham']) ?> </td>
                            <td> <?php echo htmlspecialchars($cart_item['tensanpham']) ?> </td>
                            <td> <img class="img-thumbnail w-50" src="src/images/<?php echo htmlspecialchars($cart_item['hinhanh']) ?>" alt=""> </td>
                            <td> <?php echo htmlspecialchars(number_format($cart_item['gia_sale'], 0, ',', '.') . ' VND') ?> </td>
                            <td> <input type="number" name="soluong" max="<?= htmlspecialchars($product['soluong']) ?>" min="1" value="<?= htmlspecialchars($cart_item['soluong']) ?>"> </td>
                            <td> <?php echo htmlspecialchars(number_format($thanhtien, 0, ',', '.')) . ' VND' ?> </td>

                            <td class="text-center">
                                <button type="submit" name="updatecart" class="btn btn-warning text-center rounded me-3">
                                    <i alt="Update" class="fa-solid fa-pen-nib" style="color: #ffffff;"></i>
                                </button>

                                <button onclick="return confirm('Bạn muốn xóa sản phẩm khỏi giỏ hàng?')" type="submit" name="deletecart" class="btn btn-danger text-center">
                                    <i alt="Delete" class="fa fa-trash"></i>
                                </button>
                            </td>
                        </form>
                    </tr>


            <?php endforeach;
            else :
            ?>
            <td colspan="8" class="text-center p-4"><p>
                <h3>Giỏ hàng của bạn đang trống :((</h3>
            </p>
            <a href="index.php?controller=home" class="text-decoration-none">Nhấn vào để những sản phẩm mới nhất nhé!!</a>
        </td>
        <?php endif ?>
        </tbody>
    </table>
    <?php if (isset($_SESSION['cart'])) : ?>
    <div class="row">
        <div class="col d-flex flex-row-reverse">

            <strong class="order-1 m-0 pt-2 me-2 fs-4">Tổng tiền: <?= number_format($tongtien, 0, ',', ',') . ' VND' ?></strong>
            <button class="login-btn py-2 px-3"><a class="text-decoration-none text-white" href="index.php?controller=confirmorder">Thanh toán</a></button>
        </div>
    </div>
<?php endif ?>
</div>