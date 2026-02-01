<?php

class Controller
{
    public function view($name, $data = [])
    {
        if (!empty($data)) {
            extract($data);
        }

        $filename = "../app/views/" . $name . ".view.php";
        if (file_exists($filename)) {
            require $filename;
        } else {
            $filename = "../app/views/_404.php";
            require $filename;
        }
    }
}
