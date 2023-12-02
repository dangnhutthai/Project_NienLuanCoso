<?php
include_once '../view/user/partials/heading.php';

$hotkey = $_POST['hotkey'];
$sql_select = "SELECT * FROM tbl_sanpham WHERE tensanpham like '%$hotkey%'";
$stmt = $pdo->prepare($sql_select);
$stmt->execute();

?>
<div class="container-fluid">
    <div class="row justify-content-center">
    <div class="d-inline-flex p-2 justify-content-center">
            <h2 class="title rounded-pill py-2 px-4 my-2 text-white ">Kết quả tìm kiếm: <?= htmlspecialchars($hotkey)?></h2>
        </div>
        <div class="col-11">
            <div class="row justify-content-center border">
                <?php while ($row = $stmt->fetch()) : ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 my-2">
                        <div class="card" style="width: 18rem;">
                            <a href="index.php?controller=details&idproduct=<?= htmlspecialchars($row['id_sanpham']) ?>"><img src="src/images/<?= htmlspecialchars($row['hinhanh']) ?>" class="card-img-top" alt="..."></a>
                            <div class="card-body">
                                <h5 class="card-title" style="height: 45px !important;"><?= htmlspecialchars($row['tensanpham']) ?></h5>
                                <p class="card-text" style="height: 150px !important;"><?= htmlspecialchars($row['tomtat']) ?></p>
                                <p class="card-text text-danger text-decoration-line-through"><?= htmlspecialchars(number_format($row['gia'], 0, ',', '.') . 'VND') ?></p>
                                <p class="card-text"><?= htmlspecialchars(number_format($row['gia_sale'], 0, ',', '.') . 'VND')  ?></p>
                                <form action="model/cart/handle.php?idproduct=<?= htmlspecialchars($row['id_sanpham']) ?>" method="POST" enctype="multipart/form-data">
                                    <button type="submit" name="addcart" class="btn btn-primary">Thêm giỏ hàng</button>
                                    <?php
                                    
                                    if (isset($_SESSION['iduser'])) :
                                        if (substr_count($row_select_acc['pro_fav'], $row['masanpham']) == 0) :
                                    ?>
                                            <button type="submit" name="favorite" class="login-btn"><i class="fa-solid fa-heart" style="color: #fff;" data-bs-toggle="tooltip" data-bs-placement="top" title="Thêm sản phẩm yêu thích"></i></button>
                                        <?php
                                        else :
                                            ?>
                                            <button type="submit" name="favorite" class="login-btn"><i class="fa-solid fa-heart" style="color: #f06666;" data-bs-toggle="tooltip" data-bs-placement="top" title="Xóa sản phẩm yêu thích"></i></button>
                                    <?php endif;
                                    endif; ?>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endwhile ?>
            </div>
        </div>
    </div>
</div>