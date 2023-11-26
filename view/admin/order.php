<?php
require '../bootstrap.php';
$sql = "SELECT * FROM tbl_cart, tbl_giaohang WHERE tbl_cart.code_cart = tbl_giaohang.code_cart";
$stmt = $pdo->prepare($sql);
$stmt->execute();
?>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-11">
            <h1 class="text-center mt-2">Order</h1>
            <a href="admin.php?controller=statistic&action=index" class="btn btn-primary my-3">
            <i class="fa-solid fa-eye" style="color: #ffffff;"></i> Xem thống kê
            </a>
            <table id="results" class="table table-striped table-bordered table-info text-center my-3">
                <thead>
                    <tr>
                        <th scope="col">Mã đơn</th>
                        <th scope="col">Họ và tên</th>
                        <th scope="col">Email</th>
                        <th scope="col">Số điện thoại</th>
                        <th scope="col">Địa chỉ</th>
                        <th scope="col">Ngày đặt</th>
                        <th scope="col">Thanh toán</th>
                        <th scope="col">Tình trạng</th>
                        <th scope="col">Quản lý</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($result = $stmt->fetch()) : ?>
                        <tr>
                            <td><?= htmlspecialchars($result['code_cart']) ?></td>
                            <td><?= htmlspecialchars($result['tennguoinhan']) ?></td>
                            <td><?= htmlspecialchars($result['email']) ?></td>
                            <td><?= htmlspecialchars($result['sodienthoai']) ?></td>
                            <td><?= htmlspecialchars($result['diachi']) ?></td>
                            <td><?= htmlspecialchars($result['cart_date']) ?></td>
                            <td><?= htmlspecialchars($result['cart_payment']) ?></td>
                            <td>
                                <?php
                                if ($result['cart_status'] == 0) :
                                ?>
                                    <form action="model/orders/handle.php?idorder=<?= htmlspecialchars($result['code_cart']) ?>" method="POST">
                                        <button type="submit" name="checkorder" class="login-btn">Đơn hàng mới</button>
                                    </form>
                                <?php
                                else :
                                ?>
                                    <p class="text-success">Đã xem</p>
                                <?php endif ?>
                            </td>
                            <td>
                                <a class="text-decoration-none" href="admin.php?controller=order&action=check&idorder=<?= htmlspecialchars($result['code_cart']) ?>">Xem đơn hàng</a>

                            </td>
                        </tr>
                    <?php endwhile ?>
                </tbody>
            </table>
        </div>
    </div>
</div>