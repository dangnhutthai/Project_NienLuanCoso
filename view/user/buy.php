<?php

require_once("../bootstrap.php");
// include_once ('../public/model/carts/handle.php');
// session_start();
?>

<div>
    <h1>Thông tin khách hàng</h1>

</div>

<div class="container my-4">
    <h3 class="text-center">Xác nhận đơn hàng</h3>
    <table class="table table-bordered">
        <thead  class="text-center" >
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
                    <tr class="text-center" >
                        <form action="./model/orders/handle.php" method="POST">
                            <th><?php echo $i ?></th>
                            <td> <?php echo htmlspecialchars($cart_item['name']) ?> </td>
                            <td> <img class="img-thumbnail w-50" src="src/images/<?php echo htmlspecialchars($cart_item['image']) ?>" alt=""> </td>
                            <td>37</td>
                            <td> <?php echo htmlspecialchars(number_format($cart_item['price_sale'], 0, ',', '.') . ' VND') ?> </td>
                            <td>  <?= htmlspecialchars($cart_item['amount']) ?> </td>
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
            <button class="login-btn py-2 px-3">Xác nhận</button>
        </div>
    </div>
    
</form>
    
</div>