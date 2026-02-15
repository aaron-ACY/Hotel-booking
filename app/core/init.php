<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require 'config.php';
require 'functions.php';
require 'Database.php';
require 'Model.php';
require 'Controller.php';
require 'App.php';

if (!isset($_SESSION['USER']) && isset($_COOKIE['remember_token'])) {
    $token = $_COOKIE['remember_token'];

    // Tạo class tạm để dùng được kết nối Database
    $db_check = new class {
        use Database;
    };

    // Tìm user có token khớp trong DB
    $row = $db_check->query("SELECT * FROM users WHERE remember_token = :token LIMIT 1", ['token' => $token]);

    if ($row) {
        // Nếu tìm thấy -> Tự động tạo Session đăng nhập
        $_SESSION['USER'] = $row[0];
    }
}
