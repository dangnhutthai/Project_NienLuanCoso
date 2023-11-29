<?php

include_once '../view/user/partials/heading.php';
$id_mauho = $_GET['idproduct'];
$sql_select = "SELECT * FROM tbl_mauho WHERE id_mauho = $id_mauho";
$stmt = $pdo->prepare($sql_select);
$stmt->execute();
$row = $stmt->fetch();

$sql_select_brandfav = "SELECT * FROM tbl_mauho WHERE id_mauho != $id_mauho LIMIT 4";
$stmt_brandfav = $pdo->prepare($sql_select_brandfav);
$stmt_brandfav->execute();

?>

<div class="container-fluid">
    
    <div class="row mx-2">
    <div class="d-inline-flex p-2 justify-content-center">
            <h2 class="title rounded-pill py-2 px-4 my-2 text-white ">Thông tin chi tiết</h2>
        </div>
    </div>
    <div class="row justify-content-center my-4">

        <div class="col-4 p-0">
            <img class="w-75 rounded border border-dark border-3" src="src/images/<?= htmlspecialchars($row['hinhanh']) ?>" alt="">
        </div>
        <div class="col-3 border border-2">
            <div class="d-flex">
                <h2><?= htmlspecialchars($row['tenmauho']) ?></h2>
                
            </div>
       
                <p class="fs-5 mt-1"><strong>Mã: </strong><?= htmlspecialchars($row['mamauho']) ?> </p>
         
            <p class="fs-5 my-1"><strong>Kích thước: </strong><?= htmlspecialchars($row['kichthuoc']) ?> </p>

            <div class="d-inline-flex justify-content-center mt-4">
                <p class="fs-2 price_native px-3"><strong><?= htmlspecialchars(number_format($row['gia'], 0, ',', '.') . ' VND') ?></strong> </p>
                
            </div>
            <div class="d-block my-1">

                <a href="#footer" class="btn btn-secondary">Liên hệ để đặt mua ngay</a>
            </div>
            
       

        </div>
    </div>
    <div class="row mx-2 my-5">
        <div class="text-center background rounded py-1">
                <h4 class="text-white">Có thể bạn cũng thích</h4>
            </div>
            
            
            
            <?php
        while ($row_fav = $stmt_brandfav->fetch()) :
            ?>
            <div class="col">
            <div>
                <div class="d-flex mt-1 mt-2">
                    <img class="img-fluid imgfav rounded border border-dark border-3" src="src/images/<?= htmlspecialchars($row_fav['hinhanh']) ?>" alt="">
                    <div class="d-flex flex-column ms-1">
                        <?= htmlspecialchars($row_fav['tenmauho']) ?>
                        <p class="text-danger text-decoration-line-through"><?= htmlspecialchars(number_format($row_fav['gia'], 0, ',', '.') . ' VND') ?></p>
                        <div class="mt-auto"> 
                            <a class="btn login-btn " href="index.php?controller=detailstank&idproduct=<?= htmlspecialchars($row_fav['id_mauho'])  ?>">Xem ngay</a>
                            
                        </div>
                        
                    </div>
                </div>
            </div>

        </div>
        <?php endwhile ?>
</div>
</div>
</div>