<?php
include_once '../view/user/partials/heading.php';

$sql_select = "SELECT * FROM tbl_sanpham";
$stmt = $pdo->prepare($sql_select);
$stmt->execute();

if (isset($_SESSION['iduser'])) {
    $iduser = $_SESSION['iduser'];
    $sql_select_acc = "SELECT * FROM tbl_user WHERE id_user = $iduser";
    $stmt_select_acc = $pdo->prepare($sql_select_acc);
    $stmt_select_acc->execute();
    $row_select_acc = $stmt_select_acc->fetch();
}

$sql_select_pro = "SELECT * FROM tbl_sanpham";
$stmt_select_pro = $pdo->prepare($sql_select_pro);
$stmt_select_pro->execute();
$count_pro = $stmt_select_pro->rowCount();
$page = ceil($count_pro / 8);


if (isset($_GET['number_page'])) {
    $number_page = $_GET['number_page'];
} else {
    $number_page = '';
}
if ($number_page == '' || $number_page == 1) {
    $begin = 0;
} else {
    $begin = ($number_page * 8) - 8;
}

$sql_select = "SELECT * FROM tbl_sanpham ORDER BY id_sanpham DESC LIMIT $begin,8";
$stmt = $pdo->prepare($sql_select);
$stmt->execute();
?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="d-inline-flex p-2 justify-content-center">
            <h2 class="title rounded-pill py-2 px-4 my-2 text-white ">Sản phẩm mới nhất</h2>
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
                                <?php 
                                if (isset($_SESSION['dangnhap'])) :
                                ?>
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
                                        if (substr_count($row_select_acc['pro_fav'], $row['masanpham']) == 0) :
                                    ?>
                                            <button type="submit" name="favorite" class="login-btn"><i class="fa-solid fa-heart" style="color: #fff;" data-bs-toggle="tooltip" data-bs-placement="top" title="Thêm sản phẩm yêu thích"></i></button>
                                        <?php
                                        else :
                                            ?>
                                            <button type="submit" name="favorite" class="login-btn"><i class="fa-solid fa-heart" style="color: #f06666;" data-bs-toggle="tooltip" data-bs-placement="top" title="Xóa sản phẩm yêu thích"></i></button>
                                    <?php endif; else :?>
                                        <a class="btn btn-primary" href="index.php?controller=login">Thêm giỏ hàng</a>
<?php endif ?>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endwhile ?>
            </div>
        </div>
    </div>
    <div class="row text-center">
        <div class="col"></div>
        <div class="col my-3 ms-5 ps-5">
            <div class="text-center ms-5 ps-5">
                <nav aria-label="Page navigation example ">
                    <ul class="pagination mx-2">
                        <li class="page-item me-2 mt-1">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <?php
                        for ($i = 1; $i <= $page; $i++) :
                            if ($number_page == '') :
                                $number_page = 1;
                        ?>
                                <li class="me-2 <?php if ($i == $number_page) : echo 'active';
                                                endif ?>  page-item p-0"><a class="text-decoration-none page-link" href="index.php?number_page=<?= $i ?>"><?= $i ?></a></li>
                            <?php else : ?>
                                <li class="me-2 <?php if ($i == $number_page) : echo 'active';
                                                endif ?>  page-item p-0"><a class="text-decoration-none page-link" href="index.php?number_page=<?= $i ?>"><?= $i ?></a></li>
                        <?php
                            endif;
                        endfor
                        ?>
                        <li class="page-item">
                            <a class="page-link mt-1" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="col"></div>
    </div>
</div>