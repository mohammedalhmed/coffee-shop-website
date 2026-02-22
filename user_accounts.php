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

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_user = $conn->prepare("DELETE FROM `users` WHERE id = ?");
   $delete_user->execute([$delete_id]);
   header('location:user_accounts.php');
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>حسابات المستخدمين</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="admin_style.css">
   <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

<?php include 'admin_header.php'; ?>

<section class="accounts">
   <h1 class="heading">حسابات المستخدمين</h1>
   <div class="box-container" style="display: grid; grid-template-columns: repeat(auto-fit, 33rem); gap: 1.5rem; justify-content: center; align-items: flex-start;">
   <?php
      $select_accounts = $conn->prepare("SELECT * FROM `users` ");
      $select_accounts->execute();
      if($select_accounts->rowCount() > 0){
         while($fetch_accounts = $select_accounts->fetch(PDO::FETCH_ASSOC)){   
   ?>
   <div class="box" style="background-color: var(--white); box-shadow: var(--box-shadow); border: var(--border); border-radius: .5rem; padding: 2rem; text-align: center;">
      <p> معرف المستخدم : <span><?= $fetch_accounts['id']; ?></span> </p>
      <p> اسم المستخدم : <span><?= $fetch_accounts['name']; ?></span> </p>
      <p> البريد الإلكتروني : <span><?= $fetch_accounts['email']; ?></span> </p>
      <p> نوع المستخدم : <span style="color:<?php if($fetch_accounts['user_type'] == 'admin'){ echo 'var(--orange)'; } ?>"><?= $fetch_accounts['user_type']; ?></span> </p>
      <a href="user_accounts.php?delete=<?= $fetch_accounts['id']; ?>" onclick="return confirm('هل تريد حذف هذا الحساب؟')" class="delete-btn">حذف الحساب</a>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">لا توجد حسابات متاحة!</p>';
      }
   ?>
   </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="admin_script.js"></script>

</body>
</html>
