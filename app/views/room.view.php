<?php get_view('components/header') ?>

<style>
    /* 1. FILTER & SEARCH */
    .filter-section {
        background: white;
        padding: 20px;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        margin-bottom: 25px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02);
    }

    .search-bar {
        position: relative;
        margin-bottom: 20px;
        max-width: 400px;
    }

    .search-bar input {
        width: 100%;
        padding: 12px 15px 12px 45px;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        outline: none;
    }

    .search-bar i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
    }

    .filter-tabs {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .filter-chip {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 8px 16px;
        border-radius: 30px;
        border: 1px solid #e2e8f0;
        background: white;
        color: #64748b;
        font-size: 13px;
        font-weight: 500;
        cursor: pointer;
        transition: 0.2s;
    }

    .filter-chip:hover,
    .filter-chip.active {
        border-color: var(--blue-primary);
        color: var(--blue-primary);
        background: #eff6ff;
    }

    .filter-chip .count {
        background: #e2e8f0;
        color: #64748b;
        padding: 2px 8px;
        border-radius: 10px;
        font-size: 11px;
    }

    .filter-chip.active .count {
        background: var(--blue-primary);
        color: white;
    }

    /* 2. FLOOR & GRID */
    .floor-container {
        background: white;
        border-radius: 16px;
        padding: 25px;
        border: 1px solid #e2e8f0;
        margin-bottom: 30px;
    }

    .floor-header {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
        gap: 15px;
    }

    .floor-icon {
        width: 40px;
        height: 40px;
        background: #1e293b;
        color: white;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .room-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 20px;
    }

    /* 3. ROOM CARD */
    .room-item {
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 20px;
        position: relative;
        transition: 0.2s;
        cursor: pointer;
        background: white;
        border-left: 5px solid transparent;
    }

    .room-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
    }

    /* Status Colors */
    .status-1 {
        border-left-color: #22c55e;
    }

    /* Available */
    .status-2 {
        border-left-color: #3b82f6;
    }

    /* Occupied */
    .status-3 {
        border-left-color: #ef4444;
    }

    /* Maintenance */
    .status-4 {
        border-left-color: #f59e0b;
    }

    /* Cleaning */

    .room-number {
        font-size: 20px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 5px;
    }

    .room-type {
        font-size: 13px;
        color: #64748b;
        margin-bottom: 15px;
    }

    .status-badge {
        position: absolute;
        top: 20px;
        right: 20px;
        font-size: 11px;
        padding: 4px 10px;
        border-radius: 20px;
        font-weight: 600;
    }

    .badge-1 {
        background: #dcfce7;
        color: #166534;
    }

    .badge-2 {
        background: #dbeafe;
        color: #1e40af;
    }

    .badge-3 {
        background: #fee2e2;
        color: #991b1b;
    }

    .badge-4 {
        background: #fef3c7;
        color: #92400e;
    }

    .guest-info-mini {
        padding-top: 10px;
        border-top: 1px dashed #e2e8f0;
        margin-top: 10px;
    }

    .guest-name {
        font-weight: 600;
        font-size: 14px;
        color: #1e293b;
        display: block;
    }

    .checkout-date {
        font-size: 12px;
        color: #64748b;
    }

    /* 4. MODAL RIGHT-SIDE */
    .room-modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 2000;
        backdrop-filter: blur(2px);
    }

    .room-modal-content {
        position: absolute;
        top: 0;
        right: 0;
        height: 100%;
        width: 400px;
        background: white;
        padding: 30px;
        box-shadow: -5px 0 25px rgba(0, 0, 0, 0.1);
        animation: slideIn 0.3s ease-out;
        overflow-y: auto;
    }

    @keyframes slideIn {
        from {
            right: -400px;
        }

        to {
            right: 0;
        }
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: start;
        margin-bottom: 30px;
    }

    .modal-title {
        font-size: 24px;
        font-weight: 800;
        margin: 0;
        color: #1e293b;
    }

    .modal-subtitle {
        font-size: 14px;
        color: #64748b;
        margin-top: 5px;
    }

    .close-modal {
        cursor: pointer;
        font-size: 24px;
        color: #94a3b8;
        transition: 0.2s;
    }

    .close-modal:hover {
        color: #ef4444;
    }

    .price-card {
        background: #3b82f6;
        color: white;
        padding: 20px;
        border-radius: 12px;
        margin-bottom: 25px;
    }

    .price-val {
        font-size: 28px;
        font-weight: 700;
    }

    .price-label {
        font-size: 13px;
        opacity: 0.9;
    }

    .info-group {
        margin-bottom: 25px;
    }

    .info-label {
        font-size: 12px;
        font-weight: 700;
        color: #94a3b8;
        text-transform: uppercase;
        margin-bottom: 10px;
        display: block;
    }

    .info-box {
        background: #f8fafc;
        border-radius: 12px;
        padding: 15px;
    }

    .info-row {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 12px;
    }

    .info-row:last-child {
        margin-bottom: 0;
    }

    .info-icon {
        width: 30px;
        height: 30px;
        background: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #3b82f6;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .info-text strong {
        display: block;
        font-size: 14px;
        color: #1e293b;
    }

    .info-text span {
        font-size: 12px;
        color: #64748b;
    }

    .btn-action {
        width: 100%;
        padding: 15px;
        border-radius: 12px;
        border: none;
        font-weight: 600;
        font-size: 15px;
        cursor: pointer;
        margin-top: 10px;
        transition: 0.2s;
    }

    .btn-book {
        background: #3b82f6;
        color: white;
    }

    .btn-book:hover {
        background: #2563eb;
    }

    .btn-clean {
        background: #22c55e;
        color: white;
    }

    .btn-clean:hover {
        background: #16a34a;
    }

    .btn-maintain {
        background: #ef4444;
        color: white;
    }
