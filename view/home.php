<?php
include_once '../view/partials/heading.php';

$sql_select = "SELECT * FROM products";
$stmt = $pdo->prepare($sql_select);
$stmt->execute();

if (isset($_SESSION['iduser'])) {
    $iduser = $_SESSION['iduser'];
    $sql_select_acc = "SELECT * FROM accounts WHERE id_acc = $iduser";
    $stmt_select_acc = $pdo->prepare($sql_select_acc);
    $stmt_select_acc->execute();
    $row_select_acc = $stmt_select_acc->fetch();
}


$sql_select_pro = "SELECT * FROM products";
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

$sql_select = "SELECT * FROM products LIMIT $begin,6";
$stmt = $pdo->prepare($sql_select);
$stmt->execute();
?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <h1 class="text-center"><i class="fa-solid fa-cube fs-4" style="color: #000000;"></i> Sản phẩm mới nhất <i class="fa-solid fa-cube fs-4" style="color: #000000;"></i></h1>
        <div class="col-11">
            <div class="row justify-content-center border">
                <?php while ($row = $stmt->fetch()) : ?>
                    <div class="col-3 my-2">
                        <div class="card" style="width: 18rem;">
                            <a href="index.php?controller=details&idproduct=<?= htmlspecialchars($row['id']) ?>"><img src="src/images/<?= htmlspecialchars($row['image']) ?>" class="card-img-top" alt="..."></a>
                            <div class="card-body">
                                <h5 class="card-title" style="height: 55px !important;" ><?= htmlspecialchars($row['name']) ?></h5>
                                <p class="card-text" style="height: 200px !important;"><?= htmlspecialchars($row['description']) ?></p>
                                <p class="card-text text-danger text-decoration-line-through"><?= htmlspecialchars(number_format($row['price'], 0, ',', '.') . 'VND') ?></p>
                                <p class="card-text"><?= htmlspecialchars(number_format($row['price_sale'], 0, ',', '.') . 'VND')  ?></p>
                                <form action="model/cart/handle.php?idproduct=<?= htmlspecialchars($row['id']) ?>" method="POST" enctype="multipart/form-data">
                                    <button type="submit" name="addcart" class="btn btn-primary">Thêm giỏ hàng</button>
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
                    for ($i = 1; $i <= $page; $i++) {
                    ?>
                        <li class="list-group-item border me-2"><a class="text-decoration-none" href="index.php?number_page=<?= $i ?>"><?= $i ?></a></li>
                    <?php
                    }
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