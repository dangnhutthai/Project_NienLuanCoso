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

    $sql_equal = "SELECT * FROM accounts";
    $stmt_equal = $pdo->prepare($sql_equal);
    $stmt_equal->execute();

    while ($result_equal = $stmt_equal->fetch()) {
        if ($username == $result_equal['username']) {
            echo '<script>alert("Tài khoản đã tồn tại!")</script>';
            echo '<script>window.open("../../index.php?controller=signup", "_SELF")</script>';
        }
    }



    if (!preg_match("/^[0-9]{10}$/", $phone)) {
        echo '<script>alert("Số điện thoại không hợp lệ!")</script>';
        echo '<script>window.open("../../index.php?controller=signup", "_SELF")</script>';
    }

    $sql_insertuser = "INSERT INTO accounts (username, email, phone, address, password, confirm_password, admin) VALUES (?,?,?,?,?,?,?)";
    $stmt_signup = $pdo->prepare($sql_insertuser);
    $stmt_signup->execute([
        $username,
        $email,
        $phone,
        $address,
        $password,
        $confirm_password,
        0
    ]);
    echo '<script>alert("Đăng ký tài khoản thành công!")</script>';
    echo '<script>window.open("../../index.php?controller=login", "_SELF")</script>';
} elseif (isset($_POST['login'])) {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars(md5($_POST['password']));

    $sql_loginuser = "SELECT * FROM accounts WHERE username= '$username' AND password= '$password' LIMIT 1";
    $stmt_loginuser = $pdo->prepare($sql_loginuser);
    $stmt_loginuser->execute();
    $row = $stmt_loginuser->fetch();
    if ($row['username'] == $username && $row['password'] == $password) {
        $_SESSION['iduser'] = $row['id_acc'];
        $_SESSION['dangnhap'] = $username;

        if ($row['admin'] == 1) {
            header('Location: ../../admin/admin.php');
        } else {
            header('Location: ../../index.php');
        }
    } else {
        echo '<script>alert("Đăng nhập thất bại! Tài khoản hoặc mật khẩu không chính xác")</script>';
        echo '<script>window.open("../../index.php?controller=login", "_SELF")</script>';
    }
} elseif (isset($_GET['logout'])) {
    unset($_SESSION['dangnhap']);
    unset($_SESSION['iduser']);
    header('Location: ../../index.php');
} elseif (isset($_POST['changepw'])) {
    $oldpw = md5($_POST['oldpassword']);
    $newpw = md5($_POST['password']);
    $cfnewpw = md5($_POST['confirm_password']);
    $iduser = $_SESSION['iduser'];
    $sql_user = "SELECT * FROM accounts WHERE id_acc = ?";
    $stmt_user = $pdo->prepare($sql_user);
    $stmt_user->execute([
        $iduser
    ]);
    $row_user = $stmt_user->fetch();
    if ($oldpw == $row_user['password']) {
        $sql_changepw = "UPDATE accounts SET password = ?, confirm_password = ? WHERE id_acc = ?";
        $stmt_change = $pdo->prepare($sql_changepw);
        $stmt_change->execute([$newpw, $cfnewpw, $iduser]);
        echo '<script>alert("Đổi mật khẩu thành công!")</script>';
        echo '<script>window.open("../../index.php?controller=account", "_SELF")</script>';
    } else {
        echo '<script>alert("Đổi mật khẩu không thành công!")</script>';
        echo '<script>window.open("../../index.php?controller=changepw", "_SELF")</script>';
    }
} elseif (isset($_POST['grant'])) {
    $id = $_GET['id_user'];
    $admin = 1;
    $sql_grant = "UPDATE accounts SET admin = ? WHERE id_acc = ?";
    $stmt_grant = $pdo->prepare($sql_grant);
    $stmt_grant->execute([
        $admin,
        $id
    ]);
    echo '<script>alert("Tài khoản được cấp quyền thành công")</script>';
    echo '<script>window.open("../../admin/admin.php?controller=account&action=index","_self")</script>';
} elseif (isset($_POST['revoke'])) {
    $id = $_GET['id_user'];
    $admin = 0;
    $sql_grant_re = "UPDATE accounts SET admin = ? WHERE id_acc = ?";
    $stmt_grant_re = $pdo->prepare($sql_grant_re);
    $stmt_grant_re->execute([
        $admin,
        $id
    ]);
    echo '<script>alert("Tài khoản được xóa quyền thành công")</script>';
    echo '<script>window.open("../../admin/admin.php?controller=account&action=index","_self")</script>';
}
