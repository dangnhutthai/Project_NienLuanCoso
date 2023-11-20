<?php

$sql = "SELECT * FROM brands";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$i = 0;
?>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-8">
            <h1 class="text-center mt-2">Brand</h1>
            <a href="admin.php?controller=brand&action=add" class="btn btn-primary my-3">
                <i class="fa fa-plus"></i> New Brand
            </a>

            <!-- Table Starts Here -->
            <table id="results" class="table table-striped table-bordered table-info text-center">
                <thead>
                    <tr>
                        <th scope="col">Số thứ tự</th>
                        <th scope="col">Tên thương hiệu</th>
                        <th scope="col">Quản lý</th>


                    </tr>
                </thead>
                <tbody>
                    <?php while ($result = $stmt->fetch()) : $i = $i + 1 ?>
                        <tr>
                            <form class="form-inline ml-1" action="../model/brands/handle.php?idbrand=<?= htmlspecialchars($result['id_brand']) ?>" method="POST">
                                <td><?= $i ?></td>
                                <td name="brand"><?= htmlspecialchars($result['brand']) ?></td>
                                <td class="d-flex justify-content-center">
                                    <a class="btn btn-xs btn-warning text-white" href="admin.php?controller=brand&action=update&id_brand=<?= htmlspecialchars($result['id_brand']) ?>">
                                        <i alt="Update" class="fa-solid fa-pen-nib" style="color: #ffffff;"></i> Update
                                    </a>
                                    <button type="submit" class="btn btn-xs btn-danger ms-2" name="deletebrand">
                                        <i alt="Delete" class="fa fa-trash"></i> Delete
                                    </button>
                                </td>
                            </form>
                        </tr>
                    <?php endwhile ?>
                </tbody>
            </table>
        </div>
    </div>
</div>