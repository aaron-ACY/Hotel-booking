<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Management | <?= ucfirst($data['page_title'] ?? 'Dashboard') ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/dashboard.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v7.1.0/css/all.css" />
</head>

<body>
    <?php
    // Lấy controller hiện tại từ URL để active menu
    // Ví dụ: url = rooms/index -> $current_page = 'rooms'
    $url_parts = explode('/', $_GET['url'] ?? 'admin');
    $current_page = $url_parts[0];
    ?>

    <div class="sidebar">
        <div class="logo"><i class="fas fa-h-square"></i> LUXE HOTEL</div>
        <div class="nav-menu">
            <a href="<?= ROOT ?>/admin" class="nav-item <?= $current_page == 'admin' ? 'active' : '' ?>">
                <i class="fas fa-chart-line"></i> Dashboard
            </a>

            <a href="<?= ROOT ?>/room" class="nav-item <?= $current_page == 'room' ? 'active' : '' ?>">
                <i class="fas fa-door-open"></i> Quản lý phòng
            </a>

            <a href="<?= ROOT ?>/booking" class="nav-item <?= $current_page == 'booking' ? 'active' : '' ?>">
                <i class="fas fa-calendar-check"></i> Đặt phòng
            </a>

            <a href="<?= ROOT ?>/customers" class="nav-item <?= $current_page == 'customers' ? 'active' : '' ?>">
                <i class="fas fa-user-friends"></i> Khách hàng
            </a>

            <a href="<?= ROOT ?>/settings" class="nav-item <?= $current_page == 'settings' ? 'active' : '' ?>">
                <i class="fas fa-cog"></i> Cấu hình
            </a>
        </div>
    </div>

    <div class="main">
        <div class="navbar">
            <div class="page-title">
                <i class="fa-sharp-duotone fa-solid fa-bars-sort" style="font-size: 24px; color: #64748b;"></i>
            </div>

            <div class="user-box">
                <span>Admin</span>

                <img src="<?= ROOT ?>/assets/img/images.jpg" class="avatar" alt="Admin">

                <i class="fa-solid fa-right-from-bracket"
                    onclick="location.href='<?= ROOT ?>/auth/logout'"
                    title="Đăng xuất"
                    style="font-size: 14px; color: #ef4444; margin-left: 8px; cursor: pointer;">
                </i>
            </div>
        </div>
        <div style="padding: 40px;">
