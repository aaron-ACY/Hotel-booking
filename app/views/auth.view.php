<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/auth.css">
    <title>Login/Signup Form</title>
</head>

<body>
    <div class="container">
        <!-- Login Form -->
        <div class="form-box login">
            <form action="#">
                <h1>Login</h1>
                <div class="input-box">
                    <input type="text" placeholder="Username" required>
                    <i class="fa-solid fa-user"></i>
                </div>

                <div class="input-box">
                    <input type="password" placeholder="Password" required>
                    <i class="fa-solid fa-lock"></i>
                </div>

                <div class="forgot-link">
                    <a href="#">Forgot Password?</a>
                </div>

                <div>
                    <button type="submit" class="btn">Login</button>
                    <p>or login with Social platform</p>
                    <div class="social-icons">
                        <a href="#"><i class="fa-brands fa-google"></i></a>
                        <a href="#"><i class="fa-brands fa-facebook"></i></a>
                    </div>
                </div>
            </form>
        </div>

        <!-- Register Form -->
        <div class="form-box register">
            <form action="#">
                <h1>Register</h1>
                <div class="input-box">
                    <input type="text" placeholder="Username" required>
                    <i class="fa-solid fa-user"></i>
                </div>

                <div class="input-box">
                    <input type="email" placeholder="Email" required>
                    <i class="fa-solid fa-envelope"></i>
                </div>

                <div class="input-box">
                    <input type="password" placeholder="Password" required>
                    <i class="fa-solid fa-lock"></i>
                </div>

                <div class="forgot-link">
                    <a href="#">Forgot Password?</a>
                </div>

                <div>
                    <button type="submit" class="btn">Register</button>
                    <p>or register with Social platform</p>
                    <div class="social-icons">
                        <a href="#"><i class="fa-brands fa-google"></i></a>
                        <a href="#"><i class="fa-brands fa-facebook"></i></a>
                    </div>
                </div>
            </form>
        </div>

    <!-- Toggle Box -->
    <div class="toggle-box">
        <!-- Toggle Box Left -->
        <div class="toggle-panel toggle-left">
            <h1>Hello, Welcome!</h1>
            <p>Don't have an account?</p>
            <button class="btn register-btn">Register</button>
        </div>

        <!-- Toggle Box Right -->
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

