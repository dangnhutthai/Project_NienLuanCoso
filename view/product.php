<?php

$sql = "SELECT * FROM products, brands WHERE products.id_brand = brands.id_brand";
$stmt = $pdo->prepare($sql);
$stmt->execute();

?>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-11">
        <h1 class="text-center mt-2">Product</h1>
            <a href="admin.php?controller=product&action=add" class="btn btn-primary my-3">
                <i class="fa fa-plus"></i> New Product
            </a>
            <table id="results" class="table table-striped table-bordered table-info text-center">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Code</th>
                        <th scope="col">Giá gốc</th>
                        <th scope="col">Giá khuyến mãi</th>
                        <th scope="col">Mô tả</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Thương hiệu</th>
                        <th scope="col">Hình ảnh</th>
                        <th scope="col">Quản lý</th>

                    </tr>
                </thead>
                <tbody>
                    <?php while ($result = $stmt->fetch()) : ?>
                        <tr>
                            <td><?= htmlspecialchars($result['name']) ?></td>
                            <td><?= htmlspecialchars($result['code']) ?></td>
                            <td><?= htmlspecialchars(number_format($result['price'], 0, ',', '.') . ' VND') ?></td>
                            <td><?= htmlspecialchars(number_format($result['price_sale'], 0, ',', '.') . ' VND') ?></td>
                            <td><?= htmlspecialchars($result['description']) ?></td>
                            <td><?= htmlspecialchars($result['amount']) ?></td>
                            <td><?= htmlspecialchars($result['brand']) ?></td>
                            <td><img class="img-thumbnail" src="../src/images/<?= htmlspecialchars($result['image']) ?>" alt=""></td>

                            <td>
                                
                                <a href="admin.php?controller=product&action=update&idproduct=<?= htmlspecialchars($result['id'])?>" class="btn btn-xs btn-warning text-white mb-1 ms-1">
                                    <i alt="Update" class="fa-solid fa-pen-nib" style="color: #ffffff;"></i></a> 
                                
                                    
                                    <form action="/model/products/handle.php?idproduct=<?= htmlspecialchars($result['id'])?>" method="POST">
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