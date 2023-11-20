<?php
include_once '../view/partials/heading.php';

$hotkey = $_POST['hotkey'];
$sql_select = "SELECT * FROM products WHERE name like '%$hotkey%'";
$stmt = $pdo->prepare($sql_select);
$stmt->execute();

?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <h1 class="text-center"><i class="fa-solid fa-cube fs-4" style="color: #000000;"></i> Kết quả tìm kiếm cho từ khóa: <?= htmlspecialchars($hotkey) ?> <i class="fa-solid fa-cube fs-4" style="color: #000000;"></i></h1>
        <div class="col-11">
            <div class="row justify-content-center border">
                <?php while ($row = $stmt->fetch()) : ?>
                    <div class="col-4 my-2">
                        <div class="card" style="width: 18rem;">
                            <a href="index.php?controller=details&idproduct=<?= htmlspecialchars($row['id']) ?>"><img src="src/images/<?= htmlspecialchars($row['image']) ?>" class="card-img-top" alt="..."></a>
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($row['name']) ?></h5>
                                <p class="card-text"><?= htmlspecialchars($row['description']) ?></p>
                                <p class="card-text text-danger text-decoration-line-through"><?= htmlspecialchars(number_format($row['price'], 0, ',','.' ). 'VND') ?></p>
                                <p class="card-text"><?= htmlspecialchars(number_format($row['price_sale'], 0, ',','.' ). 'VND')  ?></p>
                                <form action="model/cart/handle.php?idproduct=<?= htmlspecialchars($row['id'])?>" method="POST" enctype="multipart/form-data">
                                    <button type="submit" name="addcart" href="#" class="btn btn-primary">Thêm giỏ hàng</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endwhile ?>
            </div>
        </div>
    </div>
</div>