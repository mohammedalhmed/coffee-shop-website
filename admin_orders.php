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

if(isset($_POST['update_order'])){
   $order_id = $_POST['order_id'];
   $update_status = $_POST['update_status'];
   $update_status = filter_var($update_status, FILTER_SANITIZE_STRING);
   $update_orders = $conn->prepare("UPDATE orders SET status = ? WHERE id = ?");
   $update_orders->execute([$update_status, $order_id]);
   $success_msg[] = 'تم تحديث حالة الطلب!';
}

if(isset($_POST['delete_order'])){
   $delete_id = $_POST['order_id'];
   $delete_order = $conn->prepare("DELETE FROM orders WHERE id = ?");
   $delete_order->execute([$delete_id]);
   $success_msg[] = 'تم حذف الطلب بنجاح!';
}

?>

<!DOCTYPE html>
<html lang="ar">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>إدارة الطلبات</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="admin_style.css">
   <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

<?php include 'admin_header.php'; ?>

<section class="orders">
   <h1 class="heading">الطلبات المستلمة</h1>
   <div class="box-container">
   <?php
      $select_orders = $conn->prepare("SELECT * FROM `orders` ");
      $select_orders->execute();
      if($select_orders->rowCount() > 0){
         while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class="box" style="background-color: var(--white); box-shadow: var(--box-shadow); border: var(--border); border-radius: .5rem; padding: 2rem; margin-bottom: 2rem;">
      <p> تاريخ الطلب : <span><?= $fetch_orders['date']; ?></span> </p>
      <p> الاسم : <span><?= $fetch_orders['name']; ?></span> </p>
      <p> الرقم : <span><?= $fetch_orders['number']; ?></span> </p>
      <p> البريد : <span><?= $fetch_orders['email']; ?></span> </p>
      <p> العنوان : <span><?= $fetch_orders['address']; ?></span> </p>
      <p> إجمالي المنتجات : <span><?= $fetch_orders['total_products']; ?></span> </p>
      <p> السعر الإجمالي : <span>$<?= $fetch_orders['total_price']; ?>/-</span> </p>
      <p> طريقة الدفع : <span><?= $fetch_orders['method']; ?></span> </p>
      <form action="" method="post">
         <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">
         <select name="update_status" class="box" style="width: 100%; background-color: var(--light-bg); border-radius: .5rem; padding: 1.2rem 1.4rem; font-size: 1.8rem; color: var(--black); margin: 1rem 0;">
            <option value="" selected disabled><?= $fetch_orders['status']; ?></option>
            <option value="قيد الانتظار">قيد الانتظار</option>
            <option value="مكتمل">مكتمل</option>
         </select>
         <div class="flex-btn">
            <input type="submit" value="تحديث" class="option-btn" name="update_order">
            <input type="submit" value="حذف" class="delete-btn" name="delete_order" onclick="return confirm('هل تريد حذف هذا الطلب؟');">
         </div>
      </form>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">لا توجد طلبات بعد!</p>';
      }
   ?>
   </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="admin_script.js"></script>

</body>
</html>
