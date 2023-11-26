<?php

$idproduct = $_GET['idproduct'];
$sql_select = "SELECT * FROM tbl_sanpham WHERE id_sanpham = '$idproduct'";
$stmt = $pdo->prepare($sql_select);
$stmt->execute();

$sql_selectcate = "SELECT * FROM tbl_danhmuc";
$stmt_cate = $pdo->prepare($sql_selectcate);
$stmt_cate->execute();

?>

<div class="container-fluid">
    <div class="row">
        <h1 class="text-center mt-2">Update Product</h1>
        <div class="col-6 offset-3">
            <table class="table table-striped table-bordered table-info">
                <?php
                while ($row = $stmt->fetch()) : ?>

                    <tr>
                <form action="../model/products/handle.php?idproduct=<?= $row['id_sanpham'] ?>" method="POST" enctype="multipart/form-data">
                            <td scope="col">Name</td>
                            <td><input class="w-100" type="text" name="name" value="<?= $row['tensanpham'] ?>"> </td>
                        </tr>
                        <tr>
                            <td scope="col">Code</td>
                            <td><input type="text" name="code" value="<?= $row['masanpham'] ?>"></td>
                        </tr>
                        <tr>
                            <td scope="col">Price</td>
                            <td><input type="text" name="price" value="<?= $row['gia'] ?>"></td>
                        </tr>
                        <tr>
                            <td scope="col">Price Sale</td>
                            <td><input type="text" name="price_sale" value="<?= $row['gia_sale'] ?>"></td>
                        </tr>
                        <tr>
                            <td scope="col">Description</td>
                            <td><textarea class="w-100" name="description" rows="5"><?= $row['tomtat']?></textarea></td>
                        </tr>
                        <tr>
                            <td scope="col">Description</td>
                            <td><textarea class="w-100" name="content" rows="5"><?= $row['noidung'] ?></textarea></td>
                        </tr>
                        <tr>
                            <td scope="col">Amount</td>
                            <td><input type="text" name="amount" value="<?= $row['soluong']?>"></td>
                        </tr>
                        <tr>
                            <td scope="col">Image</td>
                            <td><input class="w-50" name="image" type="file">
                                <img src="../src/images/<?= $row['hinhanh']?>" class="w-50 mt-1">
                            </td>
                        </tr>

                    <?php endwhile ?>
                    <tr>
                        <td scope="col">cate</td>
                        <td><select class="form-select w-50" aria-label="Default select example" name="idcategory">
                                <?php while ($row_cate = $stmt_cate->fetch()) : ?>
                                    <option value="<?= $row_cate['id_danhmuc']?>"><?= $row_cate['tendanhmuc'] ?></option>
                                <?php endwhile ?>
                            </select></td>
                    </tr>
            </table>
            <div class="d-flex float-end">
                <button type="submit" name="updateproduct" class="btn btn-primary"><i alt="Update" class="fa-solid fa-pen-nib" style="color: #ffffff;"></i> Update product</button>
            </div>
            </form>
        </div>
    </div>
</div>