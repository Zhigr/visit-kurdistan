<?php
session_start();
include 'db.php';

if (isset($_POST['login'])) {
    $user = $_POST['user'];
    $pass = $_POST['pass'];

    // لێرە پشکنین دەکەین ئایا ئەدمین هەیە؟
    // تێبینی: چونکە پاسووردەکەت هاش کراوە، دەبێت دڵنیا بیت لە شێوازی پشکنینەکە
    $query = "SELECT * FROM admins WHERE username='$user'";
    $result = mysqli_query($conn, $query);
    
    if ($row = mysqli_fetch_assoc($result)) {
        // ئەگەر پاسووردت بە ئاسایی داخڵ کردووە (وەک 123) ئەمە بەکاربێنە:
        if($pass == $row['password'] || md5($pass) == $row['password']) {
            $_SESSION['admin'] = $user;
            header("Location: admin_dashboard.php");
        } else {
            $error = "پاسوورد خەلەتە!";
        }
    } else {
        $error = "ئەو ناونیشانە بوونی نییە!";
    }
}
?>

<!DOCTYPE html>
<html lang="ku" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-dark d-flex align-items-center" style="height: 100vh;">
    <div class="card mx-auto p-4 shadow-lg" style="width: 380px;">
        <h3 class="text-center mb-4">چوونەژوور بۆ ئەدمین</h3>
        <form method="POST">
            <input type="text" name="user" class="form-control mb-3" placeholder="ناوی ئەدمین" required>
            <input type="password" name="pass" class="form-control mb-3" placeholder="پاسوورد" required>
            <button name="login" class="btn btn-primary w-100">بچۆ ژوورەوە</button>
        </form>
        <?php if(isset($error)) echo "<p class='text-danger mt-3 text-center'>$error</p>"; ?>
    </div>
</body>
</html>