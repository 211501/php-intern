<?php
include 'models/userModel.php';
include 'views.php';
include 'models/Token.php';
session_start();


if(isset($_SESSION['userName']) && isset($_SESSION['userType'])) {
    $errors = array();
    $hashID = decodeId($_GET['id']);
    $name = decodeId($_GET['n']);
    $email = decodeId($_GET['e']);
    $userModel = new userModel();
    $id = $userModel->getIDbyHashID($hashID);
    $password = $userModel->getPassword($id,$name,$email);
    $data = $userModel->getUser($id);
    ?>
<?php include 'header.php' ?>
    <div class="container" style="margin-top: -30px">
        <form action="" method="post" style="margin-top: 100px">
            <div class="form-group">
                <h2> Màn hình chỉnh sửa </h2>
            </div>
            <div>
                <?php
                if (isset($_POST['btn-update'])) {
                    if(isset($_GET['id']) && isset($_GET['token'])){
                        $token = $_GET['token'];
                        $resultCheckToken = $userModel->checkToken($token);
                        if ($resultCheckToken) {
                            $newName = $_POST['name'];
                            $newID = $_POST['newID'];
                            $newEmail = $_POST['newEmail'];

                            $emailRegex = '/^\S+@\S+\.\S+$/';
                            $regexPwd = '/^(?=(?:[^A-Z]*[A-Z]){1}[^A-Z]*$).{5,9}$/';
                            $regexName = '/^[a-zA-Z0-9]{3,8}(?:\s[a-zA-Z0-9]{3,8})*$/';

                            if(empty($_POST['newPassword']) && empty($_POST['rePassword'])){
                                $newPassword = $password;
                                $rePassword = $password;
                            }else{
                                $newPassword = $_POST['newPassword'];
                                $rePassword = $_POST['rePassword'];
                                if (!preg_match($regexPwd,$newPassword) || !preg_match($regexPwd,$rePassword)){ // kiểm tra điều kiện cho email
                                    $errors['password']= 'Mật khẩu phải có từ 5 đến 9 ký tự và phải chứa ít nhất một chữ in hoa. Vui lòng nhập lại';
                                }
                            }
                            $newUser = new userModel();
                            $checkEmail = $userModel->findUserByEmail($newEmail);
                            $checkName = $userModel->findUserByName($newName);
                            if (!preg_match($regexName,$newName)) { // kiểm tra điều kiện tên
                                $errors['name']= 'Tên người dùng phải có từ 3 đến 8 ký tự. Vui lòng nhập lại';
                            } if ($newUser->checkID($newID) && $id !== $newID) { // kiểm tra ID tồn tại không
                                $errors['ID']= 'ID đã tồn tại. Vui lòng nhập lại';
                            }if ($newPassword !== $rePassword){ // kiểm tra bị trống và giống password
                                $errors['emptyPassword']= 'Mật khẩu không trùng khớp. Vui lòng nhập lại';
                            }  if($checkEmail && $email !== $newEmail ){ // Kiểm tra email tồn tại không
                                $errors['email']= 'Email không phù hợp. Vui lòng nhập lại';
                            } if($checkName && $name !== $newName ) { // Trường hợp chỉ dành cho user // Kiểm tra tên tồn tại không
                                $errors['duplicateName'] = 'Tên user đã tồn tại . Vui lòng nhập lại';
                            }if (!preg_match($emailRegex,$newEmail)) { // kiểm tra điều kiện tên
                                $errors['name']= 'Tên người dùng phải có từ 3 đến 8 ký tự. Vui lòng nhập lại';
                            }if(empty($errors)){
                                $newHashID = hashedSHA256($newID);
                                $newPassword = hashedSHA256($newPassword);
                                $result = $newUser->updateUser($name,$email,$id,$newName,$newID,$newEmail,$newPassword,$newHashID);
                                if($result && $_SESSION['userType'] == 'user') {
                                    $_SESSION['userName'] = $newName;
                                    $_SESSION['email'] = $newEmail;
                                }
                            }
                        } else {
                            echo '<script>';
                            echo 'alert("SAI TOKEN");';
                            echo 'window.location.href = "listUser.php";';
                            echo '</script>';
                        }
                    }else{
                        echo '<script>';
                        echo 'alert("Lỗi: Token không tồn tại.");';
                        echo 'window.location.href = "listUser.php";';
                        echo '</script>';
                    }
                }
                } ?>
            </div>
            <div class="form-group">
                <label for="name">Name</label><br>
                <input type="text" id="name" name="name" value="<?php echo $name;  ?>"><br>
                <?php if (isset($errors['name'])) : ?>
                    <div style="color: red"><?php echo $errors['name']; ?></div>
                <?php endif; ?>
                <?php if (isset($errors['duplicateName'])) : ?>
                    <div style="color: red"><?php echo $errors['duplicateName']; ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="newID">ID</label><br>
                <input type="number" id="newID" name="newID" value="<?php echo $id; ?>"><br>
                <?php if (isset($errors['ID'])) : ?>
                    <div style="color: red"><?php echo $errors['ID']; ?></div>
                <?php endif; ?>
            </div>


            <div class="form-group">
                <label for="newEmail">Email mới</label><br>
                <input type="email" id="newEmail" name="newEmail" value="<?php echo $email;  ?>"><br>
                <?php if (isset($errors['email'])) : ?>
                    <div style="color: red"><?php echo $errors['email']; ?></div>
                <?php endif; ?>
            </div>


            <div class="form-group">
                <label for="newPassword">Mật khẩu mới</label><br>
                <input type="password" id="newPassword" name="newPassword"><br>
                <?php if (isset($errors['emptyPassword'])) : ?>
                    <div style="color: red"><?php echo $errors['emptyPassword']; ?></div>
                <?php endif; ?>
                <?php if (isset($errors['password'])) : ?>
                    <div style="color: red"><?php echo $errors['password']; ?></div>
                <?php endif; ?>
            </div>


            <div class="form-group">
                <label for="rePassword">Nhập lại mật khẩu</label><br>
                <input type="password" id="rePassword" name="rePassword"><br>
                <?php if (isset($errors['emptyPassword'])) : ?>
                    <div style="color: red"><?php echo $errors['emptyPassword']; ?></div>
                <?php endif; ?>
                <?php if (isset($errors['password'])) : ?>
                    <div style="color: red"><?php echo $errors['password']; ?></div>
                <?php endif; ?>
            </div>

            <div style="margin-top: 10px">
                <button type="submit" name="btn-update" class="btn btn-danger">Change</button>
                <a href="listUser.php" class="btn btn-primary">View List</a>
            </div>
        </form>
    </div>
<?php include 'footer.php'?>

