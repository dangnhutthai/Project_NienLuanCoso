<?php

require '../../../bootstrap.php';



if (isset($_POST['addproduct'])) {
    $name = htmlspecialchars($_POST['name']);
    $code = htmlspecialchars($_POST['code']);
    $price = htmlspecialchars($_POST['price']);
    $price_sale = htmlspecialchars($_POST['price_sale']);
    $description = htmlspecialchars($_POST['description']);
    $amount = htmlspecialchars($_POST['amount']);
    $id_brand = htmlspecialchars($_POST['id_brand']);
    $image = htmlspecialchars($_FILES['image']['name']);
    $image_tmp = $_FILES['image']['tmp_name'];
    $sql_addproduct = "INSERT INTO products (name, code, price, price_sale,description, amount, id_brand, image) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql_addproduct);
    $stmt->execute([
        $name,
        $code,
        $price,
        $price_sale,
        $description,
        $amount,
        $id_brand,
        $image
    ]);
    move_uploaded_file($image_tmp, '../../src/images/' . $image);
    header('Location: ../../admin/admin.php?controller=product&action=index');
} elseif (isset($_POST['updateproduct'])) {
    $name = htmlspecialchars($_POST['name']);
    $code = htmlspecialchars($_POST['code']);
    $price = htmlspecialchars($_POST['price']);
    $price_sale = htmlspecialchars($_POST['price_sale']);
    $description = htmlspecialchars($_POST['description']);
    $amount = htmlspecialchars($_POST['amount']);
    $id_brand = htmlspecialchars($_POST['id_brand']);
    $image = htmlspecialchars($_FILES['image']['name']);
    $image_tmp = $_FILES['image']['tmp_name'];
    if ($image != '') {
        move_uploaded_file($image_tmp, '../../src/images/' . $image);
        $sql_updateimage = "SELECT * FROM products WHERE id='$_GET[idproduct]'";
        $stmt_image = $pdo->prepare($sql_updateimage);
        $stmt_image->execute();
        while ($row = $stmt_image->fetch()) {
            unlink('../../src/images/' . $row['image']);
        }
        $sql_update = "UPDATE products SET name='" . $name . "',  code='" . $code . "', price='" . $price . "', 
        price_sale='" . $price_sale . "', amount='" . $amount . "', description='" . $description . "', image='" . $image . "', id_brand='" . $id_brand . "' ";
    } else {
        $sql_update = "UPDATE products SET name='" . $name . "',  code='" . $code . "', price='" . $price . "', 
        price_sale='" . $price_sale . "', amount='" . $amount . "', description='" . $description . "', id_brand='" . $id_brand . "' WHERE id = '$_GET[idproduct]'";
    }
    $stmt_update = $pdo->prepare($sql_update);
    $stmt_update->execute();
    header('Location: ../../admin/admin.php?controller=product&action=index');

} else {
    $sql_deleteimage = "SELECT * FROM products WHERE id='$_GET[idproduct]'";
    $stmt_image = $pdo->prepare($sql_deleteimage);
    $stmt_image->execute();
    while ($row = $stmt_image->fetch()) {
        unlink('../../src/images/' . $row['image']);
    }
    $sql_delete = "DELETE FROM products WHERE id='$_GET[idproduct]'";
    $stmt = $pdo->prepare($sql_delete);
    $stmt->execute();
    header('Location: ../../admin/admin.php?controller=product&action=index');
}
