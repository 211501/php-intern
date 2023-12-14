<?php
include 'views.php';
include 'models/userModel.php';
include 'models/Token.php';
session_start();
if(isset($_SESSION['userName']) && isset($_SESSION['email']) && isset($_SESSION['userType'])){
    header("Location: listUser.php");
}else{
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Login Page</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<?php include 'header.php' ?>
<div class="container my-auto">
    <form action="" method="post" class="form-horizontal mx-auto">
        <div class="form-group">
            <h3> Màn hình đăng nhập </h3>
        </div>
        <div class="form-group">
            <?php
            if (isset($_POST['btn-log-in'])) {
                $userName = htmlspecialchars( $_POST['name']);
                $pwd = htmlspecialchars( $_POST['pwd']);
                $pwd = hashedSHA256($pwd);
                $user = new userModel();
                $result = $user->login($userName, $pwd);

                if ($result == null) {
                    echo '<div style="color: red"> Thông tin đăng nhập không đúng! <br> Vui lòng nhập lại  </div>';
                } else {
                    session_start();
                    $token = Token::generateToken();
                    setcookie('token', $token, time() + 10 * 24 * 60 * 60);
                    $_SESSION['userName'] = $userName;
                    $_SESSION['pwd'] = $pwd;
                    $_SESSION['userType'] = $result;
                    $email =  $user->getEmailUser($_SESSION['userName'],$_SESSION['pwd'],$_SESSION['userType']);
                    $_SESSION['email'] = $email;
                    $user->updateToken($userName,$email,$token);
                    header("Location: listUser.php");
                    if (isset($_POST['remember-me']) && $_POST['remember-me'] == 'on') {
                        setcookie("username", $userName, time() +  10 * 24 * 60 * 60); // 10 ngày = 10 * 24 giờ * 60 phút * 60 giây
                        setcookie("password", $pwd, time() +  10 * 24 * 60 * 60); // 10 ngày = 10 * 24 giờ * 60 phút * 60 giây
                        setcookie("userType", $result, time() +  10 * 24 * 60 * 60); // 10 ngày = 10 * 24 giờ * 60 phút * 60 giây
                    }

                }
            }
            ?>
        </div>
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10">
                <input type="text" id="name" name="name" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label for="pwd" class="col-sm-2 control-label">Mật khẩu</label>
            <div class="col-sm-10">
                <input type="password" id="pwd" name="pwd" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-10">
                <label class="checkbox-label">
                    <input type="checkbox" id="remember-me" name="remember-me">
                    Ghi nhớ đăng nhập
                </label>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <a href="sendEmailForget.php"> Quên mật khẩu </a>
                <button type="submit" name="btn-log-in" class="btn btn-primary">Đăng nhập</button>
            </div>
        </div>
    </form>
</div>
<?php
if (isset($_COOKIE['username']) && isset($_COOKIE['password']) && isset($_COOKIE['userType'])) {
    $user = new userModel();
    $result = $user->login($_COOKIE['username'], $_COOKIE['password']);
    if($result == $_COOKIE['userType']){
        header("Location: listUser.php");
    }
    else{
        header("Location: login.php");
    }
}
?>
</body>
<?php include 'footer.php'?>
</html>
<?php } ?>