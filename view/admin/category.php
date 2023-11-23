<?php

$sql = "SELECT * FROM tbl_danhmuc";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$i = 0;
?>
 
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-8">
            <h1 class="text-center mt-2">Category</h1>
            <a href="admin.php?controller=category&action=add" class="btn btn-primary my-3">
                <i class="fa fa-plus"></i> New Category
            </a>
            <table id="results" class="table table-striped table-bordered table-info text-center">
                <thead>
                    <tr>
                        <th scope="col">Số thứ tự</th>
                        <th scope="col">Tên loại cá</th>
                        <th scope="col">Quản lý</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($result = $stmt->fetch()) : $i = $i + 1 ?>
                        <tr>
                            <form class="form-inline ml-1" action="../model/categories/handle.php?idcategory=<?= htmlspecialchars($result['id_danhmuc']) ?>" method="POST">
                                <td><?= $i ?></td>
                                <td name="category"><?= htmlspecialchars($result['tendanhmuc']) ?></td>
                                <td class="d-flex justify-content-center">
                                    <a class="btn btn-xs btn-warning text-white" href="admin.php?controller=category&action=update&idcategory=<?= htmlspecialchars($result['id_danhmuc']) ?>">
                                        <i alt="Update" class="fa-solid fa-pen-nib" style="color: #ffffff;"></i>
                                    </a>
                                    <button onclick="return confirm('Xóa loại cá?');" type="submit" class="btn btn-xs btn-danger ms-2" name="deletecategory">
                                        <i alt="Delete" class="fa fa-trash"></i>
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