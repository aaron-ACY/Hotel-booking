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
    // database config
    define('DBNAME', 'hotel-booking');
    define('DBHOST', 'localhost');
    define('DBUSER', 'root');
    define('DBPASS', '');
    define('DBDRIVER', '');

    define('ROOT', 'http://www.yourwebsite.com');
}
