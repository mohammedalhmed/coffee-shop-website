<header class="header">
    <div class="flex">
        <a href="home.php" class="logo"><img src="img/logo.jpg" alt="Logo"></a>

        <nav class="navber">
            <a href="home.php">الرئيسية</a>
            <a href="view_products.php">المنتجات</a>
            <a href="order.php">الطلبات</a>
            <a href="about.php">عنا</a>
            <a href="contact.php">اتصل بنا</a>
        </nav>

        <div class="icons">
            <i class="bx bxs-user" id="user-btn"></i>

            <?php 
                // حساب عدد المنتجات في قائمة الأمنيات (المفضلة)
                $conut_wishist_items = $conn->prepare("SELECT * FROM wishlist WHERE user_id = ? ");
                $conut_wishist_items->execute([$user_id]);
                $total_wishist_items = $conut_wishist_items->rowCount();
            ?>
            <a href="wishlist.php" class="cart-btn">
                <i class="bx bx-heart"></i>
                <sup><?php echo $total_wishist_items; ?></sup>
            </a>

            <?php 
                // حساب عدد المنتجات المضافة في السلة
                $conut_cart_items = $conn->prepare("SELECT * FROM cart WHERE user_id = ? ");
                $conut_cart_items->execute([$user_id]);
                $total_cart_items = $conut_cart_items->rowCount();
            ?>
            <a href="cart.php" class="cart-btn">
                <i class="bx bx-cart-download"></i>
                <sup><?php echo $total_cart_items; ?></sup>
            </a>

            <i class="bx bx-list-plus" id="menu-btn" style="font-size: 2rem;"></i>
        </div>

        <div class="user-box">
            <p>اسم المستخدم : <span><?php echo $_SESSION['user_name'] ?? 'ضيف'; ?></span></p>
            <p>البريد الإلكتروني : <span><?php echo $_SESSION['user_email'] ?? 'غير مسجل'; ?></span></p>
            <a href="login.php" class="btn">تسجيل الدخول</a>
            <a href="register.php" class="btn">إنشاء حساب</a>
            <form method="post">
                <button type="submit" name="logout" class="logout-btn">تسجيل الخروج</button>
            </form>
        </div>
    </div>
</header>