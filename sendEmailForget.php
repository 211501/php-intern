<?php
include 'models/userModel.php';
include 'views.php';
include 'header.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$user = new userModel();


?>

<div class="container">
    <form action="" method="post" style="margin-top: 100px">
        <h2> Quên mật khẩu </h2>
        <label for="email">Email</label>
        <input type="email" id="email" name="email"><br>
        <button type="submit" name="btn-send-mail" class="btn-danger">Gửi</button>
    </form>

    <?php
    if(isset($_POST['btn-send-mail'])) {
        $email = htmlspecialchars($_POST['email']);
        if($user->findUserByEmail($email)){
            // Tạo một đối tượng PHPMailer
            $mail = new PHPMailer(true); // true để bật chế độ lỗi

            try {
                // Cài đặt thông tin SMTP
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'lephuanhbao@gmail.com'; // Địa chỉ email Gmail của bạn
                $mail->Password = 'orud czcy kqqg zhsc'; // Mật khẩu email Gmail của bạn
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                // Thiết lập thông tin người gửi và người nhận
                $mail->setFrom('lephuanhbao@gmail.com', 'Le Phu');
                $mail->addAddress($email, 'Anh Bao');

                // Thiết lập nội dung email
                $mail->isHTML(true);
                $mail->Subject = 'THAY ĐỔI MẬT KHẨU';
                $mail->Body = 'Bấm vào <a href="http://php.local/forgetForm.php">đường dẫn</a> để thay đổi mật khẩu';

                // Gửi email
                $mail->send();
                echo 'Email sent successfully';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }else {
            echo "Gmail không hợp lệ";
        }
    }
    ?>
</div>

<?php include 'footer.php'?>
