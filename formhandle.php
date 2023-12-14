<?php
include 'models/userModel.php';
session_start();

// Thêm user
$user = new userModel();
    $userName = $_SESSION['userName'];
    $pwd = $_SESSION['pwd'];
    $id = $user->signUp_getid($userName,$pwd);
    $hashID = encodeId($id);
    $user->addEmployee($userName,$id,$hashID);
    header("Location: listUser.php");


