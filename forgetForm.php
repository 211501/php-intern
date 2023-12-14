<?php
include 'models/userModel.php';
include 'views.php';
include 'header.php';
$user = new userModel();
?>
    <div class="container">
        <form action="" method="post" style="margin-top: 100px">
            <h2> Quên mật khẩu </h2>
                <label for="email">Email</label>
                <input type="email" id="email" name="email"><br>
                <label for="name">Name</label>
                <input type="text" id="name" name="name"><br>
                <label for="newPwd">Nhập mật khẩu mới</label>
                <input type="password" id="newPwd" name="newPwd"><br>
                <label for="reNewPwd">Nhập lại mật khẩu mới</label>
                <input type="password" id="reNewPwd" name="reNewPwd"><br>
                <div style="margin-top: 10px">
                    <button type="submit" name="btn-forget" class="btn-danger">Làm mới</button>
                </div>
            <?php
            if(isset($_POST['btn-forget'])) {
                $email = $_POST['email'];
                $name = $_POST['name'];
                $pwd = $_POST['newPwd'];
                $rePwd = $_POST['reNewPwd'];
                if (empty($email) || empty($pwd) || empty($rePwd)) {
                    echo '<div style="color: red"> Không được để trống. Vui lòng nhập lại  </div>';
                } elseif (strlen($pwd) < 5 || strlen($pwd) > 9 || !preg_match('/[A-Z]/', $pwd)) {
                    echo '<div style="color: red"> Mật khẩu phải có từ 5 đến 9 ký tự và phải chứa ít nhất một chữ in hoa. Vui lòng nhập lại  </div>';
                } elseif (!$user->findUserByEmail($email)){
                    echo '<div style="color: red"> Email này không tồn tại. Vui lòng nhập lại  </div>';
                } elseif ($pwd !== $rePwd){
                    echo '<div style="color: red"> Nhập lại email chưa đúng. Vui lòng nhập lại  </div>';
                }else {
                    $user->forget($email, $name, $pwd);
                    header('Location: login.php');
                }
            }
            ?>
        </form>
    </div>
<?php include 'footer.php'?>