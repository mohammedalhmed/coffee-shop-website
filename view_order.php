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
    if (isset($_GET['get_id'])) {
        $get_id = $_GET['get_id'];
    }else{
        $get_id = '';
        header("location: order.php");
    } 
    if (isset($_POST['cancle'])){
        $update_order = $conn->prepare("UPDATE  orders SET status = ? WHERE id = ? ");
        $update_order ->execute(['canceled' ,$get_id]); 
        header("location: order.php");
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
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>البن الأخضر - تفاصيل الطلب</title>
</head>
<body dir="rtl">
    <?php include 'components/header.php'; ?>
    <div class="main">
        <div class="banner">
            <h1>تفاصيل الطلب</h1>
        </div>
        <div class="title2">
            <a href="home.php">الرئيسية</a><span> / تفاصيل الطلب</span>
        </div>
        <section class="order-detail">
            <div class="title">
                <img src="img/download.png" class="logo">
                <h1>بيانات طلبك</h1>
                <p>راجع تفاصيل المنتجات، عنوان الشحن، وحالة الطلب الحالية.</p>
            </div>
            <div class="box-container">
                <?php 
                    $grand_total = 0;
                    $select_orders = $conn->prepare("SELECT * FROM orders WHERE id = ? LIMIT 1");
                    $select_orders->execute([$get_id]);
                    if ($select_orders->rowCount() > 0){
                        while ($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
                            $select_products = $conn->prepare("SELECT * FROM products WHERE id = ? LIMIT 1");
                            $select_products->execute([$fetch_orders['product_id']]);
                            if ($select_products->rowCount() > 0){
                                while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
                                    $sub_total = ($fetch_orders['price'] * $fetch_orders['qty']);
                                    $grand_total += $sub_total;
               ?>
                <div class="box">
                    <div class="col">
                        <p class="title"><i class="bx bx-calendar"></i><span><?= $fetch_orders['date']; ?></span></p>
                        <img src="image/<?= $fetch_products['image']; ?>" class="image">
                        <p class="price"><?= $fetch_products['price']; ?> ريال × <?= $fetch_orders['qty']; ?></p>
                        <h3 class="name"><?= $fetch_products['name']; ?></h3>
                        <p class="grand-total">إجمالي المبلغ المستحق : <span><?= $grand_total; ?> ريال</span></p>
                    </div>
                    <div class="col">
                        <p class="title">عنوان الفاتورة</p>
                        <p class="user"><i class="bx bxs-user"></i><?= $fetch_orders['name']; ?></p>
                        <p class="user"><i class="bx bxs-phone"></i><?= $fetch_orders['number']; ?></p>
                        <p class="user"><i class="bx bxs-envelope"></i><?= $fetch_orders['email']; ?></p>
                        <p class="user"><i class="bx bxs-map"></i><?= $fetch_orders['address']; ?></p>
                        <p class="title">حالة الطلب</p>
                        <p class="status" style="color:<?php if($fetch_orders['status']=='delivered'){ echo 'green'; }elseif ($fetch_orders['status']=='canceled'){echo 'red';}else{ echo 'orange'; } ?>">
                            <?php 
                                if($fetch_orders['status']=='delivered'){
                                    echo 'تم التوصيل';
                                } elseif($fetch_orders['status']=='canceled'){
                                    echo 'تم الإلغاء';
                                } else {
                                    echo 'قيد المعالجة';
                                }
                            ?>
                        </p>
                        <?php if ($fetch_orders['status']=='canceled' ) { ?>
                            <a href="checkout.php?get_id=<?= $fetch_products['id']; ?>" class="btn">طلب مرة أخرى</a>
                        <?php } else { ?>
                            <form method="post">
                                <button type="submit" name="cancle" class="btn" onclick="return confirm('هل تريد حقاً إلغاء هذا الطلب؟')">إلغاء الطلب</button>
                            </form>
                        <?php } ?>    
                    </div>
                </div>
                <?php 
                                }
                            } else {
                                echo '<p class="empty">المنتج غير موجود</p>';
                            }
                        }
                    } else {
                        echo '<p class="empty">لا يوجد طلب بهذا الرقم</p>';
                    }
               ?>
            </div>
        </section>
        <?php include 'components/footer.php'; ?>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="script.js"></script>
    <?php include 'components/alert.php';?>
</body>
</html>