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

if(isset($_POST['update'])){

   $pid = $_POST['pid'];
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);
   $details = $_POST['details'];
   $details = filter_var($details, FILTER_SANITIZE_STRING);

   $update_product = $conn->prepare("UPDATE products SET name = ?, price = ?, details = ? WHERE id = ?");
   $update_product->execute([$name, $price, $details, $pid]);

   $success_msg[] = 'تم تحديث المنتج بنجاح!';

   $old_image = $_POST['old_image'];
   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'image/'.$image;

   if(!empty($image)){
      if($image_size > 2000000){
         $warning_msg[] = 'حجم الصورة كبير جداً!';
      }else{
         $update_image = $conn->prepare("UPDATE products SET image = ? WHERE id = ?");
         $update_image->execute([$image, $pid]);
         move_uploaded_file($image_tmp_name, $image_folder);
         unlink('image/'.$old_image);
         $success_msg[] = 'تم تحديث الصورة بنجاح!';
      }
   }
}
?>
<!DOCTYPE html>
<html lang="ar">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>تعديل المنتج</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="admin_style.css">
   
   <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

   <?php include 'admin_header.php'; ?>
   <section class="add-product">
      <h1 class="heading">تعديل المنتج</h1>
      <?php
         $update_id = $_GET['update'];
         $select_products = $conn->prepare("SELECT * FROM products WHERE id = ?");
         $select_products->execute([$update_id]);
         if($select_products->rowCount() > 0){
            while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
      ?>
      <form action="" method="post" enctype="multipart/form-data">
         <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
         <input type="hidden" name="old_image" value="<?= $fetch_products['image']; ?>">
         <div class="image-container">
            <img src="image/<?= $fetch_products['image']; ?>" alt="" style="width: 200px; height: 200px; object-fit: contain;">
         </div>
         <div class="flex">  
           <span>تحديث الاسم</span>
           <input type="text" name="name" required placeholder="أدخل اسم المنتج" class="box" maxlength="100" value="<?= $fetch_products['name']; ?>">
           <span>تحديث السعر</span>
           <input type="number" name="price" required placeholder="أدخل سعر المنتج" class="box" min="0" max="9999999999" onkeypress="if(this.value.length == 10) return false;" value="<?= $fetch_products['price']; ?>">
           <span>تحديث التفاصيل</span>
           <textarea name="details" class="box" required cols="30" rows="10"><?= $fetch_products['details']; ?></textarea>
           <span>تحديث الصورة</span>
           <input type="file" name="image" accept="image/jpg, image/jpeg, image/png, image/webp" class="box">
           <div class="flex-btn">
              <input type="submit" name="update" class="btn" value="تحديث">
              <a href="view_products.php" class="option-btn">الرجوع</a>
           </div>
         </div>
      </form>
      <?php
            }
         }else{
            echo '<p class="empty">لا يوجد منتج بهذا المعرف!</p>';
         }
      ?>
   </section>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
   <script src="admin_script.js"></script>

</body>
</html>
