<?php

$sql_selectbrand = "SELECT * FROM brands";
$stmt = $pdo->prepare($sql_selectbrand);
$stmt->execute();

?>

<div class="container-fluid">
    <div class="row">
        <h1 class="text-center mt-2">Add Product</h1>
        <div class="col-6 offset-3">

            <!-- Table Starts Here -->
            <table class="table table-striped table-bordered table-info">
                <form action="../model/products/handle.php" method="POST" enctype="multipart/form-data">
                    <tr>
                        <td scope="col">Name</td>
                        <td><input class="w-100" type="text" name="name" ></td>
                    </tr>
                    <tr>
                        <td scope="col">Code</td>
                        <td><input type="text" name="code" ></td>
                    </tr>
                    <tr>
                        <td scope="col">Price</td>
                        <td><input type="text" name="price" ></td>
                    </tr>
                    <tr>
                        <td scope="col">Price Sale</td>
                        <td><input type="text" name="price_sale" ></td>
                    </tr>
                    <tr>
                        <td scope="col">Description</td>
                        <td><textarea class="w-100" name="description" id="" rows="5"></textarea></td>
                    </tr>
                    <tr>
                        <td scope="col">Amount</td>
                        <td><input type="text" name="amount" ></td>
                    </tr>
                    <tr>
                        <td scope="col">Image</td>
                        <td><input class= "w-50" name="image" type="file"></td>
                    </tr>

                    <tr>
                        <td scope="col">Brand</td>
                        <td><select class="form-select w-50" aria-label="Default select example" name="id_brand">
                                <?php while ($row = $stmt->fetch()) : ?>
                                    <option value="<?= htmlspecialchars($row['id_brand']) ?>"><?= htmlspecialchars($row['brand']) ?></option>
                                <?php endwhile ?>
                            </select></td>
                    </tr>
                </table>
                <div class="d-flex float-end">
                        <button type="submit" name="addproduct" class="btn btn-primary"><i class="fa-solid fa-plus" style="color: #ffffff;"></i> Add product</button>
                    </div>
            </form>
        </div>
    </div>
</div>