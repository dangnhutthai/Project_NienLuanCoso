<?php
include_once '../view/user/partials/heading.php';

$iddanhmuc = $_GET['iddanhmuc'];
$sql_select_brand = "SELECT * FROM tbl_sanpham, tbl_danhmuc WHERE tbl_sanpham.id_danhmuc = tbl_danhmuc.id_danhmuc 
AND tbl_sanpham.id_danhmuc = $iddanhmuc";
$stmt_brand = $pdo->prepare($sql_select_brand);
$stmt_brand->execute();

if (isset($_SESSION['iduser'])) {
    $iduser = $_SESSION['iduser'];
    $sql_select_acc = "SELECT * FROM tbl_user WHERE id_user = $iduser";
    $stmt_select_acc = $pdo->prepare($sql_select_acc);
    $stmt_select_acc->execute();
    $row_select_acc = $stmt_select_acc->fetch();
}

$sql_brand = "SELECT * FROM tbl_danhmuc WHERE id_danhmuc= ?";
$stmt_bra = $pdo->prepare($sql_brand);
$stmt_bra->execute([
    $iddanhmuc
]);
$row_cate = $stmt_bra->fetchAll();
foreach ($row_cate as $row_cate) :
?>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="d-inline-flex p-2 justify-content-center">
                <h2 class="title rounded-pill py-2 px-4 my-2 text-white ">Danh mục: <?= htmlspecialchars($row_cate['tendanhmuc']) ?></h2>
            </div>
            <div class="col-11">
            <?php endforeach ?>
            <div class="row justify-content-center border">
                <?php while ($row = $stmt_brand->fetch()) : ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 my-2">
                        <div class="card" style="width: 18rem;">
                            <a href="index.php?controller=details&idproduct=<?= htmlspecialchars($row['id_sanpham']) ?>"><img src="src/images/<?= htmlspecialchars($row['hinhanh']) ?>" class="card-img-top" alt="..."></a>
                            <div class="card-body">
                                <h5 class="card-title" style="height: 45px !important;"><?= htmlspecialchars($row['tensanpham']) ?></h5>
                                <p class="card-text" style="height: 150px !important;"><?= htmlspecialchars($row['tomtat']) ?></p>
                                <p class="card-text text-danger text-decoration-line-through"><?= htmlspecialchars(number_format($row['gia'], 0, ',', '.') . 'VND') ?></p>
                                <p class="card-text"><?= htmlspecialchars(number_format($row['gia_sale'], 0, ',', '.') . 'VND')  ?></p>

                                <form action="model/cart/handle.php?idproduct=<?= htmlspecialchars($row['id_sanpham']) ?>" method="POST" enctype="multipart/form-data">
                                <?php if (isset($_SESSION['dangnhap'])) :
                                    if ($row['soluong'] == 0) :
                                ?>
                                        <p class="btn btn-secondary p-2">Tạm thời hết hàng</p>
                                    <?php else : ?>


                                            <button type="submit" name="addcart" class="btn btn-primary">Thêm giỏ hàng</button>
                                        <?php endif;
                                else : ?>
                                        <a href="index.php?controller=login" type="submit" name="addcart" class="btn btn-primary">Thêm giỏ hàng</a>
                                    <?php endif ?>
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