<?php

$idproduct = $_GET['idproduct'];
$sql_select = "SELECT * FROM products WHERE id = '$idproduct'";
$stmt = $pdo->prepare($sql_select);
$stmt->execute();

$sql_selectbrand = "SELECT * FROM brands";
$stmt_brand = $pdo->prepare($sql_selectbrand);
$stmt_brand->execute();

?>

<div class="container-fluid">
    <div class="row">
        <h1 class="text-center mt-2">Add Product</h1>
        <div class="col-6 offset-3">
            <table class="table table-striped table-bordered table-info">
                <?php
                while ($row = $stmt->fetch()) : ?>

                    <tr>
                <form action="../model/products/handle.php?idproduct=<?= htmlspecialchars($row['id']) ?>" method="POST" enctype="multipart/form-data">
                            <td scope="col">Name</td>
                            <td><input class="w-100" type="text" name="name" value="<?= htmlspecialchars($row['name']) ?>"> </td>
                        </tr>
                        <tr>
                            <td scope="col">Code</td>
                            <td><input type="text" name="code" value="<?= htmlspecialchars($row['code']) ?>"></td>
                        </tr>
                        <tr>
                            <td scope="col">Price</td>
                            <td><input type="text" name="price" value="<?= htmlspecialchars($row['price']) ?>"></td>
                        </tr>
                        <tr>
                            <td scope="col">Price Sale</td>
                            <td><input type="text" name="price_sale" value="<?= htmlspecialchars($row['price_sale']) ?>"></td>
                        </tr>
                        <tr>
                            <td scope="col">Description</td>
                            <td><textarea class="w-100" name="description" rows="5"><?= htmlspecialchars($row['description']) ?></textarea></td>
                        </tr>
                        <tr>
                            <td scope="col">Amount</td>
                            <td><input type="text" name="amount" value="<?= htmlspecialchars($row['amount']) ?>"></td>
                        </tr>
                        <tr>
                            <td scope="col">Image</td>
                            <td><input class="w-50" name="image" type="file">
                                <img src="../src/images/<?= htmlspecialchars($row['image'])?>" class="w-50 mt-1">
                            </td>
                        </tr>

                    <?php endwhile ?>
                    <tr>
                        <td scope="col">Brand</td>
                        <td><select class="form-select w-50" aria-label="Default select example" name="id_brand">
                                <?php while ($row_brand = $stmt_brand->fetch()) : ?>
                                    <option value="<?= htmlspecialchars($row_brand['id_brand']) ?>"><?= htmlspecialchars($row_brand['brand']) ?></option>
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