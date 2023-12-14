<?php
//session_start();
//?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
</head>
<body>
    <header>
        <div class="rectangle">
<!--            <a href="login.php">Home</a> |-->
            <?php
            if(isset($_SESSION['userType']) && $_SESSION['userType']== 'admin') {
                $current_page = basename($_SERVER['PHP_SELF']);
                switch ($current_page) {
                    case 'login.php':
                        echo '<a href="http://php.local/">Home</a> |<a href="login.php"><strong>Đăng nhập</strong></a> | <a href="sign-up.php">Đăng ký</a> | <a href="sign-up-user.php">Đăng ký user</a> |<a href="logout.php">Đăng xuất</a> ';
                        break;

                    case 'modifyUser.php':
                    case 'listUser.php':
                    case 'viewUser.php':
                        echo '<a href="http://php.local/"><strong>Home</strong></a> |<a href="logout.php"><strong>Đăng xuất</strong></a>';
                        break;

                    case 'sign-up.php':
                        echo '<a href="http://php.local/">Home</a> |<a href="login.php">Đăng nhập</a> | <a href="sign-up.php"><strong>Đăng ký</strong></a> | <a href="sign-up-user.php">Đăng ký user</a> |<a href="logout.php">Đăng xuất</a> ';
                        break;

                    case 'sign-up-user.php':
                        echo '<a href="http://php.local/">Home</a> |<a href="login.php">Đăng nhập</a> | <a href="sign-up.php">Đăng ký</a> | <a href="sign-up-user.php"><strong>Đăng ký user</strong></a> |<a href="logout.php">Đăng xuất</a> ';
                        break;

                    default:
                        echo "Bạn đang ở một trang khác";
                        break;
                }
            }else{
                $current_page = basename($_SERVER['PHP_SELF']);
                switch ($current_page) {
                    case 'login.php':
                        echo '<a href="http://php.local/">Home</a> |<a href="login.php"><strong>Đăng nhập</strong></a>';
                        break;
                    case 'listUser.php':
                    case 'viewUser.php':
                    case 'modifyUser.php':
                    case 'description.php':
                        echo '<a href="http://php.local/">Home</a> |<a href="logout.php"><strong>Đăng xuất</strong></a>';
                        break;
                }
            }

            ?>
        </div>
    </header>
</body>
</html>
