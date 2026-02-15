<?php

if ($_SERVER['SERVER_NAME'] == 'localhost') {
    // database config
    define('DBNAME', 'hotel_booking');
    define('DBHOST', 'localhost');
    define('DBUSER', 'root');
    define('DBPASS', '');
    define('DBDRIVER', '');

    define('ROOT', 'http://localhost/hotel-booking/public');
} else {
    // database config - web
    define('DBNAME', 'hotel-booking');
    define('DBHOST', 'localhost');
    define('DBUSER', 'root');
    define('DBPASS', '');
    define('DBDRIVER', '');

    define('ROOT', 'http://www.yourwebsite.com');
}

// CẤU HÌNH VNPAY (SANDBOX)
define('VNP_TMN_CODE', 'GISS1M9C'); 
define('VNP_HASH_SECRET', 'VP4587OY9RO0JQ2ZNH3C15VQJ4Q7SJM8'); 
define('VNP_URL', 'https://sandbox.vnpayment.vn/paymentv2/vpcpay.html');
define('VNP_RETURN_URL', ROOT . '/payment/callback'); 
