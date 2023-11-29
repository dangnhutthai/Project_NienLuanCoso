<?php
include_once '../view/user/partials/heading.php';


$iduser = $_SESSION['iduser'];
$sql_select_acc = "SELECT * FROM tbl_user WHERE id_user = $iduser";
$stmt_select_acc = $pdo->prepare($sql_select_acc);
$stmt_select_acc->execute();
$row_select_acc = $stmt_select_acc->fetch();
$str_select_fav = $row_select_acc['pro_fav'];
$str_split = str_split($str_select_fav, 5);

if ($str_select_fav == '') {
    $check = 0;
} else {
    $check = 1;
}

?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="d-inline-flex p-2 justify-content-center">
            <h2 class="title rounded-pill py-2 px-4 my-2 text-white ">Sản phẩm yêu thích </h2>
        </div>
        <div class="col-11">
            <div class="row justify-content-center border mb-4">
                <?php
                if ($check == 1) :
                    $i = 0;
                    foreach ($str_split as $str_split) :
                        $sql_select = "SELECT * FROM tbl_sanpham WHERE masanpham like '$str_split'";
                        $stmt = $pdo->prepare($sql_select);
                        $stmt->execute();
                        $i++;
                        while ($row = $stmt->fetch()) : ?>
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
                                        if ($row['soluong'] == 0) :
                                            ?>
                                            <p class="btn btn-secondary p-2">Tạm thời hết hàng</p>
                                            <?php else : ?>
                                                
                                                
                                                <button type="submit" name="addcart" class="btn btn-primary">Thêm giỏ hàng</button>
                                                <?php endif; ?>
                                                
                                                <?php

if (isset($_SESSION['iduser'])) :
    if (substr_count($row_select_acc['pro_fav'], $row['masanpham']) == 0) :
        ?>
                                                <button type="submit" name="favorite" class="login-btn"><i class="fa-solid fa-heart" style="color: #fff;"></i></button>
                                                <?php
                                            else :
                                                ?>
                                                <button type="submit" name="favorite" class="login-btn"><i class="fa-solid fa-heart" style="color: #f06666;"></i></button>
                                                <?php endif;
                                        endif; ?>
                                    </form>
                                </div>
                                </div>
                            </div>
                            <?php endwhile; ?>
                            <?php
                    endforeach;
                    else : ?>
                        </div>
    <h1 class="text-center my-5">Bạn chưa có sản phẩm yêu thích</h1>
<?php endif ?>
        </div>
    </div>
</div>