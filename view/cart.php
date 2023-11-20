<?php

require_once("../bootstrap.php");
// include_once ('../public/model/carts/handle.php');
// session_start();
?>


<div class="container my-4">
    <h3 class="text-center">Giỏ hàng</h3>
    <div>
        <form action="./model/cart/handle.php?idproduct=all" method="post">
            <button onclick="return confirm('Bạn có muốn xóa tất cả sản phẩm trong giỏ hàng?');" type="submit" class="btn login-btn mb-2" name="deletecart">
                Xóa tất cả
            </button>
        </form>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>STT</th>
                <th>Mã</th>
                <th>Tên sản phẩm</th>
                <th class="w-25">Hình ảnh</th>
                <th>Size</th>
                <th>Giá tiền</th>
                <th>Số lượng</th>
                <th>Thành tiền</th>
                <th></th>
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
                    <tr>
                        <form action="./model/cart/handle.php?idproduct=<?= htmlspecialchars($cart_item['id']) ?>&amount=<?= htmlspecialchars($cart_item['amount']) ?> " method="POST">
                            <th><?php echo $i ?></th>
                            <td> <?php echo htmlspecialchars($cart_item['code']) ?> </td>
                            <td> <?php echo htmlspecialchars($cart_item['name']) ?> </td>
                            <td> <img class="img-thumbnail w-50" src="src/images/<?php echo htmlspecialchars($cart_item['image']) ?>" alt=""> </td>
                            <td>
                                <select name="size" class="form-select" aria-label="Default select example">
                                <option value="<?= htmlspecialchars($cart_item['size']) ?>" select><?= htmlspecialchars($cart_item['size']) ?></option>
                                    <option value="37">37</option>
                                    <option value="38">38</option>
                                    <option value="39">39</option>
                                    <option value="40">40</option>
                                    <option value="41">41</option>
                                    <option value="42">42</option>
                                </select>

                            </td>
                            <td> <?php echo htmlspecialchars(number_format($cart_item['price_sale'], 0, ',', '.') . ' VND') ?> </td>
                            <td> <input type="number" name="amount" max="<?= htmlspecialchars($product['amount']) ?>" min="1" value="<?= htmlspecialchars($cart_item['amount']) ?>"> </td>
                            <td> <?php echo htmlspecialchars(number_format($thanhtien, 0, ',', '.')) . ' VND' ?> </td>

                            <td class="text-center">
                                <button type="submit" name="updatecart" class="btn btn-warning text-center rounded me-3">
                                    <i alt="Update" class="fa-solid fa-pen-nib" style="color: #ffffff;"></i>
                                </button>

                                <button type="submit" name="deletecart" class="btn btn-danger text-center">
                                    <i alt="Delete" class="fa fa-trash"></i>
                                </button>
                            </td>
                        </form>
                    </tr>
        </tbody>


<?php endforeach;
            endif;
?>
    </table>
    <div class="row">
        <div class="col d-flex flex-row-reverse">

            <strong class="order-1 m-0 pt-2 me-2 fs-4">Tổng tiền: <?= number_format($tongtien, 0, ',', ',') . ' VND' ?></strong>
            <button class="login-btn py-2 px-3"><a class="text-decoration-none text-white" href="index.php?controller=confirm_order">Thanh toán</a></button>
        </div>
    </div>

</div>