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
    
    if (isset($_POST['place_order'])){
        $name = $_POST['name'];
        $name = filter_var($name, FILTER_SANITIZE_STRING);
        $number = $_POST['number'];
        $number = filter_var($number, FILTER_SANITIZE_STRING);
        $email = $_POST['email'];
        $email = filter_var($email, FILTER_SANITIZE_STRING);
        $address = $_POST['flat'].','.$_POST['street'].','.$_POST['city'].','.$_POST['country'].','.$_POST['pincode'];
        $address = filter_var($address, FILTER_SANITIZE_STRING);
        $address_type = $_POST['address_type'];
        $address_type = filter_var($address_type, FILTER_SANITIZE_STRING);
        $method = $_POST['method'];
        $method = filter_var($method, FILTER_SANITIZE_STRING);

        $varify_cart = $conn->prepare("SELECT * FROM cart WHERE user_id = ?");
        $varify_cart->execute([$user_id]);
        
        if (isset($_GET['get_id'])) {
            $get_products = $conn->prepare("SELECT * FROM products WHERE id = ? LIMIT 1");
            $get_products->execute([$_GET['get_id']]);
            if ($get_products->rowCount() > 0){
                while ($fetch_P = $get_products->fetch(PDO::FETCH_ASSOC)){
                    // تمت إضافة حقل status هنا
                    $insert_order = $conn->prepare("INSERT INTO orders (id, user_id, name, number, email, address, address_type, method, product_id, price, qty, status) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                    $insert_order->execute([unique_id(), $user_id, $name, $number, $email, $address, $address_type, $method, $fetch_P['id'], $fetch_P['price'], 1, 'قيد المعالجة']);
                    header("location: order.php");
                } 
            }else{
                $warning_msg[] = 'حدث خطأ ما!';
            }
        }elseif ($varify_cart->rowCount() > 0) {
            while ($f_cart = $varify_cart->fetch(PDO::FETCH_ASSOC)){
                 // تمت إضافة حقل status هنا أيضاً
                $insert_order = $conn->prepare("INSERT INTO orders (id, user_id, name, number, email, address, address_type, method, product_id, price, qty, status) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $insert_order->execute([unique_id(), $user_id, $name, $number, $email, $address, $address_type, $method, $f_cart['product_id'], $f_cart['price'], $f_cart['qty'], 'قيد المعالجة']);
            }
            if ($insert_order) {
                $delete_cart = $conn->prepare("DELETE FROM cart WHERE user_id = ?");
                $delete_cart->execute([$user_id]);
                header("location: order.php");
            }
        }else{
                $warning_msg[] = 'حدث خطأ ما!';
        }   
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
    <title>البن الأخضر - صفحة إتمام الشراء</title>
</head>
<body dir="rtl">
    <?php include 'components/header.php'; ?>
    <div class="main">
        <div class="banner">
            <h1>ملخص إتمام الشراء</h1>
        </div>
        <div class="title2">
            <a href="home.php">الرئيسية</a><span> / ملخص الشراء</span>
        </div>
        <section class="checkout">
            <div class="title">
                <img src="img/download.png" class="logo">
                <h1>ملخص طلبك</h1>
                <p>يرجى التأكد من بيانات الشحن واختيار طريقة الدفع المناسبة لإتمام الطلب.</p>
            </div>
                <div class="row">
                    <form method="post">
                        <h3>تفاصيل الفاتورة</h3>
                        <div class="flex">
                            <div class="box">
                                <div class="input-field">
                                    <p>الاسم الكامل <span>*</span></p>
                                    <input type="text" name="name" required maxlength="50" placeholder="أدخل اسمك بالكامل" class="input">
                                </div>
                                <div class="input-field">
                                    <p>رقم الجوال <span>*</span></p>
                                    <input type="number" name="number" required maxlength="10" placeholder="أدخل رقم جوالك" class="input">
                                </div>
                                <div class="input-field">
                                    <p>البريد الإلكتروني <span>*</span></p>
                                    <input type="email" name="email" required maxlength="50" placeholder="أدخل بريدك الإلكتروني" class="input">
                                </div>
                                <div class="input-field">
                                    <p>طريقة الدفع <span>*</span></p>
                                    <select name="method" class="input">
                                        <option value="الدفع عند الاستلام">الدفع عند الاستلام</option>
                                        <option value="بطاقة ائتمان">بطاقة ائتمان / مدى</option>
                                        <option value="تحويل بنكي">تحويل بنكي مباشر</option>
                                        <option value="أبل باي">Apple Pay</option>
                                        <option value="بايبال">PayPal</option>
                                    </select>
                                </div>
                                <div class="input-field">
                                    <p>نوع العنوان <span>*</span></p>
                                    <select name="address_type" class="input">
                                        <option value="المنزل">المنزل</option>
                                        <option value="المكتب">المكتب / العمل</option>
                                    </select>
                                </div>
                            </div>
                            <div class="box">
                                <div class="input-field">
                                    <p>العنوان (رقم الشقة أو المبنى) <span>*</span></p>
                                    <input type="text" name="flat" required maxlength="50" placeholder="مثال: شقة رقم 10، مبنى 5" class="input">
                                </div>
                                <div class="input-field">
                                    <p>اسم الشارع <span>*</span></p>
                                    <input type="text" name="street" required maxlength="50" placeholder="مثال: شارع الد" class="input">
                                </div>
                                <div class="input-field">
                                    <p>المدينة <span>*</span></p>
                                    <input type="text" name="city" required maxlength="50" placeholder="أدخل اسم المدينة" class="input">
                                </div>
                                <div class="input-field">
                                    <p>الدولة <span>*</span></p>
                                    <input type="text" name="country" required maxlength="50" placeholder="أدخل اسم الدولة" class="input">
                                </div>
                                <div class="input-field">
                                    <p>الرمز البريدي <span>*</span></p>
                                    <input type="text" name="pincode" required maxlength="6" placeholder="مثال: 12345" class="input">
                                </div>
                            </div>
                        </div>
                        <button type="submit" name="place_order" class="btn">إتمام الطلب الآن</button>
                    </form>
                    <div class="summary">
                        <h3>حقيبة التسوق</h3>
                        <div class="box_container">
                            <?php 
                                $grand_total = 0;
                                if (isset($_GET['get_id'])) {
                                    $select_get = $conn->prepare("SELECT * FROM products WHERE id = ?");
                                    $select_get->execute([$_GET['get_id']]);
                                    while($fetch_get = $select_get->fetch(PDO::FETCH_ASSOC)){
                                        $sub_total = $fetch_get['price'];
                                        $grand_total = $sub_total;
                            ?>
                            <div class="flex">
                                <img src="image/<?= $fetch_get['image'];?>" class="image">
                                <div>
                                    <h3 class="name"><?= $fetch_get['name'];?></h3>
                                    <p class="price"><?= $fetch_get['price'];?>/- لكل قطعة</p>
                                </div>
                            </div>
                            <?php
                                    }
                                }else{
                                    $select_cart = $conn->prepare("SELECT * FROM cart WHERE user_id = ?");
                                    $select_cart->execute([$user_id]);
                                    if ($select_cart->rowCount() > 0){
                                        while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
                                            $select_products = $conn->prepare("SELECT * FROM products WHERE id = ?");
                                            $select_products->execute([$fetch_cart['product_id']]);
                                            $fetch_products = $select_products->fetch(PDO::FETCH_ASSOC);
                                            $sub_total = ($fetch_cart['qty'] * $fetch_products['price']);
                                            $grand_total += $sub_total;      
                            ?>
                            <div class="flex">
                                <img src="image/<?= $fetch_products['image']; ?>" >
                                <div>
                                    <h3 class="name"><?= $fetch_products['name'];?></h3>
                                    <p class="price"><?= $fetch_products['price'];?> ريال × <?= $fetch_cart['qty'];?></p>
                                </div>
                            </div>
                            <?php 
                                        }
                                    }else{
                                        echo '<p class="empty">حقيبة التسوق فارغة</p>';
                                    }   
                                }
                            ?>
                        </div>
                        <div class="grand-total"><span>إجمالي المبلغ المستحق: </span><?= $grand_total ?> ريال</div>
                    </div>
                </div>    
        </section>
        <?php include 'components/footer.php'; ?>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="script.js"></script>
    <?php include 'components/alert.php';?>
</body>
</html>