</style>

<div style="margin-bottom: 30px;">
    <h2 style="font-size: 24px; font-weight: 700; color: #1e293b; margin: 0;">Quản lý phòng</h2>
    <p style="color: #64748b; margin: 5px 0 0;">Giám sát trạng thái phòng theo thời gian thực</p>
</div>

<div class="filter-section">
    <div class="search-bar">
        <i class="far fa-search"></i>
        <input type="text" id="roomSearch" placeholder="Tìm theo số phòng..." onkeyup="filterRooms()">
    </div>
    <div class="filter-tabs">
        <div class="filter-chip active" onclick="filterStatus('all', this)"><i class="fas fa-home"></i> Tất cả <span class="count"><?= $stats['total'] ?></span></div>
        <div class="filter-chip" onclick="filterStatus(1, this)"><i class="far fa-check-circle" style="color: #22c55e;"></i> Trống <span class="count"><?= $stats['available'] ?></span></div>
        <div class="filter-chip" onclick="filterStatus(2, this)"><i class="far fa-user" style="color: #3b82f6;"></i> Đã thuê <span class="count"><?= $stats['occupied'] ?></span></div>
        <div class="filter-chip" onclick="filterStatus(4, this)"><i class="far fa-sparkles" style="color: #f59e0b;"></i> Dọn dẹp <span class="count"><?= $stats['cleaning'] ?></span></div>
        <div class="filter-chip" onclick="filterStatus(3, this)"><i class="far fa-tools" style="color: #ef4444;"></i> Bảo trì <span class="count"><?= $stats['maintenance'] ?></span></div>
    </div>
</div>

