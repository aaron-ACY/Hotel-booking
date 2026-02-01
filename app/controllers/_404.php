<?php


class _404 extends Controller
{
    public function index()
    {
        // echo "404 Page not found controller";

        http_response_code(404);

        if (file_exists('path/to/views/404_view.php')) {
            require_once 'path/to/views/404_view.php';
        } else {
            $this->view('404');
            // echo "404 Page not found controller";
        }
    }
}
