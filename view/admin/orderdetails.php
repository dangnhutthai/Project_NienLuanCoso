<?php
require '../bootstrap.php';
$idorder = $_GET['idorder'];
$sql = "SELECT * FROM tbl_cart_details WHERE code_cart= $idorder";
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
                        $sql_pro = "SELECT * FROM tbl_sanpham, tbl_danhmuc WHERE tbl_sanpham.id_danhmuc = tbl_danhmuc.id_danhmuc 
                    AND id_sanpham = $result[id_sanpham]";
                        $stmt_pro = $pdo->prepare($sql_pro);
                        $stmt_pro->execute();
                        $row = $stmt_pro->fetch();
                        $total += $result['soluongmua'] * $row['gia_sale'];
                    ?>
                        <tr>
                            <td><?= htmlspecialchars($row['masanpham']) ?></td>
                            <td><?= htmlspecialchars($row['tensanpham']) ?></td>
                            <td><?= htmlspecialchars($row['tendanhmuc']) ?></td>
                            <td><?= htmlspecialchars($result['soluongmua']) ?></td>
                            <td><?= htmlspecialchars($row['gia_sale']) * htmlspecialchars($result['soluongmua']) ?></td>
                            <td><img class="img-thumbnail" src="src/images/<?= htmlspecialchars($row['hinhanh']) ?>" width="80px"></td>
                        </tr>
                    <?php endwhile ?>
                    <tr colspan="6" class=" ">
                        <h3 class="d-inline-flex price_native p-2">Tổng giá trị đơn: <?= htmlspecialchars(number_format($total, 0, ',', '.') . ' VND') ?> </h3>
                    </tr>
                    
                </tbody>
            </table>
            <div class="float-end">

                <a href="model/orders/print.php?idorder=<?= htmlspecialchars($idorder) ?>" class="btn btn-primary">
                    <i class="fa fa-plus"></i> In đơn hàng
                </a>
            </div>
        </div>
    </div>
</div>