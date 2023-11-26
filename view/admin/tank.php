<?php

$sql = "SELECT * FROM tbl_mauho";
$stmt = $pdo->prepare($sql);
$stmt->execute();

?>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-11">
        <h1 class="text-center mt-2">Tank</h1>
            <a href="admin.php?controller=tank&action=add" class="btn btn-primary my-3">
                <i class="fa fa-plus"></i> New Tank
            </a>
            <table id="results" class="table table-striped table-bordered table-info text-center">
                <thead>
                    <tr>
                        <th scope="col">Tên mẫu hồ</th>
                        <th scope="col">Mã</th>
                        <th scope="col">Hình ảnh</th>
                        <th scope="col">Giá</th>
                        <th scope="col">Kích thước</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Quản lý</th>

                    </tr>
                </thead>
                <tbody>
                    <?php while ($result = $stmt->fetch()) : ?>
                        <tr>
                            <td><?= htmlspecialchars($result['tenmauho']) ?></td>
                            <td><?= htmlspecialchars($result['mamauho']) ?></td>
                            <td><img class="img-thumbnail w-50" src="../src/images/<?= htmlspecialchars($result['hinhanh']) ?>" alt=""></td>
                            <td><?= htmlspecialchars(number_format($result['gia'], 0, ',', '.') . ' VND') ?></td>
                            <td><?= htmlspecialchars($result['kichthuoc']) ?></td>
                            <td><?= htmlspecialchars($result['soluong']) ?></td>
                            <td>
                                
                                <a href="admin.php?controller=tank&action=update&idtank=<?= htmlspecialchars($result['id_mauho'])?>" class="btn btn-xs btn-warning text-white mb-1 ms-1">
                                    <i alt="Update" class="fa-solid fa-pen-nib" style="color: #ffffff;"></i></a> 
                                    <form action="/model/products/handle.php?idproduct=<?= htmlspecialchars($result['id_mauho'])?>" method="POST">
                                        <button onclick="return confirm('Có chắc chắc xóa <?= $result['tenmauho'] ?>')" class="btn btn-xs btn-danger ms-1" type="submit"  name="deletetank">
                                            <i alt="Delete" class="fa fa-trash"></i></button> 
                                        </form>
                                        
                                </td>
                        </tr>
                    <?php endwhile ?>
                </tbody>
            </table>
        </div>
    </div>
</div>