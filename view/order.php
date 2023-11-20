<?php
require '../../bootstrap.php';
$sql = "SELECT DISTINCT code_order, name, phone, address, payment, status FROM orders ";
$stmt = $pdo->prepare($sql);
$stmt->execute();

?>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-11">
        <h1 class="text-center mt-2">Order</h1>
            <table id="results" class="table table-striped table-bordered table-info text-center my-3">
                <thead>
                    <tr>
                        <th scope="col">Mã đơn</th>
                        <th scope="col">Tên người nhận</th>
                        <th scope="col">Số điện thoại</th>
                        <th scope="col">Phương thức thanh toán</th>
                        <th scope="col">Địa chỉ</th>
                        <th scope="col">Tình trạng</th>
                        <th scope="col">Quản lý</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($result = $stmt->fetch()) : ?>
                        <tr>
                            <td><?= htmlspecialchars($result['code_order']) ?></td>
                            <td><?= htmlspecialchars($result['name']) ?></td>
                            <td><?= htmlspecialchars($result['phone']) ?></td>
                            <td><?= htmlspecialchars($result['payment']) ?></td>
                            <td><?= htmlspecialchars($result['address']) ?></td>
                            <td>
<?php
if ($result['status'] == 0) :
?>
<form action="../model/orders/handle.php?idorder=<?= htmlspecialchars($result['code_order'])?>" method="POST">
    <button type="submit" name="checkorder" class="login-btn">Đơn hàng mới</button>
</form>
<?php 
else :
?>
<p>Đã xem</p>
<?php endif ?>
                            </td>

                            <td>
                                
                                <a class="text-decoration-none" href="admin.php?controller=order&action=check&idorder=<?= htmlspecialchars($result['code_order'])?>">Xem đơn hàng</a>
                                        
                                </td>
                        </tr>
                    <?php endwhile ?>
                </tbody>
            </table>
        </div>
    </div>
</div>