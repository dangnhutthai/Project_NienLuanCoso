<?php
session_start();
require_once '../../../bootstrap.php';
require_once '../../PHPMailer/sendmail.php';
require_once '../../Carbon/autoload.php';

use Carbon\Carbon;
use Carbon\CarbonInterval;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['pay'])) {
    $payment = $_POST['payment'];
    $note = $_POST['note'];
    $iduser = $_SESSION['iduser'];
    $code = rand(0, 9999) . $iduser;
    $time = Carbon::now('Asia/Ho_Chi_Minh');

    $sql_cart = "INSERT INTO tbl_cart (id_khachhang, code_cart, cart_status, cart_date, cart_payment) 
    VALUES (?, ?, ?, ?, ?)";
    $stmt_cart = $pdo->prepare($sql_cart);
    $stmt_cart->execute([
        $iduser,
        $code,
        0,
        $time,
        $payment,
    ]);

    foreach ($_SESSION['cart'] as $key => $cart_item) {
        $idsanpham = $cart_item['id_sanpham'];
        $soluongmua = $cart_item['soluong'];

        $sql_cartdetails = "INSERT INTO tbl_cart_details (code_cart, id_sanpham, soluongmua) 
        VALUES (?, ?, ?)";
        $stmt_cartdetails = $pdo->prepare($sql_cartdetails);
        $stmt_cartdetails->execute([
            $code,
            $idsanpham,
            $soluongmua
        ]);
    }

    $sql_select_acc = "SELECT * FROM tbl_user WHERE id_user = $iduser LIMIT 1";
    $stmt_select_acc = $pdo->prepare($sql_select_acc);
    $stmt_select_acc->execute();
    $row_select_acc = $stmt_select_acc->fetch();
    $hovaten = $row_select_acc['hovaten'];
    $sodienthoai = $row_select_acc['sodienthoai'];
    $email = $row_select_acc['email'];
    $diachi = $row_select_acc['diachi'];
    $sql_shipment = "INSERT INTO tbl_giaohang (tennguoinhan, sodienthoai, email, ghichu, diachi, id_dangky, code_cart) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt_shipment = $pdo->prepare($sql_shipment);
    $stmt_shipment->execute([
        $hovaten,
        $sodienthoai,
        $email,
        $note,
        $diachi,
        $iduser,
        $code
    ]);

    // $title = "Đặt hàng từ của hàng giày TK";
    // $content = "Cảm ơn quý khách đã đặt hàng với mã đơn hàng là: $code";
    // $content = "Đơn hàng gồm có:";
    // foreach ($_SESSION['cart'] as $val_cart_item) {
    //     $content = "<ul style='list-style: none;'>
    //                     <li>Ten san pham: " . $val_cart_item['name'] . "</li>
    //                     <li>Ma san pham: " . $val_cart_item['code'] . "</li>           
    //                     <li>Gia: " . number_format($val_cart_item['price_sale'], 0, ',', '.') . 'VND' . "</li>           
    //                     <li>So luong: " . $val_cart_item['amount'] . "</li>           
    //     </ul>";
    // }
    // $mail = new Mail();
    // $mail->orderFromMail($title, $content, $row_select_acc['email']);
    unset($_SESSION['cart']);
    echo '<script>window.open("../../index.php?controller=thanks","_self")</script>';
} elseif (isset($_POST['checkorder'])) {
    $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
    $code_order = $_GET['idorder'];
    $sql_update = "UPDATE tbl_cart SET cart_status = 1 WHERE code_cart =  $code_order";
    $stmt_update = $pdo->prepare($sql_update);
    $stmt_update->execute();
    $sql_minius = "SELECT * FROM tbl_cart_details WHERE code_cart= $code_order";
    $stmt_minius = $pdo->prepare($sql_minius);
    $stmt_minius->execute();
    while ($row_minus = $stmt_minius->fetch()) {
        $code_pro = $row_minus['id_sanpham'];
        $sql_select = "SELECT * FROM tbl_sanpham WHERE id_sanpham = ?";
        $stmt_select = $pdo->prepare($sql_select);
        $stmt_select->execute([
            $code_pro
        ]);
        $row_select = $stmt_select->fetch();
        $remain = $row_select['soluong'] - $row_minus['soluongmua'];
        $sql_up = "UPDATE tbl_sanpham SET soluong = $remain WHERE id_sanpham = ?";
        $stmt_up = $pdo->prepare($sql_up);
        $stmt_up->execute([
            $code_pro
        ]);
    }
    $sql_up_pro = "SELECT * FROM tbl_sanpham, tbl_cart_details WHERE tbl_sanpham.id_sanpham = tbl_cart_details.id_sanpham
    AND tbl_cart_details.code_cart = $code_order";
    $stmt_up_pro = $pdo->prepare($sql_up_pro);
    $stmt_up_pro->execute();
    $sql_sta = "SELECT * FROM tbl_thongke WHERE ngaydat = '$now'";
    $stmt_sta = $pdo->prepare($sql_sta);
    $stmt_sta->execute();
    $soluongmua = 0;
    $doanhthu = 0;
    while ($row_up_pro = $stmt_up_pro->fetch()) {
        $soluongmua += $row_up_pro['soluongmua'];
        $doanhthu += $row_up_pro['gia_sale'] * $row_up_pro['soluongmua'];
    }
    if ($stmt_sta->rowCount() == 0) {
        $soluongban = $soluongmua;
        $tongdoanhthu = $doanhthu;
        $donhang = 1;
        $sql_ins = "INSERT INTO tbl_thongke (ngaydat, donhang, doanhthu, soluongban) 
        VALUES (?, ?, ?, ?)";
        $stmt_ins = $pdo->prepare($sql_ins);
        $stmt_ins->execute([
            $now,
            $donhang,
            $tongdoanhthu,
            $soluongban
        ]);
    } else {
        while ($row_sl = $stmt_sta->fetch()) {
            $soluongban = $row_sl['soluongban'] + $soluongmua;
            $tongdoanhthu = $row_sl['doanhthu'] + $doanhthu;
            $donhang = $row_sl['donhang'] + 1;
        }
        $sql_ins = "UPDATE tbl_thongke SET ngaydat = ?, donhang = ?, doanhthu = ?, soluongban = ? WHERE ngaydat = '$now'";
        $stmt_ins = $pdo->prepare($sql_ins);
        $stmt_ins->execute([
            $now,
            $donhang,
            $tongdoanhthu,
            $soluongban
        ]);
    }

    echo '<script>window.open("../../admin.php?controller=order&action=index","_self")</script>';
}
