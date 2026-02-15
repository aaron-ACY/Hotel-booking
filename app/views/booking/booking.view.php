<?php get_view('components/header') ?>

<style>
    /* =========================================
       1. BIẾN HỆ THỐNG & CẤU HÌNH CHUNG
       ========================================= */
    :root {
        --bg-body: #f1f5f9;
        --blue-primary: #3b82f6;
        --blue-dark: #2563eb;
        --blue-soft: #eff6ff;
        --text-main: #1e293b;
        --text-muted: #64748b;
        --border-color: #e2e8f0;
        --white: #ffffff;
        --transition: all 0.2s ease-in-out;
    }

    body {
        background-color: var(--bg-body);
        font-family: 'Inter', -apple-system, sans-serif;
        color: var(--text-main);
        margin: 0;
        line-height: 1.5;
    }

    /* =========================================
       2. BỐ CỤC CHÍNH (LAYOUT)
       ========================================= */
    .booking-wrapper {
        display: grid;
        grid-template-columns: 4fr 2fr;
        gap: 30px;
        align-items: start;
        padding: 20px;
        max-width: 1400px;
        margin: 0 auto;
        padding-bottom: 50px;
    }

    /* =========================================
       3. THÀNH PHẦN CARD (CARD CUSTOM)
       ========================================= */
    .card-custom {
        background: var(--white);
        border-radius: 16px;
        border: 1px solid var(--border-color);
        padding: 24px;
        margin-bottom: 24px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }

    .card-title {
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 20px;
        color: var(--text-main);
    }

    /* =========================================
       4. Ô NHẬP LIỆU (INPUT FIELDS)
       ========================================= */
    .search-inputs,
    .form-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 16px;
    }

    .input-box {
        margin-bottom: 15px;
    }

    .input-box label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 8px;
        color: var(--text-main);
    }

    .input-box label i {
        margin-right: 6px;
        color: var(--text-muted);
    }

    .input-box input,
    .input-box select,
    .input-box textarea {
        width: 100%;
        padding: 12px 16px;
        border: 1px solid var(--border-color);
        border-radius: 10px;
        background: var(--white);
        color: var(--text-main);
        font-size: 14px;
        outline: none;
        transition: var(--transition);
        box-sizing: border-box;
    }

    .input-box input:focus,
    .input-box textarea:focus {
        border-color: var(--blue-primary);
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    /* =========================================
       5. THẺ PHÒNG (ROOM CARDS)
       ========================================= */
    .room-card {
        display: flex;
        border: 1px solid var(--border-color);
        border-radius: 12px;
        overflow: hidden;
        margin-bottom: 20px;
        transition: var(--transition);
    }

    .room-card:hover {
        border-color: var(--blue-primary);
        transform: translateY(-2px);
    }

    .room-image {
        width: 280px;
        height: 200px;
        object-fit: cover;
        border-radius: 12px 0 0 12px;
    }

    @media (max-width: 768px) {
        .room-card {
            flex-direction: column;
        }

        .room-image {
            width: 100%;
            height: 180px;
            border-radius: 12px 12px 0 0;
        }
    }

    .room-details {
        flex: 1;
        padding: 20px;
        display: flex;
        flex-direction: column;
    }

    .room-name {
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .room-desc {
        padding-bottom: 10px;
        font-size: 14px;
        color: var(--text-muted);
    }

    .room-tags {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .tag {
        background: var(--bg-body);
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 12px;
        color: var(--text-muted);
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .room-amenities {
        display: flex;
        flex-wrap: wrap;
        gap: 12px 24px;
        margin-top: 15px;
        padding-top: 15px;
        border-top: 1px solid var(--border-color);
    }

    .room-amenities span {
        display: inline-flex;
        align-items: center;
        white-space: nowrap;
        font-size: 13px;
        color: var(--text-muted);
        gap: 8px;
    }

    .room-amenities span i {
        font-size: 16px;
        opacity: 0.8;
    }

    .price-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 15px;
    }

    .price-large {
        font-size: 22px;
        font-weight: 800;
        color: var(--blue-primary);
    }

    .price-subtext {
        font-size: 12px;
        color: var(--text-muted);
        font-weight: 400;
    }

    .btn-choose {
        background: var(--bg-body);
        border: none;
        padding: 10px 24px;
        border-radius: 10px;
        font-weight: 600;
        color: var(--text-main);
        cursor: pointer;
        transition: var(--transition);
    }

    .btn-choose:hover {
        background: var(--blue-primary);
        color: var(--white);
    }

    /* =========================================
       6. DỊCH VỤ BỔ SUNG (ADD-ONS)
       ========================================= */
    .addon-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 20px;
        border: 1px solid var(--border-color);
        border-radius: 12px;
        margin-bottom: 12px;
        transition: var(--transition);
    }

    .addon-item:hover {
        border-color: var(--blue-primary);
    }

    .addon-info {
        display: flex;
        flex-direction: column;
    }

    .addon-name {
        font-weight: 700;
        font-size: 16px;
        color: var(--text-main);
        margin-bottom: 2px;
    }

    .addon-desc {
        font-size: 13px;
        color: var(--text-muted);
        margin-bottom: 12px;
    }

    .addon-price {
        color: var(--blue-primary);
        font-weight: 700;
        font-size: 15px;
    }

    .addon-counter {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 6px 14px;
        border-radius: 30px;
        transition: var(--transition);
    }

    .circle-btn {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        border: none;
        background: var(--blue-primary);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-weight: bold;
        transition: var(--transition);
    }

    .circle-btn:disabled {
        background: #e2e8f0;
        color: #94a3b8;
        cursor: not-allowed;
    }

    .qty-val {
        font-weight: 700;
        min-width: 20px;
        text-align: center;
    }

    /* =========================================
       7. TÓM TẮT ĐẶT PHÒNG & THANH TOÁN
       ========================================= */
    .booking-right {
        position: sticky;
        top: 20px;
        z-index: 10;
    }

    .summary-row {
        display: flex;
        gap: 12px;
        margin-bottom: 15px;
    }

    .summary-icon {
        font-size: 24px;
        color: var(--text-muted);
    }

    .summary-label {
        font-size: 13px;
        color: var(--text-muted);
    }

    .summary-value-bold {
        font-weight: 600;
    }

    .summary-price-tag {
        margin-left: auto;
        font-weight: 700;
    }

    .total-amount-box {
        background: var(--blue-soft);
        padding: 15px 20px;
        border-radius: 14px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 20px 0;
    }

    .total-label {
        font-size: 12px;
        color: var(--text-muted);
    }

    .total-val {
        font-size: 24px;
        font-weight: 800;
        color: var(--blue-primary);
    }

    .btn-submit {
        width: 100%;
        background: #cbd5e1;
        color: #64748b;
        border: none;
        padding: 16px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 16px;
        cursor: not-allowed;
        transition: var(--transition);
    }

    .footer-note {
        text-align: center;
        font-size: 12px;
        color: var(--text-muted);
        margin-top: 10px;
    }

    /* =========================================
       8. CSS MỚI CHO GIAO DIỆN TÓM TẮT (ROOM SUMMARY)
       ========================================= */

    /* Khối hiển thị từng loại phòng đã chọn */
    .room-summary-item {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 15px;
        margin-bottom: 15px;
        position: relative;
    }

    /* Tiêu đề loại phòng và giá trong tóm tắt */
    .room-summary-header {
        display: flex;
        justify-content: space-between;
        align-items: start;
        margin-bottom: 10px;
    }

    .room-summary-name {
        font-weight: 700;
        color: var(--text-main);
        font-size: 15px;
    }

    .room-summary-price {
        font-size: 13px;
        color: var(--text-muted);
    }

    /* Thanh điều khiển số lượng (bên dưới khối tóm tắt) */
    .room-summary-controls {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-top: 1px dashed #e2e8f0;
        padding-top: 10px;
    }

    /* Hộp chứa nút +/- nhỏ */
    .qty-control-box {
        display: flex;
        align-items: center;
        gap: 10px;
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 20px;
        padding: 4px 8px;
    }

    /* Nút cộng trừ nhỏ cho phần tóm tắt */
    .btn-qty-mini {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        border: none;
        background: #eff6ff;
        color: var(--blue-primary);
        font-weight: bold;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: 0.2s;
    }

    .btn-qty-mini:hover {
        background: var(--blue-primary);
        color: white;
    }

    /* Tổng tiền của loại phòng đó */
    .room-total-price {
        font-weight: 700;
        color: var(--blue-primary);
        font-size: 14px;
    }

    /* Nút Xóa (dấu X) */
    .btn-remove-room {
        position: absolute;
        top: -8px;
        right: -8px;
        background: white;
        color: #ef4444;
        border: 1px solid #ef4444;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        transition: 0.2s;
    }

    .btn-remove-room:hover {
        background: #ef4444;
        color: white;
    }

    /* CSS CHO POPUP THÔNG BÁO THÀNH CÔNG */
    .success-modal {
        display: none;
        /* Mặc định ẩn */
        position: fixed;
        z-index: 2000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(5px);
        align-items: center;
        justify-content: center;
    }

    .success-content {
        background: white;
        padding: 40px;
        border-radius: 20px;
        text-align: center;
        width: 400px;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        animation: scaleUp 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    @keyframes scaleUp {
        from {
            transform: scale(0.8);
            opacity: 0;
        }

        to {
            transform: scale(1);
            opacity: 1;
        }
    }

    .success-icon-box {
        width: 80px;
        height: 80px;
        background: #dcfce7;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px auto;
    }

    .success-icon-box i {
        font-size: 40px;
        color: #166534;
    }

    .success-title {
        font-size: 24px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 10px;
    }

    .success-desc {
        color: #64748b;
        margin-bottom: 30px;
        line-height: 1.5;
    }

    .btn-close-modal {
        background: var(--blue-primary);
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 10px;
        font-weight: 600;
        cursor: pointer;
        width: 100%;
        font-size: 16px;
        transition: 0.2s;
    }

    .btn-close-modal:hover {
        background: var(--blue-dark);
    }
</style>

<form id="bookingForm" action="<?= ROOT ?>/booking/save" method="POST">

    <div class="booking-wrapper">
        <div class="booking-left">

            <div class="card-custom">
                <h3 class="card-title">Thông tin đặt phòng</h3>
                <div class="search-inputs">
                    <div class="input-box">
                        <label><i class="far fa-calendar"></i> Ngày nhận phòng</label>
                        <input type="date" id="checkin" name="checkin_date" required>
                    </div>
                    <div class="input-box">
                        <label><i class="far fa-calendar"></i> Ngày trả phòng</label>
                        <input type="date" id="checkout" name="checkout_date" required>
                    </div>
                    <div class="input-box">
                        <label><i class="far fa-user"></i> Người lớn</label>
                        <input type="number" name="num_adults" value="1" min="1">
                    </div>
                    <div class="input-box">
                        <label><i class="far fa-child"></i> Trẻ em</label>
                        <input type="number" name="num_children" value="0" min="0">
                    </div>
                </div>
            </div>

            <div class="card-custom">
                <h3 class="card-title">Chọn hạng phòng</h3>

                <div class="room-card" data-id="1" data-name="Standard" data-price="800000">
                    <img src="https://images.unsplash.com/photo-1611892440504-42a792e24d32?auto=format&fit=crop&w=400" class="room-image" alt="Standard Room">
                    <div class="room-details">
                        <div class="room-name">Standard</div>
                        <div class="room-desc">Phòng tiêu chuẩn với đầy đủ tiện nghi cơ bản.</div>
                        <div class="room-tags">
                            <span class="tag"><i class="fa-solid fa-bed"></i> 1 x Double bed</span>
                            <span class="tag"><i class="fa-solid fa-users"></i> 2 Adults (1 child)</span>
                        </div>
                        <div class="room-amenities">
                            <span><i class="fa-regular fa-wind"></i> Air conditioning</span>
                            <span><i class="fa-regular fa-wifi"></i> Wifi</span>
                        </div>
                        <div class="price-row">
                            <div class="price-large">800.000 đ <span class="price-subtext">/ đêm</span></div>
                            <button type="button" class="btn-choose" onclick="addRoom(this)">Chọn phòng</button>
                        </div>
                    </div>
                </div>

                <div class="room-card" data-id="2" data-name="Deluxe" data-price="1200000">
                    <img src="https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&w=400" class="room-image" alt="Deluxe Room">
                    <div class="room-details">
                        <div class="room-name">Deluxe</div>
                        <div class="room-desc">Phòng cao cấp có ban công thoáng mát.</div>
                        <div class="room-tags">
                            <span class="tag"><i class="fa-solid fa-bed"></i> 1 x Queen (Extra bed)</span>
                            <span class="tag"><i class="fa-solid fa-users"></i> 2 - 3 Adults</span>
                        </div>
                        <div class="room-amenities">
                            <span><i class="fa-regular fa-wind"></i> Air conditioning</span>
                            <span><i class="fa-regular fa-wifi"></i> Wifi</span>
                            <span><i class="fa-light fa-window-frame"></i> Balcony</span>
                        </div>
                        <div class="price-row">
                            <div class="price-large">1.200.000 đ <span class="price-subtext">/ đêm</span></div>
                            <button type="button" class="btn-choose" onclick="addRoom(this)">Chọn phòng</button>
                        </div>
                    </div>
                </div>

                <div class="room-card" data-id="3" data-name="Suite" data-price="2000000">
                    <img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?auto=format&fit=crop&w=400" class="room-image" alt="Suite Room">
                    <div class="room-details">
                        <div class="room-name">Suite</div>
                        <div class="room-desc">Phòng sang trọng view biển.</div>
                        <div class="room-tags">
                            <span class="tag"><i class="fa-solid fa-bed"></i> 1 x King Bed</span>
                            <span class="tag"><i class="fa-solid fa-users"></i> 3 - 4 Adults</span>
                        </div>
                        <div class="room-amenities">
                            <span><i class="fa-regular fa-wind"></i> AC</span>
                            <span><i class="fa-regular fa-wifi"></i> Wifi</span>
                            <span><i class="fa-light fa-window-frame"></i> Balcony</span>
                            <span><i class="fa-duotone fa-thin fa-bath"></i> Bathtub</span>
                            <span><i class="fa-regular fa-water"></i> Sea view</span>
                        </div>
                        <div class="price-row">
                            <div class="price-large">2.000.000 đ <span class="price-subtext">/ đêm</span></div>
                            <button type="button" class="btn-choose" onclick="addRoom(this)">Chọn phòng</button>
                        </div>
                    </div>
                </div>

                <div class="room-card" data-id="4" data-name="Presidential" data-price="5000000">
                    <img src="https://images.unsplash.com/photo-1611892440504-42a792e24d32?auto=format&fit=crop&w=400" class="room-image" alt="Presidential">
                    <div class="room-details">
                        <div class="room-name">Presidential</div>
                        <div class="room-desc">Phòng tổng thống đẳng cấp bậc nhất.</div>
                        <div class="room-tags">
                            <span class="tag"><i class="fa-solid fa-bed"></i> 2 x King Bed</span>
                            <span class="tag"><i class="fa-solid fa-users"></i> 4 - 6 Adults</span>
                        </div>
                        <div class="room-amenities">
                            <span><i class="fa-regular fa-wind"></i> AC</span>
                            <span><i class="fa-regular fa-wifi"></i> Wifi</span>
                            <span><i class="fa-duotone fa-thin fa-bath"></i> Bathtub</span>
                            <span><i class="fa-regular fa-water"></i> Sea view</span>
                            <span><i class="fa-solid fa-person-swimming-pool"></i> Private pool</span>
                        </div>
                        <div class="price-row">
                            <div class="price-large">5.000.000 đ <span class="price-subtext">/ đêm</span></div>
                            <button type="button" class="btn-choose" onclick="addRoom(this)">Chọn phòng</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-custom">
                <h3 class="card-title">Thông tin khách hàng</h3>
                <div class="form-row">
                    <div class="input-box">
                        <label>Họ <span style="color:red">*</span></label>
                        <input type="text" name="last_name" required placeholder="Nhập họ">
                    </div>
                    <div class="input-box">
                        <label>Tên <span style="color:red">*</span></label>
                        <input type="text" name="first_name" required placeholder="Nhập tên">
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-box">
                        <label>Email <span style="color:red">*</span></label>
                        <input type="email" name="email_address" required placeholder="example@email.com">
                    </div>
                    <div class="input-box">
                        <label>Số điện thoại <span style="color:red">*</span></label>
                        <input type="text" name="phone_number" required placeholder="0123456789">
                    </div>
                </div>
                <div class="input-box">
                    <label>Yêu cầu đặc biệt</label>
                    <textarea name="special_request" placeholder="Ví dụ: Tầng cao..."></textarea>
                </div>
            </div>

            <div class="card-custom">
                <h3 class="card-title">Dịch vụ bổ sung</h3>
                <p class="addon-desc">Chọn các dịch vụ bổ sung để nâng cao trải nghiệm của bạn</p>

                <div class="addon-item" data-id="1" data-name="Breakfast" data-price="250000">
                    <div class="addon-info">
                        <div class="addon-name">Breakfast</div>
                        <div class="addon-desc">Buffet sáng quốc tế (mỗi người/ngày)</div>
                        <div class="addon-price">250.000 đ</div>
                    </div>
                    <div class="addon-counter">
                        <button type="button" class="circle-btn" onclick="updateAddon(this, -1)">-</button>
                        <span class="qty-val">0</span>
                        <button type="button" class="circle-btn active" onclick="updateAddon(this, 1)">+</button>
                    </div>
                </div>

                <div class="addon-item" data-id="2" data-name="Lunch / Dinner" data-price="400000">
                    <div class="addon-info">
                        <div class="addon-name">Lunch / Dinner</div>
                        <div class="addon-desc">Buffet trưa hoặc tối</div>
                        <div class="addon-price">400.000 đ</div>
                    </div>
                    <div class="addon-counter">
                        <button type="button" class="circle-btn" onclick="updateAddon(this, -1)">-</button>
                        <span class="qty-val">0</span>
                        <button type="button" class="circle-btn active" onclick="updateAddon(this, 1)">+</button>
                    </div>
                </div>

                <div class="addon-item" data-id="3" data-name="Mini bar" data-price="120000">
                    <div class="addon-info">
                        <div class="addon-name">Mini bar</div>
                        <div class="addon-desc">Đồ uống và snack trong phòng</div>
                        <div class="addon-price">120.000 đ</div>
                    </div>
                    <div class="addon-counter">
                        <button type="button" class="circle-btn" onclick="updateAddon(this, -1)">-</button>
                        <span class="qty-val">0</span>
                        <button type="button" class="circle-btn active" onclick="updateAddon(this, 1)">+</button>
                    </div>
                </div>

                <div class="addon-item" data-id="4" data-name="Laundry service" data-price="60000">
                    <div class="addon-info">
                        <div class="addon-name">Laundry service</div>
                        <div class="addon-desc">Giặt ủi thường (kg)</div>
                        <div class="addon-price">60.000 đ</div>
                    </div>
                    <div class="addon-counter">
                        <button type="button" class="circle-btn" onclick="updateAddon(this, -1)">-</button>
                        <span class="qty-val">0</span>
                        <button type="button" class="circle-btn active" onclick="updateAddon(this, 1)">+</button>
                    </div>
                </div>

                <div class="addon-item" data-id="7" data-name="Airport transfer" data-price="600000">
                    <div class="addon-info">
                        <div class="addon-name">Airport transfer</div>
                        <div class="addon-desc">Xe đưa đón sân bay</div>
                        <div class="addon-price">600.000 đ</div>
                    </div>
                    <div class="addon-counter">
                        <button type="button" class="circle-btn" onclick="updateAddon(this, -1)">-</button>
                        <span class="qty-val">0</span>
                        <button type="button" class="circle-btn active" onclick="updateAddon(this, 1)">+</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="booking-right">
        <div class="card-custom">
            <h3 class="card-title">Tóm tắt đặt phòng</h3>

            <div id="selected-rooms-container">
                <div class="summary-row">
                    <i class="fa-solid fa-hotel summary-icon"></i>
                    <div>
                        <div class="summary-label">Phòng</div>
                        <div class="summary-value-bold">Chưa chọn phòng</div>
                    </div>
                </div>
            </div>

            <div id="selected-addons-container" style="border-top: 1px dashed #e2e8f0; margin-top: 15px; padding-top: 15px;">
            </div>

            <div class="total-amount-box">
                <div>
                    <div class="total-label">Tổng thanh toán</div>
                    <div class="total-val" id="grand-total">0 đ</div>
                </div>
                <i class="fa-solid fa-dollar-sign summary-icon"></i>
            </div>

            <input type="hidden" name="total_amount" id="input-total-amount" value="0">
            <div id="hidden-inputs-container"></div>

            <button type="submit" id="btn-submit" class="btn-submit" disabled>Vui lòng chọn phòng</button>
        </div>
    </div> -->
        <div class="booking-right">
            <div class="card-custom">
                <h3 class="card-title">Tóm tắt đặt phòng</h3>

                <div class="summary-row" style="border-bottom: 1px solid #f1f5f9; padding-bottom: 15px; margin-bottom: 15px;">
                    <div>
                        <div class="summary-label">Thời gian lưu trú</div>
                        <div class="summary-value-bold" id="stay-dates">Chưa chọn ngày</div>
                        <div class="badge badge-success" id="total-nights-badge" style="margin-top:5px; display:inline-block">0 đêm</div>
                    </div>
                </div>

                <div id="selected-rooms-container">
                    <p class="text-muted" style="font-size:13px; text-align:center;">Vui lòng chọn phòng</p>
                </div>

                <div id="selected-addons-container"></div>

                <div class="total-amount-box">
                    <div>
                        <div class="total-label">Tổng thanh toán</div>
                        <div class="total-val" id="grand-total">0 đ</div>
                    </div>
                </div>

                <input type="hidden" name="total_amount" id="input-total-amount" value="0">
                <div id="hidden-inputs-container"></div>

                <button type="submit" id="btn-submit" class="btn-submit" disabled>Vui lòng chọn phòng</button>
            </div>
        </div>
    </div>
    </div>

</form>

<div id="successModal" class="success-modal">
    <div class="success-content">
        <div class="success-icon-box">
            <i class="fa-solid fa-check"></i>
        </div>
        <h3 class="success-title">Đặt phòng thành công!</h3>
        <p class="success-desc">Cảm ơn bạn đã đặt phòng. Chúng tôi đã ghi nhận thông tin và sẽ liên hệ sớm nhất.</p>
        <button type="button" class="btn-close-modal" onclick="closeSuccessModal()">Hoàn tất</button>
    </div>
</div>

<script>
    // State quản lý dữ liệu
    let bookingData = {
        rooms: {}, 
        addons: {},
        nights: 0
    };

    const checkinInput = document.getElementById('checkin');
    const checkoutInput = document.getElementById('checkout');

    // 1. Tính số đêm
    function calculateNights() {
        const d1 = new Date(checkinInput.value);
        const d2 = new Date(checkoutInput.value);
        const dateLabel = document.getElementById('stay-dates');
        const badge = document.getElementById('total-nights-badge');

        if (checkinInput.value && checkoutInput.value && d2 > d1) {
            const diffTime = Math.abs(d2 - d1);
            bookingData.nights = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            
            dateLabel.innerText = `${d1.toLocaleDateString('vi-VN')} - ${d2.toLocaleDateString('vi-VN')}`;
            badge.innerText = `${bookingData.nights} đêm`;
            badge.style.display = 'inline-block';
        } else {
            bookingData.nights = 0;
            dateLabel.innerText = "Chưa chọn ngày hợp lệ";
            badge.style.display = 'none';
        }
        updateUI();
    }

    // 2. CHỌN LOẠI PHÒNG (LOGIC ĐÃ FIX LỖI)
    function addRoom(btn) {
        const card = btn.closest('.room-card');
        const id = card.dataset.id;
        
        // Trường hợp 1: Phòng này ĐÃ CÓ trong giỏ (Trùng ID)
        if (bookingData.rooms[id]) {
            alert("Bạn đang chọn phòng này rồi. Vui lòng tăng số lượng ở phần tóm tắt bên phải.");
            return; 
        }

        // Trường hợp 2: ĐÃ CÓ PHÒNG KHÁC trong giỏ (Khác ID)
        // Kiểm tra xem object rooms có đang chứa key nào không
        if (Object.keys(bookingData.rooms).length > 0) {
            // Hỏi xác nhận thay thế
            const confirmChange = confirm("Bạn chỉ được chọn 1 loại phòng duy nhất. Bạn có muốn đổi sang loại phòng này và bỏ loại cũ không?");
            
            if (!confirmChange) {
                return; // Nếu khách chọn Cancel -> Không làm gì cả
            }
            
            // Nếu khách chọn OK -> Xóa sạch phòng cũ
            bookingData.rooms = {}; 
        }

        // Thêm phòng mới vào (Mặc định số lượng = 1)
        bookingData.rooms[id] = {
            id: id,
            name: card.dataset.name,
            price: parseInt(card.dataset.price),
            qty: 1
        };
        updateUI();
    }

    // 3. TĂNG/GIẢM SỐ LƯỢNG (LOGIC MỚI: TỐI THIỂU LÀ 1)
    function changeRoomQty(id, delta) {
        if (bookingData.rooms[id]) {
            let newQty = bookingData.rooms[id].qty + delta;
            
            // CHẶN: Nếu số lượng mới < 1 thì DỪNG NGAY (Không xóa, không giảm)
            if (newQty < 1) return; 

            bookingData.rooms[id].qty = newQty;
            updateUI();
        }
    }

    // 4. NÚT XÓA (X): Đây là cách duy nhất để xóa phòng khỏi danh sách
    function removeRoomType(id) {
        if(confirm('Bạn có chắc muốn xóa phòng này khỏi đơn đặt không?')) {
            delete bookingData.rooms[id];
            updateUI();
        }
    }

    // 5. Update Addons
    function updateAddon(btn, change) {
        const item = btn.closest('.addon-item');
        const id = item.dataset.id;
        const name = item.dataset.name;
        const price = parseInt(item.dataset.price);
        const qtySpan = item.querySelector('.qty-val');
        
        let currentQty = parseInt(qtySpan.textContent);
        let newQty = currentQty + change;

        if (newQty >= 0) {
            qtySpan.textContent = newQty;
            if (newQty > 0) {
                bookingData.addons[id] = { name, price, qty: newQty };
            } else {
                delete bookingData.addons[id];
            }
            updateUI();
        }
    }

    // 6. Cập nhật giao diện
    function updateUI() {
        const roomContainer = document.getElementById('selected-rooms-container');
        const addonContainer = document.getElementById('selected-addons-container');
        const hiddenContainer = document.getElementById('hidden-inputs-container');
        const btnSubmit = document.getElementById('btn-submit');
        let grandTotal = 0;
        
        roomContainer.innerHTML = '';
        addonContainer.innerHTML = '';
        hiddenContainer.innerHTML = '';

        // --- RENDER PHÒNG ---
        const roomIds = Object.keys(bookingData.rooms);
        
        if (roomIds.length === 0) {
            roomContainer.innerHTML = `<p class="text-muted" style="font-size:13px; text-align:center; padding:10px;">Vui lòng chọn phòng</p>`;
        } else {
            roomIds.forEach(id => {
                const room = bookingData.rooms[id];
                const nightsDisplay = bookingData.nights > 0 ? bookingData.nights : 1;
                const totalItemPrice = room.price * room.qty * nightsDisplay;
                
                if(bookingData.nights > 0) grandTotal += totalItemPrice;

                roomContainer.innerHTML += `
                    <div class="room-summary-item">
                        <button type="button" class="btn-remove-room" onclick="removeRoomType('${id}')">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                        
                        <div class="room-summary-header">
                            <div>
                                <div class="room-summary-name">${room.name}</div>
                                <div class="room-summary-price">
                                    ${room.price.toLocaleString()}đ x ${nightsDisplay} đêm
                                </div>
                            </div>
                        </div>

                        <div class="room-summary-controls">
                            <div class="qty-control-box">
                                <button type="button" class="btn-qty-mini" onclick="changeRoomQty('${id}', -1)">-</button>
                                <span style="font-size:14px; font-weight:600; min-width:20px; text-align:center;">${room.qty}</span>
                                <button type="button" class="btn-qty-mini" onclick="changeRoomQty('${id}', 1)">+</button>
                            </div>
                            <div class="room-total-price">
                                ${totalItemPrice.toLocaleString()} đ
                            </div>
                        </div>
                    </div>
                `;

                // Tạo input ẩn (ví dụ chọn 3 phòng thì tạo 3 input gửi về server)
                for(let i = 0; i < room.qty; i++) {
                    hiddenContainer.innerHTML += `<input type="hidden" name="room_ids[]" value="${room.id}">`;
                }
            });
        }

        // --- RENDER ADDONS ---
        const addonIds = Object.keys(bookingData.addons);
        if(addonIds.length > 0) {
            addonContainer.innerHTML = `<div style="border-top:1px dashed #e2e8f0; margin-top:15px; padding-top:15px;"></div>`;
            addonIds.forEach(id => {
                const addon = bookingData.addons[id];
                const totalAddon = addon.price * addon.qty;
                grandTotal += totalAddon;

                addonContainer.innerHTML += `
                    <div class="summary-row">
                        <div>
                            <div class="summary-value-bold" style="font-size:14px;">${addon.name} <span style="font-weight:400; color:#64748b">x ${addon.qty}</span></div>
                        </div>
                        <div class="summary-price-tag" style="font-size:14px;">${totalAddon.toLocaleString()} đ</div>
                    </div>
                `;
                for(let i=0; i < addon.qty; i++) {
                    hiddenContainer.innerHTML += `<input type="hidden" name="addon_ids[]" value="${id}">`;
                }
            });
        }

        // --- TỔNG KẾT ---
        document.getElementById('grand-total').innerText = grandTotal.toLocaleString() + ' đ';
        document.getElementById('input-total-amount').value = grandTotal;

        if (roomIds.length > 0 && bookingData.nights > 0) {
            btnSubmit.disabled = false;
            btnSubmit.style.background = 'var(--blue-primary)';
            btnSubmit.textContent = 'Xác nhận đặt phòng';
            btnSubmit.style.cursor = 'pointer';
        } else {
            btnSubmit.disabled = true;
            btnSubmit.style.background = '#cbd5e1';
            btnSubmit.textContent = 'Vui lòng chọn phòng & ngày';
            btnSubmit.style.cursor = 'not-allowed';
        }
    }

    // --- XỬ LÝ SUBMIT AJAX (POP-UP SUCCESS) ---
    const bookingForm = document.getElementById('bookingForm');
    const successModal = document.getElementById('successModal'); 

    if(bookingForm) {
        bookingForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const submitBtn = document.getElementById('btn-submit');
            const originalBtnText = submitBtn.textContent;
            
            submitBtn.disabled = true;
            submitBtn.textContent = 'Đang xử lý...';

            const formData = new FormData(this);

            fetch(this.action, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    // Hiện modal nếu có (đảm bảo bạn đã copy HTML modal ở bước trước)
                    if(document.getElementById('successModal')) {
                        document.getElementById('successModal').style.display = 'flex';
                    } else {
                        alert("Đặt phòng thành công!");
                        window.location.reload();
                    }
                    resetBooking();
                } else {
                    alert('Có lỗi: ' + (data.message || 'Vui lòng thử lại'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Lỗi kết nối server hoặc cấu trúc JSON trả về không đúng.');
            })
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.textContent = originalBtnText;
            });
        });
    }

    function closeSuccessModal() {
        document.getElementById('successModal').style.display = 'none';
    }

    function resetBooking() {
        bookingData = { rooms: {}, addons: {}, nights: 0 };
        bookingForm.reset();
        document.getElementById('stay-dates').innerText = 'Chưa chọn ngày';
        document.getElementById('total-nights-badge').style.display = 'none';
        updateUI();
    }

    checkinInput.addEventListener('change', calculateNights);
    checkoutInput.addEventListener('change', calculateNights);
</script>

<?php get_view('components/footer') ?>
