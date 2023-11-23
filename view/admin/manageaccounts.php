<?php

$sql_select = "SELECT * FROM tbl_user";
$stmt_select = $pdo->prepare($sql_select);
$stmt_select->execute();


?>

<div>
<h1 class="text-center mt-2">Account</h1>
<div class="row justify-content-center">
    <div class="col-10">
    <table class="table table-striped-columns mt-3">
        <thead>
            <tr class="text-center">
                <th>STT</th>
                <th>Username</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Địa chỉ</th>
            </tr>
        </thead>
        <tbody class="table-group-divider text-center">
            <?php
            $i = 0;
            while ($row = $stmt_select->fetch(PDO::FETCH_ASSOC)) :
                $i++;
            ?>

                <tr>
                        <td><?= $i ?></td>
                        <td><?= htmlspecialchars($row['tentaikhoan']) ?></td>
                        <td><?= htmlspecialchars($row['sodienthoai']) ?></td>
                        <td><?= htmlspecialchars($row['email']) ?></td>
         
                        <td><?= htmlspecialchars($row['diachi']) ?></td>
                            
                        </td>
                  
                </tr>
            <?php
            endwhile;
            ?>
        </tbody>
    </table>
    </div>
</div>
    

</div>