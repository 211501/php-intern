<?php
declare(strict_types=1);
include 'config/database.php';
class  baseModel {

    public static $conn;

    public function __construct()
    {
        if(!isset(self::$conn)){
            self::$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            if(self::$conn->connect_error){
                print("Fail Connection");
            }
        }
    }
    protected function query($sql) {
        return self::$conn->query($sql);
    }

    protected function select($sql){
        return $this->query($sql);
    }

    /*Thêm user*/
    protected function add($sql){
        return $this->query($sql);
    }

    protected function commit(){
        return self::$conn->commit();
    }

    protected function rollback(){
        return self::$conn->rollback();
    }

    protected function close(){
        return self::$conn->close();
    }

    protected function PessimisticUpdate($name,$email,$id,$newName,$newID,$newEmail,$newPassword,$newHashID) {
        self::$conn->autocommit(false);

        // Sử dụng SELECT ... FOR UPDATE để khóa dòng dữ liệu cho việc cập nhật
        $lock_query = "SELECT * FROM intern.user WHERE name = '$name' AND id = '$id' AND email = '$email' FOR UPDATE";
        $result = $this->query($lock_query);
        $row = $result->fetch_assoc();

        if ($row != null) {
            // Thực hiện cập nhật người dùng từ cơ sở dữ liệu
            $update_query = "UPDATE intern.user SET id = '$newID', name = '$newName', email = '$newEmail', pwd = '$newPassword', hashed_data = '$newHashID' WHERE id = '$id'";
            $this->query($update_query);
            echo "Thay đổi thành công.";
            // Hoàn thành TRANSACTION và giải phóng khóa xem trước
            $check = true;
            $this->commit();
        } else {
            // Người dùng khác đã khóa xem trước tài nguyên, xử lý tương ứng
            echo '<script>';
            echo 'alert("Lỗi: Không thể thay đổi người dùng. Người dùng khác đã khóa xem trước tài nguyên.");';
            echo 'window.location.href = "listUser.php";';
            echo '</script>';
            $this->rollback();
        }

        // Đóng kết nối
        $this->close();
        return $check;
    }

    protected function PessimisticDelete($id){
        self::$conn->autocommit(false);
        $lock_query = "SELECT * FROM intern.user WHERE hashed_data = '$id' FOR UPDATE ";
        $result = $this->query($lock_query);
        $row = $result->fetch_assoc();
        if ($row != null) {
            // Thực hiện xóa người dùng từ cơ sở dữ liệu
            $delete_query = "DELETE FROM intern.user WHERE hashed_data = '$id'";
            $this->query($delete_query);
            echo "xóa thành công";
            // Hoàn thành TRANSACTION và giải phóng khóa xem trước
            $this->commit();
            header("Location: listUser.php");
        } else {
            // Người dùng khác đã khóa xem trước tài nguyên, xử lý tương ứng
            echo '<script>';
            echo 'alert("Không thể xóa người dùng. Người dùng khác đã khóa xem trước tài nguyên.");';
            echo 'window.location.href = "listUser.php";';
            echo '</script>';
            $this->rollback();
        }

        // Đóng kết nối
        $this->close();
    }
}