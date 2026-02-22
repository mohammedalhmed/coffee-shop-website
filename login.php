<?php 
include 'components/connection.php';
session_start();

// إذا المستخدم مسجل دخول بالفعل
if (isset($_SESSION['user_id'])) {
    header('location: home.php');
    exit();
}

if (isset($_POST['submit'])){
    $email_or_name = filter_var($_POST['email_or_name'], FILTER_SANITIZE_STRING);
    $pass          = $_POST['pass'];
    $user_type     = $_POST['user_type'] ?? ''; // استلام نوع الحساب من النموذج
    $selected_img  = $_POST['selected_img'] ?? '';
    $correct_img   = $_SESSION['correct_captcha_img'] ?? '';

    // التحقق من الكابتشا
    if ($selected_img !== $correct_img) {
        $message[] = 'خطأ في التحقق من الروبوت، يرجى اختيار الصورة الصحيحة';
    } else {
        // البحث عن المستخدم بالبريد أو الاسم
        $select_user = $conn->prepare("SELECT * FROM users WHERE email = ? OR name = ?");
        $select_user->execute([$email_or_name, $email_or_name]);
        $row = $select_user->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            // التحقق من نوع الحساب
            if ($row['user_type'] !== $user_type) {
                $message[] = 'نوع الحساب غير صحيح';
            } else {
                // التحقق من كلمة المرور
                if (password_verify($pass, $row['password'])) {
                    $_SESSION['user_id']   = $row['id'];
                    $_SESSION['user_name'] = $row['name'];
                    $_SESSION['user_type'] = $row['user_type'];

                    // توجيه المستخدم بناءً على نوع الحساب
                    if ($row['user_type'] === 'admin') {
                        header('location: dashboard.php'); // صفحة المسؤول
                    }else {
                        if ($row['user_type'] === 'user') {
                             header('location: home.php'); // صفحة المستخدم العادي
                        }    
                    }
                    exit();
                } else {
                    $message[] = 'كلمة المرور غير صحيحة';
                }
            }
        } else {
            $message[] = 'البريد الإلكتروني أو اسم المستخدم غير مسجل';
        }
    }
}

// إعداد الكابتشا بالصور
$captcha_images = ['img1.jpg', 'img2.jpg', 'img3.jpg', 'img4.jpg'];
$correct_index = array_rand($captcha_images);
$_SESSION['correct_captcha_img'] = $captcha_images[$correct_index];
?>
<style type="text/css">
    <?php include 'style.css';?>
</style>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الشاي الأخضر - تسجيل دخول الآن</title>
</head>
<body dir="rtl">
    <div class="main-container">
        <section class="form-container">
            <div class="title">
                <img src="img/download.png">
                <h1>تسجيل الدخول</h1>
            </div>
            <?php
            if(isset($message)){
                foreach($message as $msg){
                    echo '<div class="message">'.$msg.'</div>';
                }
            }
            ?>
            <form action="" method="post" id="loginForm">
                <div class="input-field">
                    <p>البريد الإلكتروني أو اسم المستخدم</p>
                    <input type="text" name="email_or_name" required placeholder="أدخل بياناتك" class="nav-input">
                </div>
                <div class="input-field">
                    <p>كلمة المرور</p>
                    <input type="password" name="pass" required placeholder="أدخل كلمة المرور" class="nav-input">
                </div>
                <div class="input-field">
                    <p>نوع الحساب</p>
                    <select name="user_type" required class="nav-input">
                        <option value="user">مستخدم</option>
                        <option value="admin">مسؤول</option>
                    </select>
                </div>
                
                <div class="captcha-container">
                    <p>التحقق من الروبوت: اختر الصورة المماثلة لهذه:</p>
                    <img src="img/captcha/<?php echo $_SESSION['correct_captcha_img']; ?>" style="width: 40px; height: 40px; border: 1px solid #ccc;">
                    <div class="captcha-images">
                        <?php foreach($captcha_images as $img): ?>
                            <img src="img/captcha/<?php echo $img; ?>" onclick="selectCaptcha('<?php echo $img; ?>', this)">
                        <?php endforeach; ?>
                    </div>
                    <input type="hidden" name="selected_img" id="selected_img" required>
                </div>
                <input type="submit" name="submit" value="دخول" class="btn">
                <p>ليس لديك حساب؟ <a href="register.php">سجل الآن</a></p>
                <p>تسجيل دخول المسؤول؟ <a href="admin_login.php">تسجيل دخول</a></p>
            </form>
        </section>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="script.js"></script>
    <?php include 'components/alert.php';?>
</body>
</html>