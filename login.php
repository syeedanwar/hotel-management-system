<?php
session_start();
include 'db.php';

if(isset($_POST['login'])){
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0){
        $user = mysqli_fetch_assoc($result);
        if(password_verify($password, $user['password'])){
            $_SESSION['user'] = $user['username'];
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Incorrect password!";
        }
    } else {
        $error = "User not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login - Hotel Management</title>
<style>
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background: linear-gradient(135deg, #6B73FF, #5e66f5);
        font-family: Arial, sans-serif;
    }

    .login-container {
        background: #fff;
        padding: 40px 30px;
        border-radius: 10px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        width: 350px;
        text-align: center;
        animation: fadeIn 1s ease;
    }

    h2 { margin-bottom: 25px; color: #333; }

    input[type="text"], input[type="password"] {
        width: 90%;
        padding: 12px 15px;
        margin: 10px 0;
        border: 1px solid #ccc;
        border-radius: 5px;
        transition: 0.3s;
    }

    input:focus { border-color: #6B73FF; outline: none; }

    button {
        width: 100%;
        padding: 12px;
        background: #424bfc;
        border: none;
        color: #fff;
        font-size: 16px;
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
        margin-top: 10px;
    }

    button:hover { background: #000DFF; }

    .error { color: red; margin-bottom: 10px; }

    .show-pass { margin: 10px 0; display: flex; align-items: center; font-size: 14px; color: #555; }

    .signup-btn {
        background: #f44c4c;
        margin-top: 15px;
    }
    .signup-btn:hover { background: #FF0000; }

    @keyframes fadeIn {
        from {opacity: 0; transform: translateY(-20px);}
        to {opacity: 1; transform: translateY(0);}
    }
</style>
</head>
<body>

<div class="login-container">
    <h2>Management Login</h2>
    <?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>
    <form method="POST" id="loginForm">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" id="password" required>
        
        <div class="show-pass">
            <input type="checkbox" id="togglePass"> Show Password
        </div>

        <button type="submit" name="login">Login</button>
    </form>

    <form action="index.php" method="get">
        <button type="submit" class="home-btn">Exit</button>
    </form>
</div>

<script>
    const togglePass = document.getElementById('togglePass');
    const password = document.getElementById('password');

    togglePass.addEventListener('change', () => {
        password.type = togglePass.checked ? 'text' : 'password';
    });

    const form = document.getElementById('loginForm');
    form.addEventListener('submit', () => {
        form.querySelector('button').innerText = 'Logging in...';
    });
</script>

</body>
</html>
