<?php
require '../../bootstrap.php';
$idorder = $_GET['idorder'];
$sql = "SELECT * FROM orders, products WHERE orders.code = products.code AND code_order = $idorder";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$total = 0;
?>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-11">
            <h1 class="text-center mt-2">Order details</h1>
            <table id="results" class="table table-striped table-bordered table-info text-center my-3">
                <thead>
                    <tr>
                        <th scope="col">Mã sản phẩm</th>
                        <th scope="col">Tên sản phẩm</th>
                        <th scope="col">Size</th>
                        <th scope="col">Số lượng mua</th>
                        <th scope="col">Giá tiền</th>
                        <th scope="col">Hình ảnh</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($result = $stmt->fetch()) : 
                        $total += $result['amount']*$result['price_sale'];
                        
                        ?>
                        <tr>
                            <td><?= htmlspecialchars($result['code']) ?></td>
                            <td><?= htmlspecialchars($result['name']) ?></td>
                            <td><?= htmlspecialchars($result['size']) ?></td>
                            <td><?= htmlspecialchars($result['quantity']) ?></td>
                            <td><?= htmlspecialchars($result['price_sale'])*htmlspecialchars($result['amount']) ?></td>
                            <td><img src="../src/images/<?= htmlspecialchars($result['image']) ?>" width="80px"></td>
                        </tr>
                    <?php endwhile ?>
                    <tr colspan="6">
                        <h3>Tổng giá trị đơn: <?= htmlspecialchars(number_format($total,0,',','.').' VND') ?> </h3>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>