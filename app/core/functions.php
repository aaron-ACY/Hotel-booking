<?php
function show($stuff)
{
    echo "<pre>";
    print_r($stuff);
    echo "</pre>";
}

function get_view($name, $data = [])
{
    if (!empty($data)) {
        extract($data);
    }

    $filename = "../app/views/" . $name . ".view.php";
    if (file_exists($filename)) {
        require $filename;
    }
}
