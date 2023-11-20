<?php

$hotkey = $_POST['hotkey'];


$sql_select = "SELECT * FROM tbl_sanpham, tbl_danhmuc WHERE tbl_sanpham.id_danhmuc = tbl_danhmuc.id_danhmuc
AND tensanpham like '%$hotkey%'";
$stmt = $pdo->prepare($sql_select);
$stmt->execute();

?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-11">
        <h1 class="text-center mt-2">Product for: <?= htmlspecialchars($hotkey) ?></h1>
            <a href="admin.php?controller=product&action=add" class="btn btn-primary my-3">
                <i class="fa fa-plus"></i> New Product
            </a>
            <table id="results" class="table table-striped table-bordered table-info text-center">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Mã</th>
                        <th scope="col">Hình ảnh</th>
                        <th scope="col">Giá gốc</th>
                        <th scope="col">Giá khuyến mãi</th>
                        <th scope="col">Mô tả</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Loại</th>
                        <th scope="col">Quản lý</th>

                    </tr>
                </thead>
                <tbody>
                    <?php while ($result = $stmt->fetch()) : ?>
                        <tr>
                            <td><?= htmlspecialchars($result['tensanpham']) ?></td>
                            <td><?= htmlspecialchars($result['masanpham']) ?></td>
                            <td><img class="img-thumbnail" src="../src/images/<?= htmlspecialchars($result['hinhanh']) ?>" alt=""></td>
                            <td><?= htmlspecialchars(number_format($result['gia'], 0, ',', '.') . ' VND') ?></td>
                            <td><?= htmlspecialchars(number_format($result['gia_sale'], 0, ',', '.') . ' VND') ?></td>
                            <td><?= htmlspecialchars($result['tomtat']) ?></td>
                            <td><?= htmlspecialchars($result['soluong']) ?></td>
                            <td><?= htmlspecialchars($result['tendanhmuc']) ?></td>

                            <td>
                                
                                <a href="admin.php?controller=product&action=update&idproduct=<?= htmlspecialchars($result['id_sanpham'])?>" class="btn btn-xs btn-warning text-white mb-1 ms-1">
                                    <i alt="Update" class="fa-solid fa-pen-nib" style="color: #ffffff;"></i></a> 
                                
                                    
                                    <form action="/model/products/handle.php?idproduct=<?= htmlspecialchars($result['id_sanpham'])?>" method="POST">
                                        <button class="btn btn-xs btn-danger ms-1" type="submit"  name="deleteproduct">
                                            
                                            <i alt="Delete" class="fa fa-trash"></i></button> 
                                        </form>
                                        
                                </td>
                        </tr>
                    <?php endwhile ?>
                </tbody>
            </table>
        </div>
    </div>
</div>