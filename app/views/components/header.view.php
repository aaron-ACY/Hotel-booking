<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Management | Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/dashboard.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v7.1.0/css/all.css" />
</head>

<body>
    <div class="sidebar">
        <div class="logo"><i class="fas fa-h-square"></i> LUXE HOTEL</div>
        <div class="nav-menu">
            <a href="<?= ROOT ?>/admin" class="nav-item active"><i class="fas fa-chart-line"></i> Dashboard</a>
            <a href="<?= ROOT ?>/rooms" class="nav-item"><i class="fas fa-door-open"></i> Quản lý phòng</a>
            <a href="<?= ROOT ?>/booking" class="nav-item"><i class="fas fa-calendar-check"></i> Đặt phòng</a>
            <a href="<?= ROOT ?>/customers" class="nav-item"><i class="fas fa-user-friends"></i> Khách hàng</a>
            <a href="<?= ROOT ?>/settings" class="nav-item"><i class="fas fa-cog"></i> Cấu hình</a>
        </div>
    </div>
    <div class="main">
        <div class="navbar">
            <div class="page-title">
                <!-- nav action -->
                <i class="fa-sharp-duotone fa-solid fa-bars-sort" style="font-size: 24px; color: #64748b;"></i>
            </div>

            <div class="user-box">
                <span>Admin</span>
                <img src="<?= ROOT ?>/assets/img/images.jpg" class="avatar" alt="User">
            </div>
        </div>
        <div style="padding: 40px;">
