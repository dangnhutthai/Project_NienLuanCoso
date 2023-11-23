<?php
include_once '../view/user/partials/heading.php';

$sql_select = "SELECT * FROM tbl_mauho";
$stmt = $pdo->prepare($sql_select);
$stmt->execute();

?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="d-inline-flex p-2 justify-content-center">
            <h2 class="title rounded-pill py-2 px-4 my-2 text-white ">Các mẫu hồ hiện có</h2>
        </div>
        <div class="col-11">
            <div class="row justify-content-center border">
                <?php while ($row = $stmt->fetch()) : ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 my-2">
                        <div class="card" style="width: 18rem;">
                            <a href="index.php?controller=detailstank&idproduct=<?= htmlspecialchars($row['id_mauho']) ?>"><img src="src/images/<?= htmlspecialchars($row['hinhanh']) ?>" class="card-img-top" alt="..."></a>
                            <div class="card-body">
                                <h5 class="card-title" style="height: 45px !important;"><?= htmlspecialchars($row['tenmauho']) ?></h5>
                                <p class="card-text" style="height: 30px !important;">Kích thước: <?= htmlspecialchars($row['kichthuoc']) ?></p>
                                <p class="card-text"><?= htmlspecialchars(number_format($row['gia'], 0, ',', '.') . 'VND') ?></p>
                                <a class="btn btn-primary" href="index.php?controller=detailstank&idproduct=<?= htmlspecialchars($row['id_mauho']) ?>">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</div>