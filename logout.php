<?php
session_start();
session_destroy();

// Xóa cookie bằng cách đặt thời gian hết hạn trong quá khứ
if (isset($_COOKIE['username']) && isset($_COOKIE['password']) && isset($_COOKIE['userType'])) {
    $name = $_COOKIE['username'];
    $pwd = $_COOKIE['password'];
    $userType = $_COOKIE['userType'];
    setcookie("username", $name, time() -  10 * 24 * 60 * 60);
    setcookie("password", $pwd, time() -  10 * 24 * 60 * 60);
    setcookie("userType", $userType, time() - 10 * 24 * 60 * 60);
    setcookie("token", $_COOKIE['token'], time() - 10 * 24 * 60 * 60);
}

header('location: login.php');

