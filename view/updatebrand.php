<?php

$id_brand = $_GET['id_brand'];
$sql_select_brand = "SELECT * FROM brands WHERE id_brand = $id_brand";
$stmt_bra = $pdo->prepare($sql_select_brand);
$stmt_bra->execute();
$row_bra = $stmt_bra->fetch();

?>


<div class="container-fluid">
    <div class="row">
        <h1 class="mt-2 text-center">Brand</h1>
        <div class="col-6 offset-3">
            <form action="../model/brands/handle.php?id_brand=<?= htmlspecialchars($row_bra['id_brand']) ?>" method="POST">
                <table class="table table-striped table-bordered table-info text-center">
                    <tr>
                        <td scope="col">Brand</td>
                        <td><input class="w-100" type="text" name="brand" value="<?= htmlspecialchars($row_bra['brand']) ?>"></td>
                    </tr>
                </table>
                    <div class="text-center">
                        <button type="submit" name="updatebrand" class="btn btn-primary">Update</button>
                    </div>
            </form>
        </div>
    </div>
</div>