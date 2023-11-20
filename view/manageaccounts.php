<?php

$sql_select = "SELECT * FROM accounts";
$stmt_select = $pdo->prepare($sql_select);
$stmt_select->execute();


?>

<div>
<h1 class="text-center mt-2">Account</h1>
<div class="row justify-content-center">
    <div class="col-10">
    <table class="table table-striped-columns">
        <thead>
            <tr class="text-center">
                <th>STT</th>
                <th>Username</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Admin</th>
                <th></th>
            </tr>
        </thead>
        <tbody class="table-group-divider text-center">
            <?php
            $i = 0;
            while ($row = $stmt_select->fetch(PDO::FETCH_ASSOC)) :
                $i++;
            ?>

                <tr>
                    <form action="../model/accounts/handle.php?id_user=<?= htmlspecialchars($row['id_acc']) ?>" method="POST">
                        <td><?= $i ?></td>
                        <td><?= htmlspecialchars($row['username']) ?></td>
                        <td><?= htmlspecialchars($row['phone']) ?></td>
                        <td><?= htmlspecialchars($row['email']) ?></td>
                        <td class="text-center"><?php echo htmlspecialchars($row['admin']) == 1 ? 'Admin' : 'User' ?></td>
                        <td class="text-center">
                            <?php if ($row['admin'] == 0) : ?>
                                <button class="login-btn" name="grant" type="submit">Cấp Quyền</button>
                            <?php elseif ($row['admin'] == 1) : ?>
                                <button class="login-btn" name="revoke" type="submit">Xóa Quyền</button>
                            <?php endif
                            ?>
                        </td>
                    </form>
                </tr>
            <?php
            endwhile;
            ?>
        </tbody>
    </table>
    </div>
</div>
    

</div>