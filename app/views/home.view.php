<h1>Home page view</h1>

<img src="<?= ROOT ?>/assets/img/images.jpg" style="height:250px; width:auto;">

<div style="margin-top: 20px;">
    <?php if (isset($_SESSION['USER'])): ?>
        <p>Xin chào, <strong><?= $_SESSION['USER']->username ?></strong> (<?= $_SESSION['USER']->role ?>)</p>
        
        <a href="<?= ROOT ?>/auth/logout">
            <button style="padding: 10px 20px; cursor: pointer; background: #ef4444; color: white; border: none; border-radius: 5px;">
                Đăng xuất
            </button>
        </a>

        <?php if ($_SESSION['USER']->role === 'admin'): ?>
            <a href="<?= ROOT ?>/admin">
                <button style="padding: 10px 20px; cursor: pointer; background: #3b82f6; color: white; border: none; border-radius: 5px; margin-left: 10px;">
                    Vào trang Admin
                </button>
            </a>
        <?php endif; ?>

    <?php else: ?>
        <a href="<?= ROOT ?>/auth">
            <button style="padding: 10px 20px; cursor: pointer; background: #22c55e; color: white; border: none; border-radius: 5px;">
                Đăng nhập ngay
            </button>
        </a>
    <?php endif; ?>
</div>