<?php if (!empty($floors)): ?>
    <?php foreach ($floors as $floorNum => $rooms): ?>
        <div class="floor-container">
            <div class="floor-header">
                <div class="floor-icon"><i class="far fa-building"></i></div>
                <div>
                    <h3 style="margin:0; font-size:18px;">Tầng <?= $floorNum ?></h3><span style="font-size:13px; color:#64748b;"><?= count($rooms) ?> phòng</span>
                </div>
            </div>
            <div class="room-grid">
                <?php foreach ($rooms as $room): ?>
                    <?php
                    // --- [MỚI] THÊM BOOKING_ID VÀ STATUS VÀO JSON ---
                    $roomData = json_encode([
                        'id' => $room->id,
                        'number' => $room->room_number,
                        'type' => $room->class_name,
                        'price' => $room->base_price,
                        'status' => $room->status_id,
                        'status_name' => $room->status_name,
                        'floor' => $floorNum,
                        'guest' => $room->current_guest,
                        'checkin' => $room->checkin_date ? date('d/m/Y', strtotime($room->checkin_date)) : null,
                        'checkout' => $room->checkout_date ? date('d/m/Y', strtotime($room->checkout_date)) : null,
                        'booking_id' => $room->booking_id ?? null,       // Mới
                        'booking_status' => $room->booking_status ?? null // Mới
                    ]);
                    ?>

                    <div class="room-item status-<?= $room->status_id ?>"
                        data-status="<?= $room->status_id ?>"
                        data-number="<?= $room->room_number ?>"
                        onclick='openRoomModal(<?= $roomData ?>)'>

                        <div class="room-number"><?= $room->room_number ?></div>
                        <div class="room-type"><?= $room->class_name ?></div>
                        <div class="status-badge badge-<?= $room->status_id ?>"><?= $room->status_name ?></div>

                        <div style="font-size:13px; color:#94a3b8; display:flex; gap:10px;">
                            <span><i class="far fa-bed"></i> 1</span>
                            <span><i class="far fa-user-friends"></i> 2</span>
                        </div>

                        <?php if ($room->status_id == 2 && !empty($room->current_guest)): ?>
                            <div class="guest-info-mini">
                                <span class="guest-name"><?= $room->current_guest ?></span>
                                <span class="checkout-date"><i class="far fa-clock"></i> Trả: <?= date('d/m/Y', strtotime($room->checkout_date)) ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<div id="roomModal" class="room-modal">
    <div class="room-modal-content">
        <div class="modal-header">
            <div>
                <h3 class="modal-title" id="m-room-number">Phòng 101</h3>
                <div class="modal-subtitle" id="m-room-type">Standard - Tầng 1</div>
            </div>
            <div class="close-modal" onclick="closeRoomModal()"><i class="fa-solid fa-xmark"></i></div>
        </div>

        <div class="price-card">
            <div class="price-label">Giá phòng</div>
            <div class="price-val" id="m-price">0 đ</div>
            <div class="price-label">mỗi đêm</div>
        </div>

        <div class="info-group" id="guest-info-block" style="display:none;">
            <label class="info-label">Thông tin khách hàng</label>
            <div class="info-box">
                <div class="info-row">
                    <div class="info-icon"><i class="far fa-user"></i></div>
                    <div class="info-text"><strong id="m-guest">Unknown</strong><span>Tên khách</span></div>
                </div>
                <div class="info-row">
                    <div class="info-icon"><i class="far fa-calendar-check"></i></div>
                    <div class="info-text"><strong id="m-checkin">--/--/----</strong><span>Ngày nhận phòng</span></div>
                </div>
                <div class="info-row">
                    <div class="info-icon"><i class="far fa-calendar-minus"></i></div>
                    <div class="info-text"><strong id="m-checkout">--/--/----</strong><span>Ngày trả phòng</span></div>
                </div>
            </div>
        </div>

        <div class="info-group">
            <label class="info-label">Thông tin phòng</label>
            <div class="info-box">
                <div class="info-row">
                    <div class="info-icon"><i class="far fa-bed"></i></div>
                    <div class="info-text"><strong>1 Giường đôi</strong><span>Loại giường</span></div>
                </div>
                <div class="info-row">
                    <div class="info-icon"><i class="far fa-user-friends"></i></div>
                    <div class="info-text"><strong>2 Người lớn</strong><span>Sức chứa</span></div>
                </div>
            </div>
        </div>

        <div class="info-group">
            <label class="info-label">Tiện nghi</label>
            <div style="display:flex; gap:10px; flex-wrap:wrap;">
                <span class="filter-chip"><i class="far fa-wifi"></i> Wifi</span>
                <span class="filter-chip"><i class="far fa-tv"></i> TV</span>
                <span class="filter-chip"><i class="far fa-snowflake"></i> AC</span>
            </div>
        </div>

        <div id="action-buttons"></div>
    </div>
</div>

