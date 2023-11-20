<?php
session_start();
include_once '../../../bootstrap.php';

if (isset($_POST['signup'])) {
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $address = htmlspecialchars($_POST['address']);
    $password = htmlspecialchars(md5($_POST['password']));
    $confirm_password = htmlspecialchars(md5($_POST['confirm_password']));

    $sql_equal = "SELECT * FROM tbl_user";
    $stmt_equal = $pdo->prepare($sql_equal);
    $stmt_equal->execute();

    while ($result_equal = $stmt_equal->fetch()) {
        if ($username == $result_equal['tentaikhoan']) {
            echo '<script>alert("Tài khoản đã tồn tại!")</script>';
            echo '<script>window.open("../../index.php?controller=signup", "_SELF")</script>';
        }
    }

    if (!preg_match("/^[0-9]{10}$/", $phone)) {
        echo '<script>alert("Số điện thoại không hợp lệ!")</script>';
        echo '<script>window.open("../../index.php?controller=signup", "_SELF")</script>';
    }

    $sql_insertuser = "INSERT INTO tbl_user (tentaikhoan, email, sodienthoai, diachi, matkhau) VALUES (?,?,?,?,?)";
    $stmt_signup = $pdo->prepare($sql_insertuser);
    $stmt_signup->execute([
        $username,
        $email,
        $phone,
        $address,
        $password
    ]);
    echo '<script>alert("Đăng ký tài khoản thành công!")</script>';
    echo '<script>window.open("../../index.php?controller=login", "_SELF")</script>';
} elseif (isset($_POST['login'])) {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars(md5($_POST['password']));

    $sql_loginuser = "SELECT * FROM tbl_user WHERE tentaikhoan= '$username' AND matkhau= '$password' LIMIT 1";
    $stmt_loginuser = $pdo->prepare($sql_loginuser);
    $stmt_loginuser->execute();
    $row = $stmt_loginuser->fetch();
    $sql_loginadmin = "SELECT * FROM tbl_admin WHERE username= '$username' AND password= '$password' LIMIT 1";
    $stmt_loginadmin = $pdo->prepare($sql_loginadmin);
    $stmt_loginadmin->execute();
    $row_admin = $stmt_loginadmin->fetch();
    if ($row['tentaikhoan'] == $username && $row['matkhau'] == $password) {
        $_SESSION['iduser'] = $row['id_user'];
        $_SESSION['dangnhap'] = $username;
        print_r($sql_loginuser);
        echo '<script>alert("Đăng nhập thành công!")</script>';
        echo '<script>window.open("../../index.php?controller=home", "_SELF")</script>';
    } elseif ($row_admin['username'] == $username && $row_admin['password'] == $password) {
        print_r($sql_loginadmin);
        $_SESSION['dangnhap'] = $username;
    echo '<script>alert("Đăng nhập thành công!")</script>';
    echo '<script>window.open("../../admin/admin.php?controller=account&action=index", "_SELF")</script>';
    }
    echo '<script>alert("Đăng nhập thất bại! Tài khoản hoặc mật khẩu không chính xác")</script>';
    echo '<script>window.open("../../index.php?controller=login", "_SELF")</script>';
} elseif (isset($_GET['logout'])) {
    unset($_SESSION['dangnhap']);
    unset($_SESSION['iduser']);
    header('Location: ../../index.php');
} elseif (isset($_POST['changepw'])) {
    $oldpw = md5($_POST['oldpassword']);
    $newpw = md5($_POST['password']);
    $cfnewpw = md5($_POST['confirm_password']);
    $iduser = $_SESSION['iduser'];
    $sql_user = "SELECT * FROM tbl_user WHERE id_user = ?";
    $stmt_user = $pdo->prepare($sql_user);
    $stmt_user->execute([
        $iduser
    ]);
    $row_user = $stmt_user->fetch();
    if ($oldpw == $row_user['password']) {
        $sql_changepw = "UPDATE tbl_user SET password = ?, confirm_password = ? WHERE id_acc = ?";
        $stmt_change = $pdo->prepare($sql_changepw);
        $stmt_change->execute([$newpw, $cfnewpw, $iduser]);
        echo '<script>alert("Đổi mật khẩu thành công!")</script>';
        echo '<script>window.open("../../index.php?controller=account", "_SELF")</script>';
    } else {
        echo '<script>alert("Đổi mật khẩu không thành công!")</script>';
        echo '<script>window.open("../../index.php?controller=changepw", "_SELF")</script>';
    }
}
