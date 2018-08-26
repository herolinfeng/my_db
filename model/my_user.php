<?php

header('Content-Type:text/html; charset=UTF-8;');
require "../dll/my_db.php";
require "../dll/my_permit.php";

class My_User
{
    // protected $uid;
    // protected $phone;
    // protected $nickName;
    // protected $photo;
    // protected $signature;
    // protected $add_time;

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

    public function GetSession()
    {
        session_start();
        if (!isset($_SESSION['permit'])) {
            return null;
        }

        return $_SESSION['permit'];
    }

    public function SetSession($uid, $phone)
    {
        $permit = new my_permit();
        $permit->uid = $uid;
        $permit->phone = $phone;
        session_start();
        $_SESSION["permit"] = $permit;
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
            $this->SetSession($res[0]->uid, $res[0]->phone);
            return 1;
        }
        return 0;
    }

    public function Logout()
    {
        session_start();
        unset($_SESSION['permit']);
        return isset($_SESSION['permit']);
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
        if ($res > 0) {
            $this->SetSession($res, $phone);
        }
        return $res;
        // if ($res) {
        //     // var_dump($conn->affected_rows); //返回受影响的行数
        //     return $conn->affected_rows;
        // }

        // // echo $conn->errno . ":" . $conn->error;
        // return 0;
    }

    public function UpdateUser($uid, $photo, $nickName, $signature)
    {
        $my_db = new My_DB();
        $conn = $my_db->GetConn($phone);
        if (!$conn) {
            return -1;
        }

        $sql = "update my_user set photo='$photo', nick_name='$nickName', signature='$signature' where uid=$uid";
        $res = $my_db->Update($conn, $sql);
        return $res;
    }

    public function GetUser($uid)
    {
        $my_db = new My_DB();
        $conn = $my_db->GetConn();
        if (!$conn) {
            return -1;
        }

        $sql = "select uid, phone, nick_name, photo, signature, add_time from my_user where uid=$uid";
        return $my_db->Select($conn, $sql);
    }

    public function GetUserList($key)
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
