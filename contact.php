<?php
    include 'components/connection.php';
    session_start();
    if (isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
    }else{
        $user_id = '';
    }

    if (isset($_POST['logout'])) {
        session_destroy();
        header("location: login.php");
    }
?>
<style type="text/css">
    <?php include 'style.css';?>
</style>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="styesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>البن الأخضر - اتصل بنا</title>
</head>
<body dir="rtl">
    <?php include 'components/header.php'; ?>
    <div class="main">
        <div class="banner">
            <h1>اتصل بنا</h1>
        </div>
        <div class="title2">
            <a href="home.php">الرئيسية</a><span> / تواصل معنا</span>
        </div>
         <section class="servicea">
            <div class="box-container">
                <div class="box">
                    <img src="img/icon2.png" alt="">
                    <div class="detail">
                        <h3>توفير كبير</h3>
                        <p>وفر الكثير مع كل طلبية</p>
                    </div>
                </div>
                 <div class="box">
                    <img src="img/icon1.png" >
                    <div class="detail">
                        <h3>دعم 24/7</h3>
                        <p>دعم مباشر طوال اليوم</p>
                    </div>
                </div>
                 <div class="box">
                    <img src="img/icon0.png" >
                    <div class="detail">
                        <h3>قسائم هدايا</h3>
                        <p>هدايا وقسائم في كل المناسبات</p>
                    </div>
                </div>
                 <div class="box">
                    <img src="img/icon.png" >
                    <div class="detail">
                        <h3>توصيل عالمي</h3>
                        <p>شحن لجميع أنحاء العالم</p>
                    </div>
                </div>
            </div>
        </section>
        <div class="form-container">
            <form method="post">
                <div class="title">
                    <img src="img/download.png" class="logo">
                    <h1>اترك رسالة</h1>
                </div>
                <div class="input-field">
                    <p>الاسم الكامل </p>
                    <input type="text" name="name" placeholder="أدخل اسمك">
                </div>
                <div class="input-field">
                    <p>البريد الإلكتروني </p>
                    <input type="email" name="email" placeholder="أدخل بريدك الإلكتروني">
                </div>
                <div class="input-field">
                    <p>رقم الهاتف </p>
                    <input type="number" name="number" placeholder="أدخل رقم هاتفك">
                </div>
                <div class="input-field">
                    <p>رسالتك </p>
                    <textarea name="message" placeholder="كيف يمكننا مساعدتك؟"></textarea>
                </div>
                <button type="submit" name="submit-btn" class="btn">إرسال الرسالة</button>
            </form>
        </div>
        <div class="address">
                <div class="title">
                    <img src="img/download.png" class="logo">
                    <h1>تفاصيل الاتصال</h1>
                    <p>نحن هنا للرد على استفساراتكم ومساعدتكم في أي وقت.</p>
                </div>
                <div class="box-container">
                    <div class="box">
                        <i class="bx bxs-map-pin"></i>
                        <div>
                            <h4>العنوان</h4>
                            <p>شارع الصافية 12، جوار جامع الصالح </p>
                        </div>
                    </div>
                    <div class="box">
                        <i class="bx bxs-phone-call"></i>
                        <div>
                            <h4>رقم الهاتف</h4>
                            <p>779630129</p>
                        </div>
                    </div>
                    <div class="box">
                        <i class="bx bxs-envelope"></i>
                        <div>
                            <h4>البريد الإلكتروني</h4>
                            <p>emadalhamed453@gmail.com</p>
                        </div>
                    </div>
                </div>
            </div>
        <?php include 'components/footer.php'; ?>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="script.js"></script>
    <?php include 'components/alert.php';?>
</body>
</html>