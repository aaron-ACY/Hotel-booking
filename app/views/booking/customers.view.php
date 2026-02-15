<?php get_view('components/header') ?>

<style>
    .table-card {
        background: white;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        margin-top: 20px;
    }

    table { width: 100%; border-collapse: collapse; }
    th { background: #f8fafc; padding: 15px; text-align: left; font-size: 13px; color: #64748b; border-bottom: 1px solid #e2e8f0; }
    td { padding: 15px; border-bottom: 1px solid #f1f5f9; font-size: 14px; color: #1e293b; }

    .badge { padding: 5px 10px; border-radius: 6px; font-size: 12px; font-weight: 600; }
    .badge-success { background: #dcfce7; color: #166534; }

    .action-btns { display: flex; gap: 12px; justify-content: center; }
    .btn-icon { border: none; background: none; cursor: pointer; font-size: 16px; transition: 0.2s; }
    .btn-icon:hover { transform: scale(1.1); }

    /* MODAL STYLES (Dùng chung cho cả Edit và Detail) */
    .modal {
        display: none; position: fixed; z-index: 1000; left: 0; top: 0;
        width: 100%; height: 100%;
        background-color: rgba(15, 23, 42, 0.6);
        backdrop-filter: blur(4px);
    }

    .modal-content {
        position: relative; top: 50%; left: 50%;
        transform: translate(-50%, -50%);
        width: 500px; max-width: 90%;
        background: #ffffff;
        border-radius: 24px;
        padding: 30px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        animation: modalSlideUp 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        overflow-y: auto; max-height: 90vh;
    }

    @keyframes modalSlideUp {
        from { opacity: 0; transform: translate(-50%, -45%) scale(0.95); }
        to { opacity: 1; transform: translate(-50%, -50%) scale(1); }
    }

    .modal-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; }
    .modal-header h3 { font-size: 20px; font-weight: 700; color: #0f172a; margin: 0; }
    
    .close-btn {
        width: 32px; height: 32px;
        display: flex; align-items: center; justify-content: center;
        background: #f1f5f9; border-radius: 50%;
        cursor: pointer; transition: 0.2s; color: #64748b;
    }
    .close-btn:hover { background: #fee2e2; color: #ef4444; }

    /* Info Box Styles (Cho Modal Chi tiết) */
    .info-group { margin-bottom: 20px; }
    .info-label { font-size: 12px; font-weight: 700; color: #94a3b8; text-transform: uppercase; margin-bottom: 8px; display: block; }
    .info-box { background: #f8fafc; border-radius: 12px; padding: 15px; border: 1px solid #e2e8f0; }
    .info-row { display: flex; align-items: center; gap: 15px; margin-bottom: 12px; }
    .info-row:last-child { margin-bottom: 0; }
    .info-icon { width: 32px; height: 32px; background: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #3b82f6; box-shadow: 0 2px 4px rgba(0,0,0,0.05); flex-shrink: 0; }
    .info-text strong { display: block; font-size: 14px; color: #1e293b; }
    .info-text span { font-size: 12px; color: #64748b; }

    /* Form Styles (Cho Modal Edit) */
    .input-box { margin-bottom: 15px; }
    .input-box label { display: block; font-size: 13px; font-weight: 600; color: #64748b; margin-bottom: 5px; }
    .input-box input { width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; }
    .input-box input:focus { border-color: #3b82f6; outline: none; }

    .modal-footer { display: flex; gap: 10px; margin-top: 25px; }
    .btn-cancel, .btn-save { flex: 1; padding: 12px; border-radius: 8px; border: none; font-weight: 600; cursor: pointer; }
    .btn-cancel { background: #f1f5f9; color: #64748b; }
    .btn-save { background: #3b82f6; color: white; }
    .btn-save:hover { background: #2563eb; }
</style>

<div class="section-title">
    <span>Quản lý</span>
    <a href="<?= ROOT ?>/bookings" style="font-size: 14px; color: var(--accent); text-decoration: none;">Xem tất cả</a>
</div>

<div class="table-card">
    <div class="table-header" style="padding: 20px; border-bottom: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center;">
        <h3 style="margin: 0; font-size: 18px; color: #1e293b;">Danh sách khách hàng</h3>
    </div>

    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #f8fafc;">
                    <th>ID</th>
                    <th>Khách hàng</th>
                    <th>Email</th>
                    <th>SĐT</th>
                    <th>Phòng</th>
                    <th>Loại</th>
                    <th>Trạng thái</th>
                    <th style="text-align: center;">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($rows)): ?>
                    <?php foreach ($rows as $row): ?>
                        <tr>
                            <td>#<?= $row->booking_id ?></td>
                            <td><strong><?= $row->first_name . " " . $row->last_name ?></strong></td>
                            <td><?= $row->email_address ?></td>
                            <td><?= $row->phone_number ?></td>
                            <td><?= $row->room_number ?? '---' ?></td>
                            <td><?= $row->room_type ?? '---' ?></td>
                            <td><span class="badge badge-success"><?= $row->status ?></span></td>
                            <td>
                                <div class="action-btns">
                                    <a href="javascript:void(0)"
                                        onclick="openEditPopup('<?= $row->guest_id ?>', '<?= $row->first_name . ' ' . $row->last_name ?>', '<?= $row->email_address ?>', '<?= $row->phone_number ?>')"
                                        class="btn-icon" style="color: #3b82f6;" title="Chỉnh sửa">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </a>

                                    <a href="javascript:void(0)"
                                        onclick='viewCustomerDetail(<?= json_encode($row) ?>)'
                                        class="btn-icon" style="color: #059669;" title="Xem chi tiết">
                                        <i class="fa-solid fa-eye"></i>
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

<div id="editPopup" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Chỉnh sửa khách hàng</h3>
            <span class="close-btn" onclick="closePopup('editPopup')"><i class="fa-solid fa-xmark"></i></span>
        </div>
        <form id="editForm" action="<?= ROOT ?>/customers/update" method="POST">
            <input type="hidden" id="edit-id" name="id">
            <div class="input-box">
                <label>Họ tên</label>
                <input type="text" id="edit-name" name="full_name" required>
            </div>
            <div class="input-box">
                <label>Email</label>
                <input type="email" id="edit-email" name="email" required>
            </div>
            <div class="input-box">
                <label>Số điện thoại</label>
                <input type="text" id="edit-phone" name="phone" required>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-cancel" onclick="closePopup('editPopup')">Hủy</button>
                <button type="submit" class="btn-save">Lưu thay đổi</button>
            </div>
        </form>
    </div>
</div>

<div id="detailPopup" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <div>
                <h3>Thông tin chi tiết</h3>
                <div style="font-size:13px; color:#64748b; margin-top:2px;">Mã đơn: <span id="d-id">#---</span></div>
            </div>
            <span class="close-btn" onclick="closePopup('detailPopup')"><i class="fa-solid fa-xmark"></i></span>
        </div>

        <div class="info-group">
            <label class="info-label">Thông tin khách hàng</label>
            <div class="info-box">
                <div class="info-row">
                    <div class="info-icon"><i class="far fa-user"></i></div>
                    <div class="info-text"><strong id="d-name">---</strong><span>Họ và tên</span></div>
                </div>
                <div class="info-row">
                    <div class="info-icon"><i class="far fa-envelope"></i></div>
                    <div class="info-text"><strong id="d-email">---</strong><span>Email</span></div>
                </div>
                <div class="info-row">
                    <div class="info-icon"><i class="far fa-phone"></i></div>
                    <div class="info-text"><strong id="d-phone">---</strong><span>Số điện thoại</span></div>
                </div>
            </div>
        </div>

        <div class="info-group">
            <label class="info-label">Thông tin phòng</label>
            <div class="info-box">
                <div class="info-row">
                    <div class="info-icon"><i class="far fa-door-open"></i></div>
                    <div class="info-text"><strong id="d-room">---</strong><span>Số phòng & Loại</span></div>
                </div>
                <div style="display:flex; gap:15px; margin-top:10px;">
                    <div class="info-row" style="flex:1">
                        <div class="info-icon"><i class="far fa-calendar-check"></i></div>
                        <div class="info-text"><strong id="d-checkin">---</strong><span>Check-in</span></div>
                    </div>
                    <div class="info-row" style="flex:1">
                        <div class="info-icon"><i class="far fa-calendar-minus"></i></div>
                        <div class="info-text"><strong id="d-checkout">---</strong><span>Check-out</span></div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal-footer" style="margin-top:0;">
            <button type="button" class="btn-cancel" onclick="closePopup('detailPopup')" style="width:100%;">Đóng</button>
        </div>
    </div>
</div>

<script>
    // 1. Hàm mở Popup Edit
    function openEditPopup(id, name, email, phone) {
        document.getElementById('edit-id').value = id;
        document.getElementById('edit-name').value = name;
        document.getElementById('edit-email').value = email;
        document.getElementById('edit-phone').value = phone;
        document.getElementById('editPopup').style.display = "block";
    }

    // 2. Hàm mở Popup Detail (Mới)
    function viewCustomerDetail(data) {
        document.getElementById('d-id').innerText = '#' + data.booking_id;
        document.getElementById('d-name').innerText = data.first_name + ' ' + data.last_name;
        document.getElementById('d-email').innerText = data.email_address;
        document.getElementById('d-phone').innerText = data.phone_number;
        
        document.getElementById('d-room').innerText = (data.room_number || 'Chưa xếp') + ' - ' + (data.room_type || '');
        document.getElementById('d-checkin').innerText = formatDate(data.checkin_date);
        document.getElementById('d-checkout').innerText = formatDate(data.checkout_date);

        document.getElementById('detailPopup').style.display = "block";
    }

    // Hàm đóng chung
    function closePopup(modalId) {
        document.getElementById(modalId).style.display = "none";
    }

    // Format ngày
    function formatDate(dateString) {
        if(!dateString) return '--/--/----';
        const date = new Date(dateString);
        return date.toLocaleDateString('vi-VN');
    }

    // Click ngoài để đóng
    window.onclick = function(event) {
        if (event.target.classList.contains('modal')) {
            event.target.style.display = "none";
        }
    }
</script>
