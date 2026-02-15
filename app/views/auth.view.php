<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/auth.css">
    <title>Login/Signup | Luxe Hotel</title>
</head>

<body>
    <div class="container">
        <div class="form-box login">
            <form action="<?= ROOT ?>/auth/login" method="POST">
                <h1>Login</h1>
                <div class="input-box">
                    <input type="text" name="email" placeholder="Email" required>
                    <i class="fa-solid fa-user"></i>
                </div>

                <div class="input-box">
                    <input type="password" name="password" placeholder="Password" required>
                    <i class="fa-solid fa-lock"></i>
                </div>

                <div style="display: flex; align-items: center; margin: -15px 0 20px 0;">
                    <input type="checkbox" name="remember" id="remember" style="width: auto; margin-right: 8px; cursor: pointer;">
                    <label for="remember" style="cursor: pointer; font-size: 14px; color: #333;">Ghi nhớ đăng nhập</label>
                </div>

                <div class="forgot-link">
                    <a href="#">Forgot Password?</a>
                </div>

                <div>
                    <button type="submit" class="btn">Login</button>
                </div>
            </form>
        </div>

        <div class="form-box register">
            <form action="<?= ROOT ?>/auth/register" method="POST">
                <h1>Register</h1>
                <div class="input-box">
                    <input type="text" name="username" placeholder="Username" required>
                    <i class="fa-solid fa-user"></i>
                </div>

                <div class="input-box">
                    <input type="email" name="email" placeholder="Email" required>
                    <i class="fa-solid fa-envelope"></i>
                </div>

                <div class="input-box">
                    <input type="password" name="password" placeholder="Password" required>
                    <i class="fa-solid fa-lock"></i>
                </div>

                <div>
                    <button type="submit" class="btn">Register</button>
                </div>
            </form>
        </div>

        <div class="toggle-box">
            <div class="toggle-panel toggle-left">
                <h1>Hello, Welcome!</h1>
                <p>Don't have an account?</p>
                <button class="btn register-btn">Register</button>
            </div>

            <div class="toggle-panel toggle-right">
                <h1>Welcome Back!</h1>
                <p>Already have an account?</p>
                <button class="btn login-btn">Login</button>
            </div>
        </div>
    </div>
</body>

<script src="<?= ROOT ?>/assets/js/auth.js"></script>

</html>
