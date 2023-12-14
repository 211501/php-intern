<?php
    include 'models/userModel.php';
    session_start();
    $userModel = new userModel();
    if (isset($_SESSION['userName']) && isset($_SESSION['email']) && isset($_SESSION['userType'])) {
?>
<!DOCTYPE html>
<html>
    <head>
        <title> Danh sach user </title>
        <link rel="stylesheet" type="text/css" href="public/css/style.css" >
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>
    <body>
    <div class="container">
        <?php include 'header.php' ?>
        <div class="row">
            <div class="col-md-9" style="margin-top: 50px; width: 100%" >
                <h1>Danh sách user</h1>
            </div>
        </div>
    </div>
    <div class="container">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th> Name </th>
                <th> ID </th>
                <th> Email </th>
                <th> Action </th>
            </tr>
            </thead>
            <tbody>
            <?php
            $id_user = $userModel->signUp_getid($_SESSION['userName'],$_SESSION['email']);

            $result_per_page = 10;
            $result = $userModel->getUsers();
            $numberResult = count($result);


            $numberOfPage = ceil($numberResult / $result_per_page);

            if (!isset($_GET['page'])) {
                $page_number = 1;
            } else {
                $page_number = $_GET['page'];
            }

            $thisPageFirstResult = ($page_number - 1) * $result_per_page;

            $result = $userModel->pagination($thisPageFirstResult,$result_per_page);

            foreach ($result as $user){?>
                <tr>
                    <td> <?php echo $user['name']; ?> </td>
                    <td> <?php echo $user['id']; ?> </td>
                    <td> <?php echo $user['email']; ?> </td>
                    <td>
                        <a href="viewUser.php?id=<?php echo encodeId($user['hashed_data']);?>&n=<?php echo encodeId($user['name']);?>&e=<?php echo encodeId($user['email']);?>&token=<?php echo $_COOKIE['token'];?>" class="btn btn-primary"> View </a>
                        <?php if($user['id'] == $id_user || $_SESSION['userType'] == 'admin'){ ?>
                            <a href="modifyUser.php?id=<?php echo encodeId($user['hashed_data']);?>&n=<?php echo encodeId($user['name']);?>&e=<?php echo encodeId($user['email']);?>&token=<?php echo $_COOKIE['token'];?>" class="btn btn-primary"> Modify </a>
                            <a href="deleteUser.php?id=<?php echo encodeId($user['hashed_data']);?>&token=<?php echo $_COOKIE['token']; ?>" class="btn btn-danger"> Delete </a>
                            <a href="description.php?id=<?php echo encodeId($user['hashed_data']);?>&n=<?php echo encodeId($user['name']);?>&e=<?php echo encodeId($user['email']);?>&token=<?php echo $_COOKIE['token'];?>" class="btn btn-primary"> Description </a>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <div>
        <div>
            <?php
            if ($page_number > 1) {
                $prev_page = $page_number - 1;
                echo "<a href='listUser.php?page=" . $prev_page . "'>Previous</a> ";
            }

            for ($page = 1; $page <= $numberOfPage; $page++) {
                if ($page == $page_number) {
                    echo "<strong>" . $page . "</strong> ";
                } else {
                    echo '<a href="listUser.php?page=' . $page . '"> ' . $page . '</a>';
                }

            }

            if ($page_number < $numberOfPage) {
                $next_page = $page_number + 1;
                echo "<a href='listUser.php?page=" . $next_page . "'>Next</a>";
            }
            ?>
        </div>
    </div>
    </body>
    <?php include 'footer.php'?>
</html>
    <?php } else {
        header("Location: login.php");
    } ?>