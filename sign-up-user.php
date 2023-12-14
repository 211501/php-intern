<?php
include 'views.php';
include 'models/userModel.php';
include 'models/Token.php';
session_start();
?>
<?php if(isset($_SESSION['userName']) && isset($_SESSION['userType']) && $_SESSION['userType']=='admin') { ?>

    <!DOCTYPE html>
    <html>
    <head>
        <meta charset='utf-8'>
        <meta http-equiv='X-UA-Compatible' content='IE-edge'>
        <title>Đăng ký</title>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
    </head>
    <body>
    <img src="">
    <?php include 'header.php' ?>
    <div class="container">
        <form action="" method="post" class="form-horizontal" style="margin-top: 100px">
            <div class="form-group">
                <h3> Màn hình đăng ký </h3>
            </div>
            <div class="form-group">
                <?php
                $errors = array();
                if (isset($_POST['btn-sign-up'])) {
                    $userName =  htmlspecialchars($_POST['name']);
                    $pwd = htmlspecialchars($_POST['pwd']);
                    $rePwd = htmlspecialchars($_POST['rePwd']);
                    $userType = 'user';
                    $email = $_POST['email'];
                    $user = new userModel();

                    $emailRegex = '/^\S+@\S+\.\S+$/';
                    $regexPwd = '/^(?=(?:[^A-Z]*[A-Z]){1}[^A-Z]*$).{5,9}$/';
                    $regexName = '/^[a-zA-Z0-9]{3,8}(?:\s[a-zA-Z0-9]{3,8})*$/';

                    if (!preg_match($regexName,$userName)) {
                        $errors['name']= 'Tên người dùng phải có từ 3 đến 8 ký tự. Vui lòng nhập lại';
                    } if(!preg_match($regexPwd, $pwd) || !preg_match($regexPwd, $rePwd)) {
                        $errors['password']= 'Mật khẩu phải có từ 5 đến 9 ký tự và phải chứa một chữ in hoa. Vui lòng nhập lại';
                    } if ($user->findUserByEmail($email) || empty($email)) {
                        $errors['email'] = 'Email không hợp lệ. Vui lòng nhập lại';
                    }if(!preg_match($emailRegex, $email)){
                        $errors['email'] = 'Email không hợp lệ. Vui lòng nhập lại';
                    }if ($rePwd !== $pwd){
                        $errors['rePassword']= 'Không trùng với mật khẩu. Vui lòng nhập lại';
                    }if ($user->findUserByName($userName) ) {
                        $errors['duplicateName']= 'Tên user đã tồn tại . Vui lòng nhập lại';
                    } if (empty($errors)) {
                        $pwd = hashedSHA256($pwd);
                        $user->signUpUser($userName, $pwd, $userType,$email);
                    }
                }
                ?>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" id="name" name="name" class="form-control">
                </div>
                <?php if (isset($errors['name'])) : ?>
                    <div style="color: red"><?php echo $errors['name']; ?></div>
                <?php endif; ?>
                <?php if (isset($errors['duplicateName'])) : ?>
                    <div style="color: red"><?php echo $errors['duplicateName']; ?></div>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="pwd" class="col-sm-2 control-label">Mật khẩu</label>
                <div class="col-sm-10">
                    <input type="password" id="pwd" name="pwd" class="form-control">
                </div>
                <?php if (isset($errors['password'])) : ?>
                    <div style="color: red"><?php echo $errors['password']; ?></div>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="rePwd" class="col-sm-2 control-label">Nhập lại mật khẩu</label>
                <div class="col-sm-10">
                    <input type="password" id="rePwd" name="rePwd" class="form-control">
                </div>
                <?php if (isset($errors['password'])) : ?>
                    <div style="color: red"><?php echo $errors['password']; ?></div>
                <?php endif; ?>
                <?php if (isset($errors['rePassword'])) : ?>
                    <div style="color: red"><?php echo $errors['rePassword']; ?></div>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="email" class="col-sm-2 control-label">Nhập Email</label>
                <div class="col-sm-10">
                    <input type="email" id="email" name="email" class="form-control">
                </div>
                <?php if (isset($errors['email'])) : ?>
                    <div style="color: red"><?php echo $errors['email']; ?></div>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <a href="login.php">Đã có tài khoản? </a>
                    <button type="submit" name="btn-sign-up" class="btn btn-primary">Đăng ký</button>
                </div>
            </div>
        </form>
    </div>
    <?php include 'footer.php'?>
    </body>
    </html>
<?php } else {
    if($_SESSION['userType']=='user'){
        header("Location: listUser.php");
    }else{
        header("Location: login.php");
    }
} ?>
