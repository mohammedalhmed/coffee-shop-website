<?php
if(isset($warning_msg)){
   foreach($warning_msg as $warning_msg){
      echo '<script>swal("'.$warning_msg.'", "", "warning");</script>';
   }
}
if(isset($success_msg)){
   foreach($success_msg as $success_msg){
      echo '<script>swal("'.$success_msg.'", "", "success");</script>';
   }
}
if(isset($info_msg)){
   foreach($info_msg as $info_msg){
      echo '<script>swal("'.$info_msg.'", "", "info");</script>';
   }
}
if(isset($error_msg)){
   foreach($error_msg as $error_msg){
      echo '<script>swal("'.$error_msg.'", "", "error");</script>';
   }
}
?>

<header class="header">
   <div class="flex">
      <a href="dashboard.php" class="logo"><img src="img/logo.jpg" ></a>
      <nav class="navbar">
         <a href="dashboard.php">الرئيسية</a>
         <a href="add_products.php">إضافة منتجات</a>
         <a href="admin_view_products.php">الغاءالمنتجات</a>
         <a href="user_accounts.php">المستخدمين</a>
         <a href="admin_orders.php">الطلبات</a>
         
      </nav>
      <div class="icons">
         <div id="menu-btn" class="bx bx-list-plus"></div>
         <div id="user-btn" class="bx bxs-user"></div>
      </div>
      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM users WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
               $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p><?= $fetch_profile['name']; ?></p>
         <a href="update_profile.php" class="btn">تحديث الملف الشخصي</a>
         <a href="../components/admin_logout.php" onclick="return confirm('هل تريد تسجيل الخروج؟');" class="delete-btn">تسجيل الخروج</a>
         <?php
            }else{
         ?>
         <p>يرجى تسجيل الدخول أولاً</p>
         <a href="admin_login.php" class="btn">تسجيل الدخول</a>
         <?php
            }
         ?>
      </div>
   </div>
</header>
