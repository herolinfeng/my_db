
<?php

$tmp_name = $_FILES['fileupload']['tmp_name'];
for ($i = 0; $i < count($tmp_name); $i++) {
    $file = md5(uniqid() . rand(1111, 9999));
    $name = $_FILES['fileupload']['name'];
    list($f_name, $f_ext) = explode('.', $name[$i]);
    if (is_uploaded_file($tmp_name[$i])) {
        $filename = './uploads/' . $file . '.' . $f_ext;
        $return = move_uploaded_file($tmp_name[$i], $filename);
        !$return && output('400', $name[$i] . '上传失败！');
    } else {
        output('555', '非法文件！');
    }
}

$return ? output('200', '上传成功！', ['filename' => $filename]) : output('400', '上传失败！');

function output($code, $msg, $datas = array())
{
    $outputData = array(
        'code' => $code,
        'msg' => $msg,
        'datas' => $datas,
    );
    exit(json_encode($outputData));
}