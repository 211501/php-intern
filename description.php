<?php
include 'models/userModel.php';
include 'views.php';
include 'models/Token.php';
include 'header.php';
$user = new userModel();
session_start();
?>
    <div class="container">
        <form action="" method="post" style="margin-top: 100px">
            <label for="description">Description</label>
            <input type="text" id="description" name="description"><br>
            <button type="submit" name="btn-comments" class="btn btn-danger">Nhập</button>
        </form>
    </div>
<?php
if(isset($_POST['btn-comments'])){
    if(isset($_GET['id']) && isset($_GET['token'])) {
        $token = $_GET['token'];
        $id = decodeId(urldecode($_GET['id']));
        $resultCheckToken = $user->checkToken($token);
        if ($resultCheckToken) {
            $string = $_POST['description'];
            if($user->description($id, $string)){
                echo "thành công";
                header("Location: listUser.php");
            }
        }
    }else{
        echo "LỖI TOKEN";
    }
}
include 'footer.php';
?>