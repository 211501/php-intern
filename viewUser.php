<?php
include 'models/userModel.php';
include 'views.php';
include 'models/Token.php';
session_start();

if(isset($_SESSION['userName']) && isset($_SESSION['email'])) {
    $userModel = new userModel();
    $hashID = decodeId($_GET['id']);
    $id = $userModel->getIDbyHashID($hashID);
    $name = decodeId($_GET['n']);
    $email = decodeId($_GET['e']);

    $data = $userModel->getUser($id);

    $userID = $userModel->getIDuser($_SESSION['email'],$_SESSION['userName'],$_SESSION['pwd']);
    ?>
    <?php include 'header.php' ?>
    <div class="container">
        <form action="" method="post" style="margin-top: 100px">
            <h2> Màn hình chi tiết </h2>
            <?php foreach ($data as $user) { ?>
                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name'], ENT_QUOTES, 'UTF-8'); ?>" readonly><br>
                <label for="newID">ID</label>
                <input type="text" id="newID" name="newID" value="<?php echo htmlspecialchars($user['id'], ENT_QUOTES, 'UTF-8'); ?>" readonly><br>
                <label for="newEmail">Email</label>
                <input type="email" id="newEmail" name="newEmail" value="<?php echo htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8'); ?>" readonly><br>
                <div style="text-align: left">
                    <label for="description">Description</label>
                    <span id="description" name="description" style="display: inline-block; max-width: 450px; overflow: hidden;">
                    <?php echo htmlspecialchars($user['description'], ENT_QUOTES, 'UTF-8'); ?>
                    </span><br>
                </div>
            <?php } ?>
            <?php if( $userID == $id ||  $_SESSION['userType'] == 'admin'){?>
            <div style="margin-top: 10px">
                <button id="redirectButton" type="button" name="btn-update" class="btn btn-danger">Chỉnh sửa</button>
            </div>
            <script>
                document.getElementById("redirectButton").onclick = function() {
                    window.location.href = "modifyUser.php?id=<?php echo encodeId($user['hashed_data']);?>&n=<?php echo encodeId($user['name']);?>&e=<?php echo encodeId($user['email']);?>&token=<?php echo $_COOKIE['token'];?>";
                };
            </script>
            <?php } ?>
        </form>
    </div>
<?php } include 'footer.php'?>