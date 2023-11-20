<?php

include_once 'partials/heading.php';
$id = $_GET['idproduct'];
$sql_select = "SELECT * FROM products, brands WHERE products.id_brand = brands.id_brand 
    AND id = '$id'";
$stmt = $pdo->prepare($sql_select);
$stmt->execute();
$row = $stmt->fetch();
$brand = $row['id_brand'];

$sql_select_brandfav = "SELECT * FROM products, brands WHERE products.id_brand = brands.id_brand 
    AND brands.id_brand = '$brand' AND products.id != '$id'";
$stmt_brandfav = $pdo->prepare($sql_select_brandfav);
$stmt_brandfav->execute();

if (isset($_SESSION['iduser'])) {

    $iduser = $_SESSION['iduser'];
    $sql_select_acc = "SELECT * FROM accounts WHERE id_acc = $iduser";
    $stmt_select_acc = $pdo->prepare($sql_select_acc);
    $stmt_select_acc->execute();
    $row_select_acc = $stmt_select_acc->fetch();
}
?>

<div class="container-fluid">
    <h1 class="text-center mb-4"><i class="fa-solid fa-cube fs-4" style="color: #000000;"></i> Chi tiết sản phẩm <i class="fa-solid fa-cube fs-4" style="color: #000000;"></i></h1>
    <div class="row  border border-2 mx-2">

        <div class="col offset-1 my-2">
            <img class="w-75" src="src/images/<?= htmlspecialchars($row['image']) ?>" alt="">
        </div>
        <div class="col my-2">
            <div class="d-flex">
                <h2><?= htmlspecialchars($row['name']) ?></h2>
                <div class="float-end ms-2">
                    <form action="model/cart/handle.php?idproduct=<?= htmlspecialchars($row['id']) ?>" method="POST" enctype="multipart/form-data">

                        <?php
                        if (isset($_SESSION['iduser'])) :
                            if (similar_text("$row_select_acc[pro_fav]", "$row[code]") == 5) :
                        ?>
                                <button type="submit" name="favorite" class="login-btn"><i class="fa-solid fa-heart" style="color: #f06666;"></i></button>
                            <?php
                            else :
                            ?>
                                <button type="submit" name="favorite" class="login-btn"><i class="fa-solid fa-heart" style="color: #fff;"></i></button>
                        <?php endif;
                        endif; ?>
                    </form>
                </div>
            </div>
            <div class="d-flex mt-3">

                <p class="fs-5">Thương hiệu: <strong><?= htmlspecialchars($row['brand']) ?></strong> </p>
                <p class="fs-5 ms-5">Mã: <strong><?= htmlspecialchars($row['code']) ?></strong> </p>
            </div>
            <div class="d-flex my-2">

                <p class="fs-2 price_native px-3"><strong><?= htmlspecialchars(number_format($row['price_sale'], 0, ',', '.') . ' VND') ?></strong> </p>
                <p class="text-decoration-line-through m-0 ms-2 text-danger "><strong><?= htmlspecialchars(number_format($row['price'], 0, ',', '.') . ' VND') ?></strong> </p>
            </div>
            <form action="model/cart/handle.php?idproduct=<?= htmlspecialchars($row['id']) ?>" method="POST" enctype="multipart/form-data">

                <div class="d-flex">
                    <p class="fs-5 m-0">Size:</p>
                    <select name="size" class="form-select w-25 ms-2" aria-label="Default select example">
                        <option value="37">37</option>
                        <option value="38">38</option>
                        <option value="39">39</option>
                        <option value="40">40</option>
                        <option value="41">41</option>
                        <option value="42">42</option>
                    </select>
                </div>
                <?php if (isset($_SESSION['dangnhap'])) : ?>
                    <button type="submit" name="addcart" class="access-btn mt-4 p-2">Thêm giỏ hàng</button>
                    <button type="submit" name="buynow" class="btn-buy mt-4 p-2">Mua ngay</button>
                <?php else : ?>
                    <a class="btn login-btn mt-3" href="index.php?controller=login">Đăng nhập ngay để thêm giỏ hàng</a>
                <?php endif ?>
            </form>
        </div>
    </div>
    <div class="row mx-2 my-4">
        <div class="text-center background rounded py-1">
            <h4>Có thể bạn cũng thích</h4>
        </div>

        <?php
        while ($row_fav = $stmt_brandfav->fetch()) :
        ?>
            <div class="col-3">
                <div class="d-flex mt-1">

                    <img class="img-fluid imgfav" src="src/images/<?= htmlspecialchars($row_fav['image']) ?>" alt="">
                    <div class="d-flex flex-column ms-1">

                        <?= htmlspecialchars($row_fav['name']) ?>
                        <p class="text-danger"><?= htmlspecialchars(number_format($row_fav['price_sale'], 0, ',', '.') . ' VND') ?></p>
                        <div class="mt-auto">

                            <a class="btn login-btn " href="index.php?controller=details&idproduct=<?= htmlspecialchars($row_fav['id'])  ?>">Xem ngay</a>

                        </div>

                    </div>
                </div>
            </div>

        <?php endwhile ?>
    </div>
</div>
</div>