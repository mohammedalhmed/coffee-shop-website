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

    // إضافة المنتجات إلى قائمة الأمنيات
    if (isset($_POST['add_to_wishlist'])){
        $id = unique_id();
        $product_id = $_POST['product_id'];

        $varify_wishist = $conn->prepare("SELECT * FROM wishlist WHERE user_id = ? AND product_id = ?");
        $varify_wishist->execute([$user_id, $product_id]);

        $cart_num = $conn->prepare("SELECT * FROM cart WHERE user_id = ? AND product_id = ?");
        $cart_num->execute([$user_id, $product_id]);

        if ($varify_wishist->rowCount() > 0){
            $warning_msg[] = 'المنتج موجود بالفعل في قائمة الأمنيات';
        }else if ($cart_num->rowCount() > 0){
            $warning_msg[] = 'المنتج موجود بالفعل في سلة التسوق';
        }else{
            $select_price = $conn->prepare("SELECT * FROM products WHERE id = ? LIMIT 1");
            $select_price->execute([$product_id]);
            $fetch_price = $select_price->fetch(PDO::FETCH_ASSOC);

            $insert_wishlist = $conn->prepare("INSERT INTO wishlist (id, user_id, product_id, price) VALUES(?, ?, ?, ?)");
            $insert_wishlist->execute([$id, $user_id, $product_id, $fetch_price['price']]);
            $success_msg[] = 'تم إضافة المنتج إلى قائمة الأمنيات بنجاح';
        }
    }

    // إضافة المنتجات إلى سلة التسوق
    if (isset($_POST['add_to_cart'])){
        $id = unique_id();
        $product_id = $_POST['product_id'];

        $qty = $_POST['qty'];
        $qty = filter_var($qty, FILTER_SANITIZE_STRING);

        $varify_cart = $conn->prepare("SELECT * FROM cart WHERE user_id = ? AND product_id = ?");
        $varify_cart->execute([$user_id, $product_id]);

        $max_cart_items = $conn->prepare("SELECT * FROM cart WHERE user_id = ? ");
        $max_cart_items->execute([$user_id]);

        if ($varify_cart->rowCount() > 0){
            $warning_msg[] = 'المنتج موجود بالفعل في سلة التسوق';
        }else if ($max_cart_items->rowCount() > 20){
            $warning_msg[] = 'سلة التسوق ممتلئة';
        }else{
            $select_price = $conn->prepare("SELECT * FROM products WHERE id = ? LIMIT 1");
            $select_price->execute([$product_id]);
            $fetch_price = $select_price->fetch(PDO::FETCH_ASSOC);

            $insert_cart = $conn->prepare("INSERT INTO cart (id, user_id, product_id, price ,qty) VALUES(?, ?, ?, ?, ?)");
            $insert_cart->execute([$id, $user_id, $product_id, $fetch_price['price'], $qty]);
            $success_msg[] = 'تم إضافة المنتج إلى السلة بنجاح';
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
    <title>البن الأخضر - تفاصيل المنتج</title>
</head>
<body dir="rtl">
    <?php include 'components/header.php'; ?>
    <div class="main">
        <div class="banner">
            <h1>تفاصيل المنتج</h1>
        </div>
        <div class="title2">
            <a href="home.php">الرئيسية</a><span> / تفاصيل المنتج</span>
        </div>
        <section class="view_page">
           <?php
                if (isset($_GET['pid'])){
                    $pid = $_GET['pid'];
                    $select_products = $conn->prepare("SELECT * FROM products WHERE id = ?");
                    $select_products->execute([$pid]);
                    if ($select_products->rowCount() > 0){
                        while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
            ?>
            <form method="post">
                <img src="image/<?php echo $fetch_products['image']; ?>" class="img">
                <div class="detail">
                    <div class="price"><?php echo $fetch_products['price']; ?> ريال</div>
                    <div class="name"><?php echo $fetch_products['name']; ?></div>
                    <div class="detail-text">
                        <p>هذا المنتج من أجود أنواع البن الأخضر الطبيعي، تم اختياره بعناية لضمان أعلى مستويات الجودة والمذاق الرائع. يتميز بفوائد صحية عديدة ويعد خياراً مثالياً لمحبي المشروبات العضوية والطبيعية.</p>
                    </div>
                    <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?>">
                    <div class="button">
                        <button type="submit" name="add_to_wishlist" class="btn">إضافة للأمنيات <i class="bx bx-heart"></i></button>
                        <input type="hidden" name="qty" value="1" min="0" class="quantity">
                        <button type="submit" name="add_to_cart" class="btn">إضافة إلى السلة <i class="bx bx-cart"></i></button>
                    </div>
                </div>
            </form> 
            <?php
                        }
                    }  
                }
            ?>
        </section>
        <?php include 'components/footer.php'; ?>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="script.js"></script>
    <?php include 'components/alert.php';?>
</body>
</html>