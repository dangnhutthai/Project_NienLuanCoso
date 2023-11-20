<?php
include_once '../view/partials/heading.php';


$iduser = $_SESSION['iduser'];
$sql_select_acc = "SELECT * FROM accounts WHERE id_acc = $iduser";
$stmt_select_acc = $pdo->prepare($sql_select_acc);
$stmt_select_acc->execute();
$row_select_acc = $stmt_select_acc->fetch();
$str_select_fav = $row_select_acc['pro_fav'];
$str_select_fav == '' ? $check = 1 : $check = 0;
$sql_select = "SELECT * FROM products WHERE code like '%$str_select_fav%'";
$stmt = $pdo->prepare($sql_select);
$stmt->execute();

?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <h1 class="text-center"><i class="fa-solid fa-cube fs-4" style="color: #000000;"></i> Sản phẩm yêu thích <i class="fa-solid fa-cube fs-4" style="color: #000000;"></i></h1>
        <div class="col-11">
            <div class="row justify-content-center border mb-4">
                <?php
                if ($check == 0) : 
                while ($row = $stmt->fetch()) : ?>
                    <div class="col-3 my-2">
                        <div class="card" style="width: 18rem;">
                            <a href="index.php?controller=details&idproduct=<?= htmlspecialchars($row['id']) ?>"><img src="src/images/<?= htmlspecialchars($row['image']) ?>" class="card-img-top" alt="..."></a>
                            <div class="card-body">
                                <h5 class="card-title" style="height: 55px !important;"><?= htmlspecialchars($row['name']) ?></h5>
                                <p class="card-text" style="height: 200px !important;"><?= htmlspecialchars($row['description']) ?></p>
                                <p class="card-text text-danger text-decoration-line-through"><?= htmlspecialchars(number_format($row['price'], 0, ',','.' ). 'VND') ?></p>
                                <p class="card-text"><?= htmlspecialchars(number_format($row['price_sale'], 0, ',','.' ). 'VND')  ?></p>
                                <form action="model/cart/handle.php?idproduct=<?= htmlspecialchars($row['id'])?>" method="POST" enctype="multipart/form-data">
                                    <button type="submit" name="addcart" class="btn btn-primary">Thêm giỏ hàng</button>
                                    <?php 
                                    if (similar_text("$row_select_acc[pro_fav]","$row[code]") == 5) :
                                    ?>
                                    <button type="submit" name="favorite" class="login-btn"><i class="fa-solid fa-heart" style="color: #f06666;"></i></button>
                                    <?php 
                                else :
                                    ?>
                                    <button type="submit" name="favorite" class="login-btn"><i class="fa-solid fa-heart" style="color: #fff;"></i></button>
<?php endif ?>
                                </form>
                            
                            </div>
                        </div>
                    </div>
                <?php endwhile; else : ?>
                    <h1 class="text-center my-5">Bạn chưa có sản phẩm yêu thích</h1>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>