<?php get_view('admin/header') ?>

<style>
    /* Stats Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 25px;
        margin-bottom: 40px;
    }

    .card {
        background: white;
        padding: 25px;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);

        /* Chuyển sang Flexbox */
        display: flex;
        align-items: center;
        /* Căn giữa theo chiều dọc */
        gap: 20px;
        /* Khoảng cách giữa icon và chữ */
    }

    .card-icon {
        width: 60px;
        height: 60px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        flex-shrink: 0;
        /* Không cho icon bị co lại */
    }

    .card-content {
        display: flex;
        flex-direction: column;
    }

    .card-val {
        font-size: 24px;
        font-weight: 700;
        margin: 0;
        color: #1e293b;
    }

    .card-label {
        color: #64748b;
        font-size: 14px;
        margin: 2px 0 0 0;
    }

    /* Màu sắc icon */
    .bg-blue {
        background: #eff6ff;
        color: #3b82f6;
    }

    .bg-green {
        background: #f0fdf4;
        color: #22c55e;
    }

    .bg-orange {
        background: #fff7ed;
        color: #f97316;
    }

    .table-section {
        margin-top: 30px;
        background: white;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    .table-header {
        padding: 20px 25px;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .table-header h3 {
        margin: 0;
        font-size: 18px;
        font-weight: 600;
        color: #1e293b;
    }

    .table-responsive {
        width: 100%;
        overflow-x: auto;
    }

    .table-card {
        background: white;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        margin-top: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th {
        background: #f8fafc;
        padding: 15px;
        text-align: left;
        font-size: 13px;
        color: #64748b;
        border-bottom: 1px solid #e2e8f0;
    }

    td {
        padding: 15px;
        border-bottom: 1px solid #f1f5f9;
        font-size: 14px;
        color: #1e293b;
    }

    .badge {
        padding: 5px 10px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
    }

    .badge-success {
        background: #dcfce7;
        color: #166534;
    }

    .action-btns {
        display: flex;
        gap: 12px;
    }

    .btn-icon {
        border: none;
        background: none;
        cursor: pointer;
        font-size: 16px;
    }
</style>

<div class="stats-grid">
    <div class="card">
        <div class="card-icon bg-blue">
            <i class="fas fa-concierge-bell"></i>
        </div>
        <div class="card-content">
            <h3 class="card-val"><?= $data['total_bookings'] ?? 0 ?></h3>
            <p class="card-label">Tổng đặt phòng</p>
        </div>
    </div>

    <div class="card">
        <div class="card-icon bg-green">
            <i class="fas fa-door-open"></i>
        </div>
        <div class="card-content">
            <h3 class="card-val"><?= $data['available_rooms'] ?? 0 ?></h3>
            <p class="card-label">Phòng trống</p>
        </div>
    </div>

    <div class="card">
        <div class="card-icon bg-orange">
            <i class="fas fa-wallet"></i>
        </div>
        <div class="card-content">
            <h3 class="card-val"><?= number_format($data['revenue'] ?? 0) ?>đ</h3>
            <p class="card-label">Doanh thu tháng</p>
        </div>
    </div>
</div>

<div class="section-title">
    <span>Đơn đặt phòng gần đây</span>
    <a href="<?= ROOT ?>/bookings" style="font-size: 14px; color: var(--accent); text-decoration: none;">Xem tất cả</a>
</div>

<div class="table-card">
    <div class="table-header" style="padding: 20px; border-bottom: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center;">
        <h3 style="margin: 0; font-size: 18px; color: #1e293b;">Danh sách Đặt phòng</h3>
        <a href="<?= ROOT ?>/bookings" style="font-size: 14px; color: #3b82f6; text-decoration: none;">Xem tất cả</a>
    </div>

    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #f8fafc;">
                    <th style="padding: 15px; border-bottom: 1px solid #e2e8f0; text-align: left; font-size: 13px; color: #64748b; text-transform: uppercase;">ID</th>
                    <th style="padding: 15px; border-bottom: 1px solid #e2e8f0; text-align: left; font-size: 13px; color: #64748b; text-transform: uppercase;">Customer</th>
                    <th style="padding: 15px; border-bottom: 1px solid #e2e8f0; text-align: left; font-size: 13px; color: #64748b; text-transform: uppercase;">Email</th>
                    <th style="padding: 15px; border-bottom: 1px solid #e2e8f0; text-align: left; font-size: 13px; color: #64748b; text-transform: uppercase;">Phone</th>
                    <th style="padding: 15px; border-bottom: 1px solid #e2e8f0; text-align: left; font-size: 13px; color: #64748b; text-transform: uppercase;">Room</th>
                    <th style="padding: 15px; border-bottom: 1px solid #e2e8f0; text-align: left; font-size: 13px; color: #64748b; text-transform: uppercase;">Room Type</th>
                    <th style="padding: 15px; border-bottom: 1px solid #e2e8f0; text-align: left; font-size: 13px; color: #64748b; text-transform: uppercase;">Status</th>
                    <th style="padding: 15px; border-bottom: 1px solid #e2e8f0; text-align: center; font-size: 13px; color: #64748b; text-transform: uppercase;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($rows)): ?>
                    <?php foreach ($rows as $row): ?>
                        <tr>
                            <td>#<?= $row->id ?></td>
                            <td><strong><?= $row->first_name . " " . $row->last_name ?></strong></td>
                            <td><?= $row->email_address ?></td>
                            <td><?= $row->phone_number ?></td>
                            <td><?= $row->room_number ?? 'N/A' ?></td>
                            <td><?= $row->room_type ?? 'N/A' ?></td>
                            <td>
                                <span class="badge badge-success">
                                    <?= $row->status ?>
                                </span>
                            </td>
                            <td>
                                <div class="action-btns">
                                    <a href="<?= ROOT ?>/admin/edit/<?= $row->id ?>" style="color: #3b82f6;"><i class="fa-regular fa-pen-to-square"></i></a>
                                    <a href="<?= ROOT ?>/admin/delete/<?= $row->id ?>"
                                        onclick="return confirm('Bạn có chắc chắn muốn xóa?')"
                                        style="color: #ef4444;">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php get_view('admin/footer') ?>
