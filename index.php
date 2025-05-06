<?php

// koneksi database
$database = mysqli_connect("localhost", "root", "", "latihan01");
if (!$database) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// === Insert user hanya untuk setup awal ===
$cekUser = mysqli_query($database, "SELECT * FROM user WHERE email = 'silaban@gmail.com'");
if (mysqli_num_rows($cekUser) == 0) {
    $password = '12345'; // TANPA hash
    $insert = mysqli_query($database, "INSERT INTO user (email, password) VALUES ('silaban@gmail.com', '$password')");
    if (!$insert) {
        die("Gagal menambahkan user awal: " . mysqli_error($database));
    }
}

// === Login proses ===
if (isset($_POST["email"]) && isset($_POST["password"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Query cek email dan password langsung (tanpa hash, langsung cocokkan)
    $result = mysqli_query($database, "SELECT * FROM user WHERE email = '$email' AND password = '$password'");

    if (mysqli_num_rows($result) === 1) {
        // Login berhasil
        echo "<script>alert('Login berhasil!'); window.location.href='dashboard.php';</script>";
    } else {
        // Login gagal
        echo "<script>alert('Email atau Password salah!');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
            <section>
                <div class="login-box">
                    <form action="" method="POST">
                        <h2>Login</h2>
                        <div class="input-box">
                            <span class="icon"><ion-icon name="mail-outline"></ion-icon></span>
                            <input type="email" name="email" id="email" required>
                            <label for="email">Email</label>
                        </div>

                        <div class="input-box">
                            <span class="icon"><ion-icon name="lock-closed-outline"></ion-icon></span>
                            <input type="password" name="password" id="password" required>
                            <label for="password">Password</label>
                        </div> 
                        <div class="remember-forgot">
                            <label for=""><input type="checkbox">Remember me</label>
                            <a href="#">Forgot Password?</a>
                        </div>
                        <button type="submit">Login</button>
                        <div class="register-link">
                            <p>Belum Memiliki Account<a href="#">Register</a></p>
                        </div>
                    </form>
                </div>

                <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
                <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
            </section>
</body>
</html> 