<?php

header('Content-Type:text/html; charset=UTF-8;');
require "../model/my_user.php";
require "../dll/my_result.php";

class Edit
{
    public function GetUser()
    {
        // $res = new My_Result();
        // if ($id <= 0) {
        //     $res->id = -101;
        //     $res->msg = "请勿非法操作";
        //     die(json_encode($res));
        // }
        $res = new My_Result();
        $user = new My_user();
        $session = $user->GetSession();
        // var_dump($session);
        if (!isset($session)) {
            $res->id = -100;
            $res->msg = "还未登陆";
            die(json_encode($res));
        }
        $info = $user->GetUser($session->uid);
        $res->id = 100;
        $res->msg = "获取用户信息成功";
        $res->obj = $info;
        // var_dump($res);
        die(json_encode($res));
    }

    public function Update($photo, $nickName, $signature)
    {
        $res = new My_Result();
        $user = new My_user();
        $session = $user->GetSession();
        // var_dump($session);
        if (!isset($session)) {
            $res->id = -100;
            $res->msg = "还未登陆";
            die(json_encode($res));
        }
        $uid = $session->uid;
        $back = $user->UpdateUser($uid, $photo, $nickName, $signature);
        if ($back) {
            $res->id = 100;
            $res->msg = "更新成功";
        } else {
            $res->id = -101;
            $res->msg = "更新失败";
        }
        die(json_encode($res));
    }
}

$edit = new Edit();
$act = $_GET["act"];
if ($act == "edit") {
    $photo = $_POST["photo"];
    $nickName = $_POST["nick_name"];
    $signature = $_POST["signature"];
    $res = $edit->Update($photo, $nickName, $signature);
} else {
    $edit->GetUser();
}