<script>
    function openRoomModal(room) {
        // 1. Điền dữ liệu cơ bản
        document.getElementById('m-room-number').innerText = 'Phòng ' + room.number;
        document.getElementById('m-room-type').innerText = room.type + ' • Tầng ' + room.floor;
        document.getElementById('m-price').innerText = parseInt(room.price).toLocaleString() + ' đ';

        // 2. Xử lý hiển thị theo trạng thái
        const guestBlock = document.getElementById('guest-info-block');
        const actionDiv = document.getElementById('action-buttons');
        actionDiv.innerHTML = ''; // Reset nút

        // LOGIC TRẠNG THÁI
        if (room.status == 2) { // Occupied (Đã thuê)
            guestBlock.style.display = 'block';
            document.getElementById('m-guest').innerText = room.guest;
            document.getElementById('m-checkin').innerText = room.checkin;
            document.getElementById('m-checkout').innerText = room.checkout;

            // --- [MỚI] HIỂN THỊ NÚT DỰA VÀO TRẠNG THÁI BOOKING ---
            if (room.booking_status == 'pending') {
                // Khách chưa check-in -> Hiện nút CHECK-IN
                actionDiv.innerHTML = `
                    <a href="<?= ROOT ?>/booking/checkin/${room.booking_id}" class="btn-action btn-clean" style="text-align:center; display:block; text-decoration:none; background: #22c55e;">
                        <i class="fa-solid fa-check-to-slot"></i> Check-in Nhận phòng
                    </a>`;
            } else if (room.booking_status == 'checked_in') {
                // Khách đang ở -> Hiện nút CHECK-OUT
                actionDiv.innerHTML = `
        <a href="<?= ROOT ?>/payment/checkout/${room.booking_id}" 
           class="btn-action" 
           style="text-align:center; display:block; text-decoration:none; background: #005baa; color: white;">
            <i class="fa-solid fa-credit-card"></i> Thanh toán VNPay & Trả phòng
        </a>
        
        <a href="<?= ROOT ?>/booking/checkout/${room.booking_id}" 
           onclick="return confirm('Xác nhận trả phòng tiền mặt?')"
           style="display:block; text-align:center; margin-top:10px; font-size:13px; color:#64748b;">
           Trả phòng thủ công (Tiền mặt)
        </a>
        `;
            } else {
                // Dự phòng (hiếm khi xảy ra)
                actionDiv.innerHTML = `<button class="btn-action btn-clean" onclick="location.href='<?= ROOT ?>/admin'">Xem chi tiết</button>`;
            }
        } else if (room.status == 1) { // Available (Trống)
            guestBlock.style.display = 'none';
            // Nút: Đặt phòng
            actionDiv.innerHTML = `<button class="btn-action btn-book" onclick="location.href='<?= ROOT ?>/booking'">Đặt phòng ngay</button>`;
        } else if (room.status == 4) { // Cleaning (Dọn dẹp)
            guestBlock.style.display = 'none';
            // Nút: Hoàn thành dọn dẹp -> chuyển về Available (1)
            actionDiv.innerHTML = `
                <form action="<?= ROOT ?>/room/update_status" method="POST">
                    <input type="hidden" name="room_id" value="${room.id}">
                    <input type="hidden" name="status_id" value="1">
                    <button type="submit" class="btn-action btn-clean">Hoàn thành dọn dẹp</button>
                </form>`;
        } else if (room.status == 3) { // Maintenance (Bảo trì)
            guestBlock.style.display = 'none';
            // Nút: Hoàn thành bảo trì -> chuyển về Cleaning (4) hoặc Available (1)
            actionDiv.innerHTML = `
                <form action="<?= ROOT ?>/room/update_status" method="POST">
                    <input type="hidden" name="room_id" value="${room.id}">
                    <input type="hidden" name="status_id" value="1">
                    <button type="submit" class="btn-action btn-clean">Hoàn thành bảo trì</button>
                </form>`;
        }

        // Hiện modal
        document.getElementById('roomModal').style.display = 'block';
    }

    function closeRoomModal() {
        document.getElementById('roomModal').style.display = 'none';
    }

    // Filter Logic
    function filterStatus(statusId, btn) {
        document.querySelectorAll('.filter-chip').forEach(c => c.classList.remove('active'));
        btn.classList.add('active');

        const rooms = document.querySelectorAll('.room-item');
        rooms.forEach(r => {
            if (statusId == 'all' || r.dataset.status == statusId) {
                r.style.display = 'block';
            } else {
                r.style.display = 'none';
            }
        });
    }

    function filterRooms() {
        const term = document.getElementById('roomSearch').value.toLowerCase();
        const rooms = document.querySelectorAll('.room-item');
        rooms.forEach(r => {
            const num = r.dataset.number.toString();
            if (num.includes(term)) r.style.display = 'block';
            else r.style.display = 'none';
        });
    }

    // Đóng khi click ngoài
    window.onclick = function(e) {
        if (e.target == document.getElementById('roomModal')) closeRoomModal();
    }
</script>

<?php get_view('components/footer') ?>
