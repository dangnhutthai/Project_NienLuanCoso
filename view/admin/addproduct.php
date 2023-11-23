<?php

$sql_selectbrand = "SELECT * FROM tbl_danhmuc";
$stmt = $pdo->prepare($sql_selectbrand);
$stmt->execute();

?>

<div class="container-fluid">
    <div class="row">
        <h1 class="text-center mt-2">Add Product</h1>
        <div class="col-6 offset-3">
            <table class="table table-striped table-bordered table-info">
                <form action="../model/products/handle.php" method="POST" enctype="multipart/form-data">
                    <tr>
                        <td scope="col">Tên sản phẩm</td>
                        <td><input class="w-100" type="text" name="name" ></td>
                    </tr>
                    <tr>
                        <td scope="col">Mã sản phẩm</td>
                        <td><input type="text" name="code" ></td>
                    </tr>
                    <tr>
                        <td scope="col">Giá</td>
                        <td><input type="text" name="price" ></td>
                    </tr>
                    <tr>
                        <td scope="col">Giá giảm</td>
                        <td><input type="text" name="price_sale" ></td>
                    </tr>
                    <tr>
                        <td scope="col">Tóm tắt</td>
                        <td><textarea class="w-100" name="description" id="" rows="5"></textarea></td>
                    </tr>
                    <tr>
                        <td scope="col">Nội dung</td>
                        <td><textarea class="w-100" name="content" id="" rows="7"></textarea></td>
                    </tr>
                    <tr>
                        <td scope="col">Số lượng</td>
                        <td><input type="text" name="amount" ></td>
                    </tr>
                    <tr>
                        <td scope="col">Hình ảnh</td>
                        <td><input class= "w-50" name="image" type="file"></td>
                    </tr>

                    <tr>
                        <td scope="col">Loại</td>
                        <td><select class="form-select w-25" aria-label="Default select example" name="idcategory">
                                <?php while ($row = $stmt->fetch()) : ?>
                                    <option value="<?= htmlspecialchars($row['id_danhmuc']) ?>"><?= htmlspecialchars($row['tendanhmuc']) ?></option>
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
