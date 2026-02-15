<?php get_view('components/header') ?>

<style>
    /* BỐ CỤC CHUNG: GRID 2 CỘT */
    .profile-container {
        display: grid;
        grid-template-columns: 300px 1fr;
        /* Cột trái 300px, Cột phải phần còn lại */
        gap: 24px;
        max-width: 1000px;
        margin: 0 auto;
        align-items: start;
        /* Căn lên trên cùng */
    }

    /* CARD CHUNG (Khung trắng) */
    .card-box {
        background: white;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        border: 1px solid #e2e8f0;
        overflow: hidden;
    }

    /* --- CỘT TRÁI: PROFILE CARD --- */
    .profile-sidebar {
        text-align: center;
        padding: 30px 20px;
    }

    .avatar-wrapper {
        width: 100px;
        height: 100px;
        margin: 0 auto 15px;
        border-radius: 50%;
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 40px;
        font-weight: bold;
        color: white;
        box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.3);
        border: 4px solid #eff6ff;
    }

    .user-name {
        font-size: 18px;
        font-weight: 700;
        color: #0f172a;
        margin: 0;
    }

    .user-email {
        font-size: 14px;
        color: #64748b;
        margin-top: 5px;
    }

    .role-badge {
        display: inline-block;
        margin-top: 15px;
        padding: 6px 12px;
        background: #f1f5f9;
        color: #475569;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .divider {
        height: 1px;
        background: #e2e8f0;
        margin: 20px 0;
    }

    .info-list {
        text-align: left;
        font-size: 14px;
        color: #475569;
    }

    .info-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 12px;
    }

    .info-item strong {
        color: #1e293b;
    }

    /* --- CỘT PHẢI: EDIT FORM --- */
    .profile-content {
        padding: 30px;
    }

    .content-header {
        margin-bottom: 25px;
        border-bottom: 1px solid #e2e8f0;
        padding-bottom: 15px;
    }

    .content-title {
        font-size: 18px;
        font-weight: 700;
        color: #0f172a;
        margin: 0;
    }

    .content-subtitle {
        font-size: 13px;
        color: #64748b;
        margin-top: 4px;
    }

    /* FORM STYLES */
    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        /* 2 cột input */
        gap: 20px;
    }

    .full-width {
        grid-column: span 2;
    }

    /* Input dài full dòng */

    .form-group label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #475569;
        margin-bottom: 8px;
    }

    .form-input {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        font-size: 14px;
        transition: 0.2s;
    }

    .form-input:focus {
        border-color: #3b82f6;
        outline: none;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .form-input[readonly] {
        background: #f8fafc;
        color: #94a3b8;
        cursor: not-allowed;
    }

    .btn-save {
        background: #0f172a;
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-save:hover {
        background: #334155;
    }

    /* Responsive Mobile */
    @media (max-width: 768px) {
        .profile-container {
            grid-template-columns: 1fr;
        }

        /* Chuyển về 1 cột */
        .form-grid {
            grid-template-columns: 1fr;
        }

        .full-width {
            grid-column: span 1;
        }
    }
</style>

<div class="section-title">
    <span>Hệ thống</span>
    <span style="color: #64748b; font-weight: normal;"> / Hồ sơ cá nhân</span>
</div>

<div class="profile-container">

    <div class="card-box profile-sidebar">
        <div class="avatar-wrapper">
            <?= strtoupper(substr($user->username, 0, 1)) ?>
        </div>
        <h3 class="user-name"><?= $user->username ?></h3>
        <div class="user-email"><?= $user->email ?></div>
        <div class="role-badge"><i class="fa-solid fa-shield-halved"></i> Quản trị viên</div>

        <div class="divider"></div>

        <div class="info-list">
            <div class="info-item">
                <span>Trạng thái</span>
                <strong style="color: #22c55e;">Đang hoạt động</strong>
            </div>
            <div class="info-item">
                <span>Ngày tham gia</span>
                <strong><?= date("d/m/Y") ?></strong>
            </div>
            <div class="info-item">
                <span>Quyền hạn</span>
                <strong>Toàn quyền</strong>
            </div>
        </div>
    </div>

    <div class="card-box profile-content">

        <div class="content-header" style="display:flex; justify-content:space-between; align-items:center;">
            <div>
                <h3 class="content-title">Cài đặt tài khoản</h3>
                <p class="content-subtitle">Quản lý thông tin cá nhân và bảo mật</p>
            </div>
        </div>

        <?php if (!empty($message)): ?>
            <div class="alert-success" style="background: #ecfdf5; color: #047857; padding: 12px; border-radius: 8px; margin-bottom: 25px; border: 1px solid #a7f3d0; display:flex; align-items:center; gap:10px;">
                <i class="fa-solid fa-circle-check"></i>
                <span><?= $message ?></span>
            </div>
        <?php endif; ?>

        <form method="POST">

            <div style="margin-bottom: 30px;">
                <h4 style="font-size: 15px; color: #334155; margin-bottom: 15px; border-left: 4px solid #3b82f6; padding-left: 10px;">
                    Thông tin cơ bản
                </h4>

                <div class="form-grid">
                    <div class="form-group">
                        <label>Tên hiển thị</label>
                        <div class="input-with-icon">
                            <i class="fa-regular fa-user" style="position:absolute; left:12px; top:11px; color:#94a3b8;"></i>
                            <input type="text" name="username" class="form-input" style="padding-left: 35px;" value="<?= $user->username ?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Email đăng nhập</label>
                        <div class="input-with-icon">
                            <i class="fa-regular fa-envelope" style="position:absolute; left:12px; top:11px; color:#94a3b8;"></i>
                            <input type="email" class="form-input" style="padding-left: 35px; background-color: #f1f5f9;" value="<?= $user->email ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Vai trò hệ thống</label>
                        <div class="input-with-icon">
                            <i class="fa-solid fa-shield-halved" style="position:absolute; left:12px; top:11px; color:#94a3b8;"></i>
                            <input type="text" class="form-input" style="padding-left: 35px; background-color: #f1f5f9;" value="<?= ucfirst($user->role) ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Trạng thái Token</label>
                        <div class="input-with-icon">
                            <i class="fa-solid fa-key" style="position:absolute; left:12px; top:11px; color:#94a3b8;"></i>
                            <input type="text" class="form-input" style="padding-left: 35px; background-color: #f1f5f9;"
                                value="<?= !empty($user->remember_token) ? 'Đang kích hoạt ghi nhớ' : 'Chưa kích hoạt' ?>" readonly>
                        </div>
                    </div>
                </div>
            </div>

            <div class="divider"></div>

            <div style="margin-top: 25px;">
                <h4 style="font-size: 15px; color: #334155; margin-bottom: 15px; border-left: 4px solid #ef4444; padding-left: 10px;">
                    Đổi mật khẩu
                </h4>

                <div class="form-grid">
                    <div class="form-group full-width">
                        <label>Mật khẩu mới</label>
                        <div class="input-with-icon" style="position:relative;">
                            <i class="fa-solid fa-lock" style="position:absolute; left:12px; top:11px; color:#94a3b8;"></i>
                            <input type="password" name="password" class="form-input" style="padding-left: 35px;" placeholder="Chỉ nhập nếu bạn muốn đổi mật khẩu">
                        </div>
                        <small style="color: #64748b; font-size: 12px; margin-top: 5px; display:block;">
                            Để trống để giữ nguyên mật khẩu hiện tại.
                        </small>
                    </div>
                </div>
            </div>

            <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #e2e8f0; display: flex; justify-content: flex-end; gap: 10px;">
                <a href="<?= ROOT ?>/admin" style="padding: 10px 20px; color: #64748b; text-decoration: none; font-weight: 600;">Hủy bỏ</a>
                <button type="submit" class="btn-save" style="background: #3b82f6; box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.4);">
                    <i class="fa-solid fa-floppy-disk"></i> Lưu thay đổi
                </button>
            </div>

        </form>
    </div>

</div>

<?php get_view('components/footer') ?>
