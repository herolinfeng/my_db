<?php

header('Content-Type:text/html; charset=UTF-8;');
require "../model/my_user.php";
require "../dll/my_result.php";

class Sign
{
    public function IsLogin()
    {
        $res = new My_Result();
        $user = new My_User();
        if ($user->IsLogin() == 1) {
            $res->id = 100;
            $res->msg = "已登陆";
        } else {
            $res->id = -100;
            $res->msg = "还未登陆";
        }

        die(json_encode($res));
    }

    public function Login($phone, $pwd)
    {
        $res = new My_Result();
        if (strlen($phone . trim()) <= 0 && strlen($phone . trim()) <= 0) {
            $res->id = -101;
            $res->msg = "账号或密码不能为空";
            // die(json_encode($res->Show()));
            die(json_encode($res));
        }

        $user = new My_User();
        $return = $user->Login($phone, $pwd);
        if ($return > 0) {
            $res->id = 100;
            $res->msg = "登陆成功";
        } else {
            $res->id = -102;
            $res->msg = "登陆失败";
        }
        // die(json_encode($res->Show()));
        // var_dump($_SESSION["permit"]);
        die(json_encode($res));
    }

    public function AddUser($phone, $pwd)
    {
        $res = new My_Result();
        if (strlen($phone . trim()) <= 0 && strlen($phone . trim()) <= 0) {
            $res->id = -101;
            $res->msg = "账号或密码不能为空";
            // die(json_encode($res->Show()));
            die(json_encode($res));
        }

        $user = new My_user();
        $check = $user->CheckUser($phone);
        if (!$check) {
            $res->id = -102;
            $res->msg = "该用户已经存在";
        } else {
            $return = $user->AddUser($phone, $pwd);
            if ($return > 0) {
                $res->id = 100;
                $res->msg = "创建用户成功";
            } else {
                $res->id = -103;
                $res->msg = "创建用户失败";
            }
        }
        // die(json_encode($res->Show()));
        die(json_encode($res));
    }
}

// if(!isset($_POST['submit'])){
//     exit('非法访问!');
// }

$act = $_GET["act"];
$phone = $_POST["phone"];
$pwd = $_POST["pwd"];
$sign = new Sign();
switch ($act) {
    case "login":
        $sign->Login($phone, $pwd);
        break;
    case "add":
        $sign->AddUser($phone, $pwd);
        break;
    default:
        $sign->IsLogin();
        break;
}
