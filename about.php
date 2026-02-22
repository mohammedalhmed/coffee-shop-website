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
    <title>البن الأخضر - من نحن</title>
</head>
<body dir="rtl">
    <?php include 'components/header.php'; ?>
    <div class="main">
        <div class="banner">
            <h1>من نحن</h1>
        </div>
        <div class="title2">
            <a href="home.php">الرئيسية</a><span> / من نحن</span>
        </div>
        <div class="about-category">
            <div class="box">
                <img src="img/3.webp" >
                <div class="detail">
                    <span>قهوة</span>
                    <h1>أخضر بالليمون</h1>
                    <a href="view_products.php" class="btn">تسوق جديدنا</a>
                </div>
            </div>
            <div class="box">
                <img src="img/2.webp" >
                <div class="detail">
                    <span>قهوة</span>
                    <h1>شاي بالليمون</h1>
                    <a href="view_products.php" class="btn">تسوق جديدنا</a>
                </div>
            </div>
            <div class="box">
                <img src="img/about.png" >
                <div class="detail">
                    <span>قهوة</span>
                    <h1>مزيج الليمون</h1>
                    <a href="view_products.php" class="btn">تسوق جديدنا</a>
                </div>
            </div>
            <div class="box">
                <img src="img/1.webp" >
                <div class="detail">
                    <span>قهوة</span>
                    <h1>الأخضر المنعش</h1>
                    <a href="view_products.php" class="btn">تسوق جديدنا</a>
                </div>
            </div>
        </div>

        <section class="servicea">
            <div class="title">
                <img src="img/download.png" class="logo">
                <h1>لماذا تختارنا؟</h1>
                <p>نحن نضمن لك جودة المكونات الطبيعية والخدمة الممتازة التي تستحقها في كل كوب.</p>
            </div>
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

         <div class="about">
            <div class="row">
                <div class="img-box">
                    <img src="img/3.png" >
                </div>
                <div class="detail">
                    <h1>تفضل بزيارة معرضنا الرائع!</h1>
                    <p>معرضنا هو تجسيد لما نحب القيام به؛ الإبداع في تقديم أجود أنواع البن والشاي وتنسيقات النباتات الطبيعية. 
                       سواء كنت تبحث عن الرقي لمناسبة خاصة، أو ترغب فقط في إضفاء الحيوية على غرفتك بلمسة ديكور فريدة، 
                       فإن فريقنا هنا لمساعدتك بكل حب.
                    </p>
                    <a href="view_products.php" class="btn">تسوق الآن</a>
                </div>
            </div>
        </div>

        <div class="testimonial-container">
            <div class="title">
                <img src="img/download.png" class="logo">
                <h1>ماذا يقول الناس عنا</h1>
                <p>آراء عملائنا هي مصدر فخرنا والدافع الدائم لنا لتقديم الأفضل.</p>
            </div>    
                <div class="container">
                    <div class="testimonial-item active">
                        <img src="img/01.jpg" >
                        <h1>سارة سميث</h1>
                        <p>تجربة رائعة! جودة القهوة الخضراء مذهلة وقد ساعدتني كثيراً في تحسين نمط حياتي الصحي. خدمة العملاء سريعة وودودة جداً.</p>
                    </div>
                    <div class="testimonial-item ">
                        <img src="img/02.jpg" >
                        <h1>جون سميث</h1>
                        <p>أفضل متجر لبيع الشاي العضوي. التوصيل كان سريعاً جداً والتغليف حافظ على نكهة المنتج وكأنه طازج من المزرعة.</p>
                    </div>
                    <div class="testimonial-item ">
                        <img src="img/03.jpg" >
                        <h1>سيلينا أنصاري</h1>
                        <p>أعشق تنوع النكهات لديهم، خاصة مزيج الليمون مع القهوة الخضراء. إنه مشروبي المفضل كل صباح. أنصح الجميع بتجربته!</p>
                    </div>
                    <div class="left-arrow" onclick="prevSlide()"><i class="bx bx-left-arrow-alt"></i></div>
                    <div class="right-arrow" onclick="nextSlide()"><i class="bx bx-right-arrow-alt"></i></div>
                </div>
        </div>
        <?php include 'components/footer.php'; ?>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="script.js"></script>
    <?php include 'components/alert.php';?>
</body>
</html>