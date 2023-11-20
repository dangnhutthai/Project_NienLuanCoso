<?php
session_start();
require_once '../../../bootstrap.php';
require_once '../../PHPMailer/sendmail.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['updateacc'])) {
    $id_user = $_GET['id_user'];
    $name = $_POST['changeusername'];
    $phone = $_POST['changephone'];
    $address = $_POST['changeaddress'];
    $sql_updateacc = "UPDATE accounts SET name = ?, phone = ?, address = ? WHERE id_acc = ?";
    $stmt_updateacc = $pdo->prepare($sql_updateacc);
    $stmt_updateacc->execute([
        $name,
        $phone,
        $address,
        $id_user
    ]);
    echo '<script>alert("Cập nhật thông tin thành công!")</script>';
    echo '<script>window.open("../../index.php?controller=confirm_order","_self")</script>';
} elseif (isset($_POST['pay'])) {
    $payment = $_POST['payment'];
    $iduser = $_SESSION['iduser'];
    $code = rand(0, 9999) . $iduser;

    $sql_select_acc = "SELECT * FROM accounts WHERE id_acc = $iduser LIMIT 1";
    $stmt_select_acc = $pdo->prepare($sql_select_acc);
    $stmt_select_acc->execute();
    $row_select_acc = $stmt_select_acc->fetch();

    foreach ($_SESSION['cart'] as $cart_item) {
        $sql_order = "INSERT INTO orders(code_order, code, id_acc, quantity, price_sale, payment, address, phone, name, status, size) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt_order = $pdo->prepare($sql_order);
        $stmt_order->execute([
            $code,
            $cart_item['code'],
            $iduser,
            $cart_item['amount'],
            $cart_item['price_sale'],
            $payment,
            $row_select_acc['address'],
            $row_select_acc['phone'],
            $row_select_acc['name'],
            0,
            $cart_item['size'],
        ]);
    }
    $title = "Đặt hàng từ của hàng giày TK";
    $content = "Cảm ơn quý khách đã đặt hàng với mã đơn hàng là: $code";
    $content = "Đơn hàng gồm có:";
    foreach ($_SESSION['cart'] as $val_cart_item) {
        $content = "<ul style='list-style: none;'>
                        <li>Ten san pham: " . $val_cart_item['name'] . "</li>
                        <li>Ma san pham: " . $val_cart_item['code'] . "</li>           
                        <li>Gia: " . number_format($val_cart_item['price_sale'], 0, ',', '.') . 'VND' . "</li>           
                        <li>So luong: " . $val_cart_item['amount'] . "</li>           
        </ul>";
    }
    $mail = new Mail();
    $mail->orderFromMail($title, $content, $row_select_acc['email']);
    unset($_SESSION['cart']);
    echo '<script>window.open("../../index.php?controller=thanks","_self")</script>';
} elseif (isset($_POST['checkorder'])) {
    $code_order = $_GET["idorder"];
    $sql_update = "UPDATE orders SET status = 1 WHERE code_order =  $code_order";
    $stmt_update = $pdo->prepare($sql_update);
    $stmt_update->execute();
    $sql_minius = "SELECT * FROM orders WHERE code_order= $code_order";
    $stmt_minius = $pdo->prepare($sql_minius);
    $stmt_minius->execute();
    while ($row_minus = $stmt_minius->fetch()) {
        $code_pro = $row_minus['code'];
        $sql_select = "SELECT * FROM products WHERE products.code = ?";
        $stmt_select = $pdo->prepare($sql_select);
        $stmt_select->execute([
$code_pro
        ]);
        $row_select = $stmt_select->fetch();
        $remain = $row_select['amount'] - $row_minus['quantity'];
        $sql_up = "UPDATE products SET amount=$remain WHERE products.code = ?";
        $stmt_up = $pdo->prepare($sql_up);
        $stmt_up->execute([
            $code_pro
        ]);
    }
   

    // header("Location:../../index.php?action=quanlydonhang&query=lietke");
}
