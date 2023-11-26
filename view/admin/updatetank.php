<?php

$idtank = $_GET['idtank'];
$sql_select = "SELECT * FROM tbl_mauho WHERE id_mauho = '$idtank'";
$stmt = $pdo->prepare($sql_select);
$stmt->execute();

$sql_selectcate = "SELECT * FROM tbl_danhmuc";
$stmt_cate = $pdo->prepare($sql_selectcate);
$stmt_cate->execute();

?>

<div class="container-fluid">
    <div class="row">
        <h1 class="text-center mt-2">Update Tank</h1>
        <div class="col-6 offset-3">
            <table class="table table-striped table-bordered table-info">
                <?php
                while ($row = $stmt->fetch()) : ?>

                    <tr>
                <form action="../model/products/handle.php?idtank=<?= $row['id_mauho'] ?>" method="POST" enctype="multipart/form-data">
                            <td scope="col">Name</td>
                            <td><input class="w-100" type="text" name="name" value="<?= $row['tenmauho'] ?>"> </td>
                        </tr>
                        <tr>
                            <td scope="col">Code</td>
                            <td><input type="text" name="code" value="<?= $row['mamauho'] ?>"></td>
                        </tr>
                        <tr>
                            <td scope="col">Price</td>
                            <td><input type="text" name="price" value="<?= $row['gia'] ?>"></td>
                        </tr>
                        <tr>
                            <td scope="col">Size</td>
                            <td><input class="w-100" name="size" value="<?= $row['kichthuoc']?>"></td>
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
            </table>
            <div class="d-flex float-end">
                <button type="submit" name="updatetank" class="btn btn-primary"><i alt="Update" class="fa-solid fa-pen-nib" style="color: #ffffff;"></i> Update tank</button>
            </div>
            </form>
        </div>
    </div>
</div>