<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Trang không tìm thấy - 404</title>
    <style>
        body {
            margin: 0; padding: 0; font-family: sans-serif;
            display: flex; justify-content: center; align-items: center;
            height: 100vh; background: #f9f9f9; text-align: center;
        }
        .circle {
            width: 250px; height: 250px; background: #1a2a44;
            border-radius: 50%; margin: 20px auto;
            display: flex; align-items: center; justify-content: center;
        }
        .circle img { width: 70%; }
        h2 { color: #333; margin: 10px 0; }
        a { color: #3498db; text-decoration: none; }
    </style>
</head>
<body>
    <div>
        <h2>Aww.. don't be sad</h2>
        <div class="circle">
            <img src="https://cdn-icons-png.flaticon.com/512/2585/2585141.png" alt="404 Bear">
        </div>
        <h2>404 page not found</h2>
        <p><a href="<?=ROOT?>">back to <u>home</u></a></p>
    </div>
</body>
</html>
