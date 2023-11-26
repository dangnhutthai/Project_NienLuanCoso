<?php

include_once '../view/user/partials/heading.php';
$id_sanpham = $_GET['idproduct'];
$sql_select = "SELECT * FROM tbl_sanpham, tbl_danhmuc WHERE tbl_sanpham.id_danhmuc = tbl_danhmuc.id_danhmuc
    AND id_sanpham = $id_sanpham";
$stmt = $pdo->prepare($sql_select);
$stmt->execute();
$row = $stmt->fetch();
$id_danhmuc = $row['id_danhmuc'];

$sql_select_brandfav = "SELECT * FROM tbl_sanpham, tbl_danhmuc WHERE tbl_sanpham.id_danhmuc = tbl_danhmuc.id_danhmuc 
    AND tbl_danhmuc.id_danhmuc = '$id_danhmuc' AND tbl_sanpham.id_sanpham != '$id_sanpham'";
$stmt_brandfav = $pdo->prepare($sql_select_brandfav);
$stmt_brandfav->execute();

if (isset($_SESSION['iduser'])) {
    $id_user = $_SESSION['iduser'];
    $sql_select_acc = "SELECT * FROM tbl_user WHERE id_user = $id_user";
    $stmt_select_acc = $pdo->prepare($sql_select_acc);
    $stmt_select_acc->execute();
    $row_select_acc = $stmt_select_acc->fetch();
}
?>

<div class="container-fluid">
    
    <div class="row mx-2">
    <div class="d-inline-flex p-2 justify-content-center">
            <h2 class="title rounded-pill py-2 px-4 my-2 text-white ">Thông tin chi tiết</h2>
        </div>
    </div>
    <div class="row border border-2 mx-2">

        <div class="col offset-1 my-2">
            <img class="w-75" src="src/images/<?= htmlspecialchars($row['hinhanh']) ?>" alt="">
        </div>
        <div class="col my-2">
            <div class="d-flex">
                <h2><?= htmlspecialchars($row['tensanpham']) ?></h2>
                <div class="float-end ms-2">
                    <form action="model/cart/handle.php?idproduct=<?= htmlspecialchars($row['id_sanpham']) ?>" method="POST" enctype="multipart/form-data">

                        <?php
                        if (isset($_SESSION['iduser'])) :
                            if (substr_count("$row_select_acc[pro_fav]", "$row[masanpham]") == 0) :
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
            <div class="d-flex mt-3">

                <p class="fs-5"><strong>Loại: </strong><?= htmlspecialchars($row['tendanhmuc']) ?> </p>
                <p class="fs-5 ms-5"><strong>Mã: </strong><?= htmlspecialchars($row['masanpham']) ?> </p>
            </div>
            <p class="fs-5"><strong>Mô tả: </strong><?= htmlspecialchars($row['tomtat']) ?> </p>

            <div class="d-flex my-2">

                <p class="fs-2 price_native px-3"><strong><?= htmlspecialchars(number_format($row['gia_sale'], 0, ',', '.') . ' VND') ?></strong> </p>
                <p class="text-decoration-line-through m-0 ms-2 text-danger "><strong><?= htmlspecialchars(number_format($row['gia'], 0, ',', '.') . ' VND') ?></strong> </p>
            
            </div>
            <form action="model/cart/handle.php?idproduct=<?= htmlspecialchars($row['id_sanpham']) ?>" method="POST" enctype="multipart/form-data">
                <?php if (isset($_SESSION['dangnhap'])) : 
                    if ($row['soluong'] == 0) :
                    ?>
                    <button class="btn btn-secondary p-2">Tạm thời hết hàng</button>
                    <?php else :?>
                    <button type="submit" name="addcart" class="btn-addcart mt-4 p-2">Thêm giỏ hàng</button>
                    <button type="submit" name="buynow" class="btn-buy mt-4 p-2">Mua ngay</button>
                    
                <?php endif; else : ?>
                    <a class="btn login-btn mt-3" href="index.php?controller=login">Đăng nhập ngay để thêm giỏ hàng</a>
                <?php endif; ?>
            </form>
        </div>
    </div>
    <div class="row mx-2 my-4">
        <div class="col-9 p-0">
        <div class="text-center background rounded py-1">
            <h4 class="text-white">Mô tả</h4>
            
        </div>  
        <p class="fs-5"><?= $row['noidung']?> </p>

        </div>
        <div class="col">

            <div class="text-center background rounded py-1">
                <h4 class="text-white">Có thể bạn cũng thích</h4>
            </div>
            
            <?php
        while ($row_fav = $stmt_brandfav->fetch()) :
            ?>
            <div>
                <div class="d-flex mt-1 mt-2">
                    <img class="img-fluid imgfav" src="src/images/<?= htmlspecialchars($row_fav['hinhanh']) ?>" alt="">
                    <div class="d-flex flex-column ms-1">
                        <?= htmlspecialchars($row_fav['tensanpham']) ?>
                        <p class="text-danger text-decoration-line-through"><?= htmlspecialchars(number_format($row_fav['gia'], 0, ',', '.') . ' VND') ?></p>
                        <p class="price_native py-1 px-1"><?= htmlspecialchars(number_format($row_fav['gia_sale'], 0, ',', '.') . ' VND') ?></p>
                        <div class="mt-auto"> 
                            <a class="btn login-btn " href="index.php?controller=details&idproduct=<?= htmlspecialchars($row_fav['id_sanpham'])  ?>">Xem ngay</a>
                            
                        </div>
                        
                    </div>
                </div>
            </div>

        <?php endwhile ?>
    </div>
</div>
</div>
</div>