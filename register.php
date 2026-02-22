<?php 
include 'components/connection.php';
session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}

if (isset($_POST['submit'])) {
    $id        = unique_id();
    $name      = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email     = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password  = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $user_type = $_POST['user_type']; // استلام نوع الحساب من النموذج

    // 1) التحقق من البريد الإلكتروني
    if (!preg_match("/^[a-zA-Z0-9._%+-]+@(gmail|hotmail)\.com$/", $email)) {
        $message[] = 'البريد الإلكتروني يجب أن يكون gmail أو hotmail ويحتوي على تنسيق صحيح';
    } 
    // 2) التحقق من كلمة المرور (حروف وأرقام ورموز)
    elseif (!preg_match("/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[\W_]).+$/", $password)) {
        $message[] = 'كلمة المرور يجب أن تحتوي على حروف وأرقام ورموز معاً';
    }
    // 3) التحقق من تطابق كلمة المرور
    elseif ($password !== $cpassword) {
        $message[] = 'كلمات المرور غير متطابقة';
    }
    else {
        // 4) التحقق من عدم تكرار اسم الحساب أو البريد الإلكتروني
        $select_user = $conn->prepare("SELECT * FROM users WHERE email = ? OR name = ?");
        $select_user->execute([$email, $name]);
        
        if ($select_user->rowCount() > 0) {
            $message[] = 'اسم المستخدم أو البريد الإلكتروني موجود مسبقاً';
        } else {
            // 5) تشفير كلمة المرور
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // 6) إدخال المستخدم الجديد
            $insert_user = $conn->prepare("INSERT INTO users(id, name, email, password, user_type) VALUES(?,?,?,?,?)");
            $insert_user->execute([$id, $name, $email, $hashed_password, $user_type]);

            // 7) جلب بيانات المستخدم بعد التسجيل
            $select_user = $conn->prepare("SELECT * FROM users WHERE email = ?");
            $select_user->execute([$email]);
            $row = $select_user->fetch(PDO::FETCH_ASSOC);

            if ($row && password_verify($password, $row['password'])) {
                $_SESSION['user_id']    = $row['id'];
                $_SESSION['user_name']  = $row['name'];
                $_SESSION['user_email'] = $row['email'];
                //$_SESSION['user_type']  = $row['user_type'];
            }

            header('location: home.php');
            exit();
        }
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
    <title>الشاي الأخضر - سجل الآن </title>
</head>
<body dir="rtl">
    <div class="main-container">
        <section class="form-container">
            <div class="title">
                <img src="img/download.png">
                <h1>إنشاء حساب</h1>
                <p>يرجى ملء البيانات التالية لإنشاء حسابك</p>
            </div>
            <?php
            if(isset($message)){
                foreach($message as $msg){
                    echo '<div class="message">'.$msg.'</div>';
                }
            }
            ?>
            <form action="" method="post" id="regForm">
                <div class="input-field">
                    <p>اسم المستخدم</p>
                    <input type="text" name="name" required placeholder="أدخل اسمك" maxlength="50" class="nav-input">
                </div>
                <div class="input-field">
                    <p>البريد الإلكتروني (gmail أو hotmail)</p>
                    <input type="email" name="email" required placeholder="example@gmail.com" maxlength="50" class="nav-input">
                </div>
                <div class="input-field">
                    <p>كلمة المرور (حروف + أرقام + رموز)</p>
                    <input type="password" name="password" required placeholder="أدخل كلمة المرور" maxlength="50" class="nav-input">
                </div>
                <div class="input-field">
                    <p>تأكيد كلمة المرور</p>
                    <input type="password" name="cpassword" required placeholder="أعد إدخال كلمة المرور" maxlength="50" class="nav-input">
                </div>
                <div class="input-field">
                    <p>نوع الحساب</p>
                    <select name="user_type" required class="nav-input">
                        <option value="user">مستخدم</option>
                    </select>
                </div>
                
                <div class="buttons" style="display: flex; gap: 10px; margin-top: 20px;">
                    <input type="submit" name="submit" value="إنشاء حساب" class="btn" style="flex: 1;">
                    <a href="login.php" class="btn" style="flex: 1; text-align: center;">تسجيل دخول</a>
                </div>
            </form>
        </section>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="script.js"></script>
    <?php include 'components/alert.php';?>
</body>
</html>
