<?php get_view('admin/header') ?>

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
        width: 260px;
        height: 200px;
        object-fit: cover;
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

    /* Tiện ích phòng */
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

    /* Giá và Nút chọn */
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

    .addon-total {
        margin-top: 12px;
        padding-top: 12px;
        font-size: 14px;
        color: var(--blue-primary);
        font-weight: 500;
        display: none;
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

    /* Điều khiển số lượng */
    .addon-control {
        display: flex;
        align-items: center;
        gap: 12px;
        background: #f8fafc;
        padding: 6px 14px;
        border-radius: 30px;
    }

    .addon-counter {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 6px 14px;
        border-radius: 30px;
        transition: var(--transition);
        margin-bottom: 40px;
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
       7. TÓM TẮT ĐẶT PHÒNG (SIDEBAR)
       ========================================= */
    .booking-right {
        position: sticky;
        top: 20px;
        z-index: 10;
    }

    .summary-row {
        display: flex;
        gap: 12px;
        margin-bottom: 20px;
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

    .guest-info {
        font-size: 14px;
        margin-bottom: 20px;
        border-top: 1px solid #f1f5f9;
        padding-top: 15px;
    }

    .payment-title {
        font-size: 14px;
        font-weight: 700;
        margin-bottom: 15px;
    }

    /* Phương thức thanh toán */
    .method-card {
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 14px 16px;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 12px;
        cursor: pointer;
        transition: var(--transition);
    }

    .method-card:hover {
        border-color: var(--blue-primary);
    }

    .method-card:has(input:checked) {
        border-color: var(--blue-primary);
        background: var(--blue-soft);
    }

    /* Tổng thanh toán */
    .total-amount-box {
        background: var(--blue-soft);
        padding: 10px 20px;
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
        font-size: 26px;
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
</style>

<div class="booking-wrapper">
    <div class="booking-left">

        <div class="card-custom">
            <h3 class="card-title">Tìm kiếm phòng</h3>
            <div class="search-inputs">
                <div class="input-box">
                    <label><i class="far fa-calendar"></i> Ngày nhận phòng</label>
                    <input type="date">
                </div>
                <div class="input-box">
                    <label><i class="far fa-calendar"></i> Ngày trả phòng</label>
                    <input type="date">
                </div>
                <div class="input-box">
                    <label><i class="far fa-user"></i> Người lớn</label>
                    <input type="number" value="0" min="0">
                </div>
                <div class="input-box">
                    <label><i class="far fa-child"></i> Trẻ em</label>
                    <input type="number" value="0" min="0">
                </div>
            </div>
        </div>

        <div class="card-custom">
            <h3 class="card-title">Chọn hạng phòng</h3>

            <div class="room-card">
                <img src="https://images.unsplash.com/photo-1611892440504-42a792e24d32?auto=format&fit=crop&w=400" class="room-image" alt="Standard Room">
                <div class="room-details">
                    <div class="room-name">Phòng Standard</div>
                    <div class="room-desc">Phòng tiêu chuẩn với đầy đủ tiện nghi cơ bản, phù hợp cho 2 người.</div>
                    <div class="room-tags">
                        <span class="tag"><i class="fa-solid fa-bed"></i> 1 x Giường đôi</span>
                        <span class="tag"><i class="fa-solid fa-users"></i> Tối đa 2 người</span>
                    </div>
                    <div class="room-amenities">
                        <span><i class="fa-regular fa-wifi"></i> Wifi miễn phí</span>
                        <span><i class="fa-regular fa-wind"></i> Điều hòa</span>
                        <span><i class="fa-regular fa-tv"></i> TV</span>
                        <span><i class="fa-regular fa-mug-hot"></i> Minibar</span>
                    </div>
                    <div class="price-row">
                        <div class="price-large">1.200.000 đ <span class="price-subtext">mỗi đêm</span></div>
                        <button class="btn-choose">Chọn phòng</button>
                    </div>
                </div>
            </div>

            <div class="room-card">
                <img src="https://images.unsplash.com/photo-1611892440504-42a792e24d32?auto=format&fit=crop&w=400" class="room-image" alt="Standard Room">
                <div class="room-details">
                    <div class="room-name">Phòng Standard</div>
                    <div class="room-desc">Phòng tiêu chuẩn với đầy đủ tiện nghi cơ bản, phù hợp cho 2 người.</div>
                    <div class="room-tags">
                        <span class="tag"><i class="fa-solid fa-bed"></i> 1 x Giường đôi</span>
                        <span class="tag"><i class="fa-solid fa-users"></i> Tối đa 2 người</span>
                    </div>
                    <div class="room-amenities">
                        <span><i class="fa-regular fa-wifi"></i> Wifi miễn phí</span>
                        <span><i class="fa-regular fa-wind"></i> Điều hòa</span>
                        <span><i class="fa-regular fa-tv"></i> TV</span>
                        <span><i class="fa-regular fa-mug-hot"></i> Minibar</span>
                    </div>
                    <div class="price-row">
                        <div class="price-large">1.200.000 đ <span class="price-subtext">mỗi đêm</span></div>
                        <button class="btn-choose">Chọn phòng</button>
                    </div>
                </div>
            </div>

            <div class="room-card">
                <img src="https://images.unsplash.com/photo-1611892440504-42a792e24d32?auto=format&fit=crop&w=400" class="room-image" alt="Standard Room">
                <div class="room-details">
                    <div class="room-name">Phòng Standard</div>
                    <div class="room-desc">Phòng tiêu chuẩn với đầy đủ tiện nghi cơ bản, phù hợp cho 2 người.</div>
                    <div class="room-tags">
                        <span class="tag"><i class="fa-solid fa-bed"></i> 1 x Giường đôi</span>
                        <span class="tag"><i class="fa-solid fa-users"></i> Tối đa 2 người</span>
                    </div>
                    <div class="room-amenities">
                        <span><i class="fa-regular fa-wifi"></i> Wifi miễn phí</span>
                        <span><i class="fa-regular fa-wind"></i> Điều hòa</span>
                        <span><i class="fa-regular fa-tv"></i> TV</span>
                        <span><i class="fa-regular fa-mug-hot"></i> Minibar</span>
                        <span><i class="fa-regular fa-mug-hot"></i> Minibar</span>
                        <span><i class="fa-regular fa-mug-hot"></i> Minibar</span>
                        <span><i class="fa-regular fa-mug-hot"></i> Minibar</span>
                    </div>
                    <div class="price-row">
                        <div class="price-large">1.200.000 đ <span class="price-subtext">mỗi đêm</span></div>
                        <button class="btn-choose">Chọn phòng</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-custom">
            <h3 class="card-title">Thông tin khách hàng</h3>
            <div class="form-row">
                <div class="input-box">
                    <label>Họ <span style="color:red">*</span></label>
                    <input type="text" placeholder="Nhập họ">
                </div>
                <div class="input-box">
                    <label>Tên <span style="color:red">*</span></label>
                    <input type="text" placeholder="Nhập tên">
                </div>
            </div>
            <div class="form-row">
                <div class="input-box">
                    <label>Email <span style="color:red">*</span></label>
                    <input type="email" placeholder="example@email.com">
                </div>
                <div class="input-box">
                    <label>Số điện thoại <span style="color:red">*</span></label>
                    <input type="text" placeholder="0123456789">
                </div>
            </div>
            <div class="input-box">
                <label>Yêu cầu đặc biệt (Tùy chọn)</label>
                <textarea placeholder="Ví dụ: Tầng cao, giường thêm cho trẻ em..."></textarea>
            </div>
        </div>

        <div class="card-custom">
            <h3 class="card-title">Dịch vụ bổ sung</h3>
            <p class="addon-desc">Chọn các dịch vụ bổ sung để nâng cao trải nghiệm của bạn</p>

            <div class="addon-item">
                <div class="addon-info">
                    <div class="addon-name">Ăn sáng buffet</div>
                    <div class="addon-desc">Buffet sáng quốc tế (mỗi người/ngày)</div>
                    <div class="addon-price">250.000 đ</div>
                    <div class="addon-total">Tổng: 1.500.000 đ</div>
                </div>
                <div class="addon-counter">
                    <button class="circle-btn">-</button>
                    <span class="qty-val">0</span>
                    <button class="circle-btn active">+</button>
                </div>
            </div>

            <div class="addon-item">
                <div class="addon-info">
                    <div class="addon-name">Ăn sáng buffet</div>
                    <div class="addon-desc">Buffet sáng quốc tế (mỗi người/ngày)</div>
                    <div class="addon-price">250.000 đ</div>
                    <div class="addon-total">Tổng: 1.500.000 đ</div>
                </div>
                <div class="addon-counter">
                    <button class="circle-btn">-</button>
                    <span class="qty-val">0</span>
                    <button class="circle-btn active">+</button>
                </div>
            </div>

            <div class="addon-item">
                <div class="addon-info">
                    <div class="addon-name">Ăn sáng buffet</div>
                    <div class="addon-desc">Buffet sáng quốc tế (mỗi người/ngày)</div>
                    <div class="addon-price">250.000 đ</div>
                    <div class="addon-total">Tổng: 1.500.000 đ</div>
                </div>
                <div class="addon-counter">
                    <button class="circle-btn">-</button>
                    <span class="qty-val">0</span>
                    <button class="circle-btn active">+</button>
                </div>
            </div>

            <div class="addon-item">
                <div class="addon-info">
                    <div class="addon-name">Ăn sáng buffet</div>
                    <div class="addon-desc">Buffet sáng quốc tế (mỗi người/ngày)</div>
                    <div class="addon-price">250.000 đ</div>
                    <div class="addon-total">Tổng: 1.500.000 đ</div>
                </div>
                <div class="addon-counter">
                    <button class="circle-btn">-</button>
                    <span class="qty-val">0</span>
                    <button class="circle-btn active">+</button>
                </div>
            </div>

            <div class="addon-item">
                <div class="addon-info">
                    <div class="addon-name">Ăn sáng buffet</div>
                    <div class="addon-desc">Buffet sáng quốc tế (mỗi người/ngày)</div>
                    <div class="addon-price">250.000 đ</div>
                    <div class="addon-total">Tổng: 1.500.000 đ</div>
                </div>
                <div class="addon-counter">
                    <button class="circle-btn">-</button>
                    <span class="qty-val">0</span>
                    <button class="circle-btn active">+</button>
                </div>
            </div>
        </div>
    </div>

    <div class="booking-right">
        <div class="card-custom">
            <h3 class="card-title">Tóm tắt đặt phòng</h3>

            <div class="summary-row">
                <i class="fa-solid fa-hotel summary-icon"></i>
                <div>
                    <div class="summary-label">Hạng phòng</div>
                    <div class="summary-value-bold">Phòng Presidential Suite</div>
                    <div class="summary-label">5.000.000 đ × 0 đêm</div>
                </div>
                <div class="summary-price-tag">0 đ</div>
            </div>

            <div class="guest-info">
                Số lượng khách: <br> <strong>1 người lớn</strong>
            </div>

            <div class="payment-section">
                <p class="payment-title">Phương thức thanh toán</p>

                <label class="method-card">
                    <input type="radio" name="pay_method" checked>
                    <i class="fa-solid fa-hotel"></i>
                    <span class="summary-value-bold">Thanh toán tại khách sạn</span>
                </label>

                <label class="method-card">
                    <input type="radio" name="pay_method">
                    <i class="fa-solid fa-credit-card"></i>
                    <span class="summary-value-bold">Thẻ tín dụng</span>
                </label>

                <label class="method-card">
                    <input type="radio" name="pay_method" checked>
                    <i class="fa-solid fa-hotel"></i>
                    <span class="summary-value-bold">Quét mã qr</span>
                </label>
            </div>

            <div class="total-amount-box">
                <div>
                    <div class="total-label">Tổng thanh toán</div>
                    <div class="total-val">0 đ</div>
                </div>
                <i class="fa-solid fa-dollar-sign summary-icon"></i>
            </div>

            <button class="btn-submit">Vui lòng điền đầy đủ thông tin</button>
            <p class="footer-note">Vui lòng chọn phòng để tiếp tục</p>
        </div>
    </div>
</div>

<?php get_view('admin/footer') ?>
