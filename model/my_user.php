<?php

header('Content-Type:text/html; charset=UTF-8;');
require "../dll/my_db.php";
require "../dll/my_permit.php";

class My_User
{
    protected $uid;
    protected $phone;
    protected $nickName;
    protected $pwd;
    protected $photo;
    protected $signature;
    protected $add_time;

    public function IsLogin()
    {
        //检测是否登录，若没登录则转向登录界面
        session_start();
        if (!isset($_SESSION['permit'])) {
            // header("Location:login.html");
            return 0;
        }
        return 1;
    }

    public function Login($phone, $pwd)
    {
        $my_db = new My_DB();
        $conn = $my_db->GetConn();
        if (!$conn) {
            return -1;
        }

        $sql = "select * from my_user where phone='$phone' and pwd='$pwd'";
        $res = $my_db->Select($conn, $sql);
        if (sizeof($res) == 1) {
            // var_dump($res[0]);
            $permit = new my_permit();
            $permit->uid = $res[0]->uid;
            $permit->phone = $res[0]->phone;
            $permit->nickName = $res[0]->nick_name;
            $permit->photo = $res[0]->photo;
            $permit->signature = $res[0]->signature;
            $permit->addTime = $res[0]->add_time;
            session_start();
            $_SESSION["permit"] = $permit;
            return 1;
        }
        return 0;
    }

    public function Logout()
    {
        unset($_SESSION['permit']);
    }

    public function CheckUser($phone)
    {
        $my_db = new My_DB();
        $conn = $my_db->GetConn();
        if (!$conn) {
            return -1;
        }

        $sql = "select * from my_user where phone='$phone'";
        $res = $my_db->Select($conn, $sql);
        if (sizeof($res) > 0) {
            return false; // 用户已经存在
        }
        return true; // 用户不存在
    }

    public function AddUser($phone, $pwd)
    {
        $my_db = new My_DB();
        $conn = $my_db->GetConn($phone);
        if (!$conn) {
            return -1;
        }

        $sql = "insert into my_user(phone, pwd) values('$phone', '$pwd')";
        $res = $my_db->Insert($conn, $sql);
        if ($res) {
            // var_dump($conn->affected_rows);
            return $conn->affected_rows;
        }

        // echo $conn->errno . ":" . $conn->error;
        return 0;
    }

    public function GetUsers($key)
    {
        $my_db = new My_DB();
        $conn = $my_db->GetConn();
        if (!$conn) {
            return null;
        }

        $sql = "select * from my_user where 1=1";
        if (strlen($key) > 0) {
            $sql .= " and nick_name like '%$key%'";
        }

        // var_dump($conn);
        return $my_db->Select($conn, $sql);
    }
}
