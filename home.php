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
    <title>البن الأخضر - الصفحة الرئيسية</title>
</head>
<body dir="rtl">
    <?php include 'components/header.php'; ?>
    <div class="main">
        <section class="home-section">
            <div class="slider">
                <div class="slider__slider slide1">
                    <div class="overlay"></div>
                    <div class="slide-detail">
                        <h1>أجود أنواع القهوة والشاي</h1>
                        <p>اكتشف المذاق الأصيل للبن الأخضر الطبيعي والمنتجات العضوية المختارة بعناية.</p>
                        <a href="view_products.php" class="btn">تسوق الآن</a>
                    </div>
                    <div class="hero-dec-top"></div>
                    <div class="hero-dec-bottom"></div>
                </div>
                <div class="slider__slider slide2">
                    <div class="overlay"></div>
                    <div class="slide-detail">
                        <h1>مرحباً بك في متجرنا</h1>
                        <p>نقدم لك أفضل العروض الحصرية على كافة منتجات الشاي والقهوة الصحية.</p>
                        <a href="view_products.php" class="btn">تسوق الآن</a>
                    </div>
                    <div class="hero-dec-top"></div>
                    <div class="hero-dec-bottom"></div>
                </div>
                <div class="slider__slider slide3">
                    <div class="overlay"></div>
                    <div class="slide-detail">
                        <h1>نكهات طبيعية 100%</h1>
                        <p>استمتع بتجربة فريدة مع مشروباتنا التي تعزز طاقتك وصحتك اليومية.</p>
                        <a href="view_products.php" class="btn">تسوق الآن</a>
                    </div>
                    <div class="hero-dec-top"></div>
                    <div class="hero-dec-bottom"></div>
                </div>
                
                <div class="left-arrow"><i class="bx bxs-left-arrow"></i></div>
                <div class="right-arrow"><i class="bx bxs-right-arrow"></i></div>
            </div>
        </section>

         <section class="thumb">
            <div class="box-container">   
                <div class="box">
                    <img src="img/thumb2.jpg" >
                    <h3>الشاي الأخضر</h3>
                    <p>استمتع بفوائد الشاي الأخضر الطبيعي المنعش.</p>
                    <i class="bx bx-chevron-right"></i>
                </div>
            
                <div class="box">
                    <img src="img/thumb0.jpg" >
                    <h3>شاي بالليمون</h3>
                    <p>مزيج رائع من الشاي والليمون لنشاط دائم.</p>
                    <i class="bx bx-chevron-right"></i>
                </div>
                <div class="box">
                    <img src="img/thumb1.jpg" >
                    <h3>القهوة الخضراء</h3>
                    <p>الخيار الأمثل لمحبي الرشاقة والنمط الصحي.</p>
                    <i class="bx bx-chevron-right"></i>
                </div>
                <div class="box">
                    <img src="img/thumb.jpg" >
                    <h3>شاي عضوي</h3>
                    <p>أوراق شاي منتقاة بعناية من المزارع مباشرة.</p>
                    <i class="bx bx-chevron-right"></i>
                </div>
            </div>
         </section>

         <section class="container">
            <div class="box-container">
                <div class="box">
                    <img src="img/about-us.jpg" >
                </div>
                <div class="box">
                    <img src="img/download.png" >
                    <span>شاي صحي</span>
                    <h1>وفر حتى 50%</h1>
                    <p>لا تفوت فرصة الحصول على خصومات كبيرة على منتجاتنا الفاخرة لفترة محدودة.</p>
                </div>
            </div>
         </section>

         <section class="shop">
            <div class="title">
                <img src="img/download.png" >
                <h1>المنتجات الأكثر رواجاً</h1>
            </div>
            <div class="row">
                <img src="img/about.jpg" >
                <div class="row-detail">
                    <img src="img/basil.jpg" >
                    <div class="top-footer">
                        <h1>كوب من الشاي الأخضر يمنحك الصحة</h1>
                    </div>
                </div>
            </div>
            <div class="box-container">
                <div class="box">
                    <img src="img/card.jpg" >
                    <a href="view_products.php" class="btn">تسوق الجديد</a>
                </div>
                <div class="box">
                    <img src="img/card0.jpg" >
                    <a href="view_products.php" class="btn">تسوق الجديد</a>
                </div>
                <div class="box">
                    <img src="img/card1.jpg" >
                    <a href="view_products.php" class="btn">تسوق الجديد</a>
                </div>
                <div class="box">
                    <img src="img/card2.jpg" >
                    <a href="view_products.php" class="btn">تسوق الجديد</a>
                </div>
            </div>
         </section>

         <section class="shop-category">
            <div class="box-container">
                <div class="box">
                    <img src="img/6.jpg" >
                    <div class="detail">
                        <span>عروض كبرى</span>
                        <h1>خصم إضافي 15%</h1>
                        <a href="view_products.php" class="btn">تسوق الآن</a>
                    </div>
                </div>
                <div class="box">
                    <img src="img/7.jpg" >
                    <div class="detail">
                        <span>مذاق جديد</span>
                        <h1>ركن القهوة</h1>
                        <a href="view_products.php" class="btn">تسوق الآن</a>
                    </div>
                </div>
            </div>
         </section>

         <section class="servicea">
            <div class="box-container">
                <div class="box">
                    <img src="img/icon2.png" alt="">
                    <div class="detail">
                        <h3>توفير كبير</h3>
                        <p>وفر في كل طلبية تقوم بها</p>
                    </div>
                </div>
                 <div class="box">
                    <img src="img/icon1.png" >
                    <div class="detail">
                        <h3>دعم 24/7</h3>
                        <p>دعم فني مباشر على مدار الساعة</p>
                    </div>
                </div>
                 <div class="box">
                    <img src="img/icon0.png" >
                    <div class="detail">
                        <h3>قسائم هدايا</h3>
                        <p>قسائم شرائية في كل المهرجانات</p>
                    </div>
                </div>
                 <div class="box">
                    <img src="img/icon.png" >
                    <div class="detail">
                        <h3>توصيل عالمي</h3>
                        <p>نشحن لجميع أنحاء العالم</p>
                    </div>
                </div>
            </div>
         </section>

         <section class="brand">
            <div class="box-container">
                <div class="box"><img src="img/brand (1).jpg" ></div>
                <div class="box"><img src="img/brand (2).jpg" ></div>
                <div class="box"><img src="img/brand (3).jpg" ></div>
                <div class="box"><img src="img/brand (4).jpg" ></div>
                <div class="box"><img src="img/brand (5).jpg" ></div>
            </div>
         </section>
        <?php include 'components/footer.php'; ?>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="script.js"></script>
    <?php include 'components/alert.php';?>
</body>
</html>