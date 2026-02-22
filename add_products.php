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

if(isset($_POST['add_product'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);
   $details = $_POST['details'];
   $details = filter_var($details, FILTER_SANITIZE_STRING);

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'image/'.$image;

   $select_product_name = $conn->prepare("SELECT * FROM products WHERE name = ?");
   $select_product_name->execute([$name]);

   if($select_product_name->rowCount() > 0){
      $warning_msg[] = 'اسم المنتج موجود بالفعل!';
   }else{
      if($image_size > 2000000){
         $warning_msg[] = 'حجم الصورة كبير جداً!';
      }else{
         $insert_product = $conn->prepare("INSERT INTO products(id, name, price, details, image) VALUES(?,?,?,?,?)");
         $insert_product->execute([unique_id(), $name, $price, $details, $image]);
         move_uploaded_file($image_tmp_name, $image_folder);
         $success_msg[] = 'تم إضافة المنتج بنجاح!';
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
   <title>إضافة منتجات</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="admin_style.css">
   <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

<?php include 'admin_header.php'; ?>

<section class="add-products">
   <h1 class="heading">إضافة منتج جديد</h1>
   <form action="" method="post" enctype="multipart/form-data">
      <div class="flex">
         <div class="inputBox">
            <span>اسم المنتج (مطلوب)</span>
            <input type="text" class="box" required maxlength="100" placeholder="أدخل اسم المنتج" name="name">
         </div>
         <div class="inputBox">
            <span>سعر المنتج (مطلوب)</span>
            <input type="number" min="0" class="box" required max="9999999999" placeholder="أدخل سعر المنتج" onkeypress="if(this.value.length == 10) return false;" name="price">
         </div>
         <div class="inputBox">
            <span>صورة المنتج (مطلوب)</span>
            <input type="file" name="image" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
         </div>
         <div class="inputBox">
            <span>تفاصيل المنتج (مطلوب)</span>
            <textarea name="details" placeholder="أدخل تفاصيل المنتج" class="box" required maxlength="500" cols="30" rows="10"></textarea>
         </div>
      </div>
      <input type="submit" value="إضافة المنتج" class="btn" name="add_product">
   </form>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="admin_script.js"></script>

</body>
</html>
