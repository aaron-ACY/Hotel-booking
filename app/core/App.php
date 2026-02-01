<?php

class app
{
    private $controller = 'Home';
    private $method     = 'index';

    private function splitURL()
    {
        $URL = $_GET['url'] ?? 'home';
        $URL = explode("/", $URL);
        return $URL;
    }

    public function loadController()
    {
        $URL = $this->splitURL();

        // Xác định Controller
        $filename = "../app/controllers/" . ucfirst($URL[0]) . ".php";
        if (file_exists($filename)) {
            require $filename;
            $this->controller = ucfirst($URL[0]);
        } else {
            $filename = "../app/controllers/_404.php";
            require $filename;
            $this->controller = "_404";
        }

        $controller = new $this->controller;

        // Xác định Method (Hành động)
        if (isset($URL[1])) {
            if (method_exists($controller, $URL[1])) {
                $this->method = $URL[1];
                unset($URL[1]); // Loại bỏ method khỏi mảng URL để chuẩn bị lấy params
            }
        }

        // QUAN TRỌNG: Loại bỏ tên Controller ($URL[0]) để mảng tham số chỉ còn lại giá trị thực tế (như ID)
        unset($URL[0]);

        // Lấy các tham số còn lại (ví dụ: ID cần xóa)
        $params = $URL ? array_values($URL) : [];

        // Thực thi hàm với các tham số đã lọc
        call_user_func_array([$controller, $this->method], $params);
    }
}
