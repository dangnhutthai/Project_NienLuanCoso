<?php

$sql_selectbrand = "SELECT * FROM tbl_mauho";
$stmt = $pdo->prepare($sql_selectbrand);
$stmt->execute();

?>

<div class="container-fluid">
    <div class="row">
        <h1 class="text-center mt-2">Add Tank</h1>
        <div class="col-6 offset-3">
            <table class="table table-striped table-bordered table-info">
                <form action="../model/products/handle.php" method="POST" enctype="multipart/form-data">
                    <tr>
                        <td scope="col">Tên mẫu hồ</td>
                        <td><input class="w-100" type="text" name="name" ></td>
                    </tr>
                    <tr>
                        <td scope="col">Mã</td>
                        <td><input type="text" name="code" ></td>
                    </tr>
                    <tr>
                        <td scope="col">Giá</td>
                        <td><input type="text" name="price" ></td>
                    </tr>
                    <tr>
                        <td scope="col">Kích thước</td>
                        <td><input class="w-100" name="size"></td>
                    </tr>
                    <tr>
                        <td scope="col">Số lượng</td>
                        <td><input type="text" name="amount" ></td>
                    </tr>
                    <tr>
                        <td scope="col">Hình ảnh</td>
                        <td><input class= "w-50" name="image" type="file"></td>
                    </tr>
                </table>
                <div class="d-flex float-end">
                        <button type="submit" name="addtank" class="btn btn-primary"><i class="fa-solid fa-plus" style="color: #ffffff;"></i> Add tank</button>
                    </div>
            </form>
        </div>
    </div>
</div>
