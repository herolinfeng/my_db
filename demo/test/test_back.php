<?php
//print_r($_POST);
//print_r($_FILES);
// var_dump($_FILES["fileupload"]);
$ary = array();
if ($_FILES["fileupload"]["error"] > 0) {
    $ary['jg'] = '上传附件有问题，有可能没有附件';
    echo json_encode($ary);
    exit();
}

$path = "./upload_file/";

$name = $_FILES["fileupload"]['name'];
//附件上传
if (move_uploaded_file($_FILES["fileupload"]['tmp_name'], iconv("UTF-8", "GBK", $path . $name))) {
    $ary['jg'] = "上传成功";
    $ary['name'] = $path . $name;
} else {
    $ary['jg'] = "上传失败";
}
echo json_encode($ary);
