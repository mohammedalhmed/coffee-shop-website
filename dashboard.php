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

<!DOCTYPE html>
<html lang="ar">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>لوحة التحكم</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="admin_style.css">
   <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
   <style>
      
   </style>
</head>
<body>

   <?php include 'admin_header.php'; ?>
   <div class="main">
      <section class="dashboard">
         <h1 class="heading">لوحة التحكم</h1>
         <div class="box-container">
            <div class="box">
               <?php
                  $select_products = $conn->prepare("SELECT * FROM `products` ");
                  $select_products->execute();
                  $number_of_products = $select_products->rowCount();
               ?>
               <h3><?= $number_of_products; ?></h3>
               <p>المنتجات المضافة</p>
               <a href="view_products.php" class="btn">عرض المنتجات</a>
            </div>
         
            <div class="box">
               <?php
                  $select_users = $conn->prepare("SELECT * FROM `users` ");
                  $select_users->execute();
                  $number_of_users = $select_users->rowCount();
               ?>
               <h3><?= $number_of_users; ?></h3>
               <p>حسابات المستخدمين</p>
               <a href="user_accounts.php" class="btn">عرض المستخدمين</a>
            </div>
         
            <div class="box">
               <?php
                  $select_orders = $conn->prepare("SELECT * FROM `orders` ");
                  $select_orders->execute();
                  $number_of_orders = $select_orders->rowCount();
               ?>
               <h3><?= $number_of_orders; ?></h3>
               <p>إجمالي الطلبات</p>
               <a href="admin_orders.php" class="btn">عرض الطلبات</a>
            </div>
         </div>
      </section>
   </div>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
   
</body>
</html>
