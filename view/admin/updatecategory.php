<?php

$id_brand = $_GET['idcategory'];
$sql_select_brand = "SELECT * FROM tbl_danhmuc WHERE id_danhmuc = $id_brand";
$stmt_bra = $pdo->prepare($sql_select_brand);
$stmt_bra->execute();
$row_bra = $stmt_bra->fetch();

?>

<div class="container-fluid">
    <div class="row">
        <h1 class="mt-2 text-center">Category</h1>
        <div class="col-6 offset-3">
            <form action="../model/categories/handle.php?idcategory=<?= htmlspecialchars($row_bra['id_danhmuc']) ?>" method="POST">
                <table class="table table-striped table-bordered table-info text-center">
                    <tr>
                        <td scope="col">Category</td>
                        <td><input class="w-100" type="text" name="tendanhmuc" value="<?= htmlspecialchars($row_bra['tendanhmuc']) ?>"></td>
                    </tr>
                </table>
                    <div class="text-center">
                        <button type="submit" name="updatecategory" class="btn btn-primary">Update</button>
                    </div>
            </form>
        </div>
    </div>
</div>