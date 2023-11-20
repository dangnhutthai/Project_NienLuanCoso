<?php

try {
    $pdo = new PDO('mysql:host=localhost;dbname=web_nlcs', 'root', 'dangnhutthai');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    $error_message = 'Không thể kết nối đến CSDL';
    $reason = $e->getMessage();
    exit();
}
