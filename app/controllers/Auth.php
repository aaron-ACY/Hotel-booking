<?php

class Auth extends Controller
{
    use Database;

    public function index()
    {
        // Nếu đã đăng nhập thì đá về trang admin hoặc home
        if (isset($_SESSION['USER'])) {
            if ($_SESSION['USER']->role === 'admin') {
                header("Location: " . ROOT . "/admin");
            } else {
                header("Location: " . ROOT . "/home");
            }
            exit;
        }
        $this->view('auth');
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            // Tìm user trong DB
            $row = $this->query("SELECT * FROM users WHERE email = :email LIMIT 1", ['email' => $email]);

            if ($row) {
                $user = $row[0];
                // Kiểm tra mật khẩu
                if (password_verify($password, $user->password)) {
                    // 1. Lưu session
                    $_SESSION['USER'] = $user;

                    // 2. [MỚI] XỬ LÝ GHI NHỚ ĐĂNG NHẬP
                    if (!empty($_POST['remember'])) {
                        // Tạo token ngẫu nhiên
                        $token = bin2hex(random_bytes(32));

                        // Lưu token vào Cookie (Sống 30 ngày)
                        setcookie('remember_token', $token, time() + (86400 * 30), "/");

                        // Lưu token vào Database
                        $this->query("UPDATE users SET remember_token = :token WHERE id = :id", [
                            'token' => $token,
                            'id'    => $user->id
                        ]);
                    }

                    // 3. Chuyển hướng theo quyền
                    if ($user->role === 'admin') {
                        header("Location: " . ROOT . "/admin");
                    } else {
                        header("Location: " . ROOT . "/home");
                    }
                    exit;
                }
            }

            // Đăng nhập thất bại
            echo "<script>alert('Email hoặc mật khẩu không đúng!'); window.location.href='" . ROOT . "/auth';</script>";
            exit;
        }
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $username = trim($_POST['username']);
            $email    = trim($_POST['email']);
            $password = trim($_POST['password']);

            // Kiểm tra email trùng
            $check = $this->query("SELECT id FROM users WHERE email = :email LIMIT 1", ['email' => $email]);
            if ($check) {
                echo "<script>alert('Email đã tồn tại!'); window.location.href='" . ROOT . "/auth';</script>";
                exit;
            }

            // Tạo user mới
            $data = [
                'username' => $username,
                'email'    => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'role'     => 'user'
            ];

            $this->query("INSERT INTO users (username, email, password, role) VALUES (:username, :email, :password, :role)", $data);

            echo "<script>alert('Đăng ký thành công! Hãy đăng nhập.'); window.location.href='" . ROOT . "/auth';</script>";
            exit;
        }
    }

    public function logout()
    {
        if (isset($_COOKIE['remember_token'])) {
            setcookie('remember_token', '', time() - 3600, "/");
            
            if (isset($_SESSION['USER'])) {
                $this->query("UPDATE users SET remember_token = NULL WHERE id = :id", [
                    'id' => $_SESSION['USER']->id
                ]);
            }
        }

        session_destroy();
        unset($_SESSION['USER']);
        header("Location: " . ROOT . "/auth");
        exit;
    }
}
