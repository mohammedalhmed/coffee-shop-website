<?php
     include 'components/connection.php';
    session_start();

    // إذا كان المستخدم مسجلاً بالفعل، يتم توجيهه للصفحة الرئيسية
    if (isset($_SESSION['user_id'])) {
        header('location: home.php');
        exit();
    }
?>
<style type="text/css">
    <?php include 'style.css';?>
</style>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مرحباً بك في متجرنا</title>
</head>
<body>
    <div class="welcome-container">
        <div class="welcome-box">
            <h1>مرحباً بك في متجر البن الأخضر</h1>
            <p>يرجى إنشاء حساب أو تسجيل الدخول للوصول إلى منتجاتنا</p>
            <div class="welcome-buttons">
                <a href="register.php" class="btn">إنشاء حساب</a>
                <a href="login.php" class="btn" style="background-color: #9fc5a0ff;">تسجيل دخول</a>
            </div>
        </div>
    </div>
</body>
</html>
