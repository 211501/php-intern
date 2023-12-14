<?php
include 'models/userModel.php';
session_start();
if (isset($_GET['id']) && isset($_GET['token']) ) {
    $hashID = $_GET['id'];
    $id = decodeId($hashID);
    $token = $_GET['token'];
    $user = new userModel();
    $resultCheckToken = $user->checkToken($token);
    if ($resultCheckToken) {
        $user->deleteUser($id);
    } else {
        // Chuyển hướng về trang chính và hiển thị thông báo
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


