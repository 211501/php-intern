<?php
declare(strict_types=1);
include('baseModel.php');
include 'encode.php';
class userModel extends baseModel {
    //override
    protected function select($sql){
        $result = $this->query($sql);
        $rows = [];
        if(!empty($result)){
            // Duyệt từng dòng dữ liệu của kết quả và thêm vào mảng row
            while ($row = $result->fetch_assoc()){
                $rows[] = $row;
            }
        }
        return $rows;
    }


    //Overload
    function __call($name_of_function, $arguments) {
        if($name_of_function == 'getUsers') {
            switch (count($arguments)) {
                case 0:
                    $sql = "SELECT * FROM user ORDER BY name";
                    return $this->select($sql);
            }
        }

        if($name_of_function == 'getUser') {
            switch (count($arguments)) {
                case 1:
                    // lay 1 user trong data
                    $sql = "SELECT * FROM user where id = ".$arguments[0].";";
                    return $this->select($sql);
            }
        }
    }

    public function addEmployee($name,$id,$hashID) :void{
        $sqlquery = "insert into employee(id,name,hash_id) values ($id,'$name','$hashID')";
        $this->add($sqlquery);
    }

    public function updateUser($name,$email,$id,$newName,$newID,$newEmail,$newPassword,$newHashID) {
        return $this->PessimisticUpdate($name,$email,$id,$newName,$newID,$newEmail,$newPassword,$newHashID);
    }

    public function deleteUser($id) {
            $this->PessimisticDelete($id);
    }



//    public function getUsers(){
//        $sql = "SELECT * FROM user ORDER BY name";
//        return $this->select($sql);
//    }


    public function pagination ($thisPageFirstResult,$result_per_page){
        $sql = "SELECT * FROM user ORDER BY name ASC LIMIT " . $thisPageFirstResult . ',' . $result_per_page;
        return $this->select($sql);
    }



//    public function getUserById($id){
//        $sql = "SELECT * FROM user where id = ".$id.";";
//        return $this->select($sql);
//    }

    public function checkID($id){
        $sql = "SELECT * FROM user where id = ".$id.";";
        $result = $this->select($sql);
        if (!empty($result)) {
            return true; // Trả về giá trị "name" nếu tìm thấy.
        } else {
            return false; // Trả về null nếu không tìm thấy.
        }
    }

    public function signUpUser($name,$pwd,$userType,$email) :void{
        $sql = "insert into user(name,pwd,userType,email) values ('$name','$pwd','$userType','$email')";
        $this->add($sql);
        $id = $this->signUp_getid($name,$email);
        $hashID = hashedSHA256($id);
        $sql_update_hash = "update user set hashed_data = '$hashID' where id = '$id'";
        $this->query($sql_update_hash);
    }

    public function signUp_getid($name, $email){
        $sql = "SELECT id FROM user WHERE name = '$name' AND email = '$email'";
        $result = $this->select($sql);
        if (!empty($result)) {
            return $result[0]['id']; // Trả về giá trị "id" nếu tìm thấy.
        } else {
            return null; // Trả về null nếu không tìm thấy.
        }
    }

    public function login($name, $pwd){
        $sql = "SELECT * FROM user WHERE name = '$name' AND pwd = '$pwd'";
        $result = $this->select($sql);
        if (!empty($result)) {
            return $result[0]['userType']; // Trả về giá trị "id" nếu tìm thấy.
        } else {
            return null; // Trả về null nếu không tìm thấy.
        }
    }

    public function getIDuser($email,$name,$pwd){
        $sql = "SELECT * FROM user where name = '$name' and pwd = '$pwd' and email = '$email'";
        $result = $this->select($sql);
        if (!empty($result)) {
            return $result[0]['id']; // Trả về giá trị "id" nếu tìm thấy.
        } else {
            return null; // Trả về null nếu không tìm thấy.
        }
    }

    public function findUserByEmail($email){
        $sql = "SELECT * FROM user WHERE email = '$email'";
        $result = $this->select($sql);
        if (!empty($result)) {
            return true;
        } else {
            return false;
        }
    }

    public function findUserByName($name){
        $sql = "SELECT * FROM user WHERE name = '$name'";
        $result = $this->select($sql);
        if (!empty($result)) {
            return true;
        } else {
            return false;
        }
    }

    public function getEmailUser($name,$password,$userType){
        $sql = "SELECT * FROM intern.user where name = '$name' AND pwd = '$password' AND userType = '$userType'";
        $result = $this->select($sql);
        if (!empty($result)) {
            return $result[0]['email']; // Trả về giá trị "id" nếu tìm thấy.
        } else {
            return null; // Trả về null nếu không tìm thấy.
        }
    }

    public function updateToken($name,$email,$token) :void{
        $sql = "update intern.user set token = '$token' where name = '$name' AND email = '$email'";
        $this->query($sql);
    }

    public function forget($email, $name, $pwd) :void{
        $sql = "UPDATE intern.user SET pwd = '$pwd', name = '$name' WHERE email = '$email'";
        $this->query($sql);
    }

    public function checkToken($token){
        $sessionToken = $_SESSION['token'];
        if($token === $sessionToken){
            return true;
        }else{
            return false;
        }
    }

    public function description($id, $description) {
        $sql = "UPDATE intern.user SET description = '$description' WHERE hashed_data = '$id'";
        return $this->query($sql);
    }

    public function getPassword($id,$name,$email){
        $sql = "SELECT * FROM intern.user where name = '$name' AND id = '$id' AND email = '$email'";
        $result = $this->select($sql);
        if (!empty($result)) {
            return $result[0]['pwd']; // Trả về giá trị "id" nếu tìm thấy.
        } else {
            return null; // Trả về null nếu không tìm thấy.
        }
    }

    public function getIDbyHashID($hashID){
        $sql = "SELECT * FROM intern.user where hashed_data = '$hashID'";
        $result = $this->select($sql);
        if (!empty($result)) {
            return $result[0]['id']; // Trả về giá trị "id" nếu tìm thấy.
        } else {
            return null; // Trả về null nếu không tìm thấy.
        }
    }

}