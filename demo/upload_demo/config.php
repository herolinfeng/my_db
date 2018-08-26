<?php
function uploadfile($myupfile, $arr_mime, $dir)
{
    if ($myupfile['error']) {
        switch ($myupfile['error']) {
            case '1':
                echo '文件大小比php.ini中upload_max_filesize指定值要大';
                break;
            case '2':
                echo '文件的小比表单的MAX_FILE_SIZE指定的值大';
                break;
            case '3':
                echo '文件上传不完整（可能因为请求时间过长被终止）';
                break;
            case '4':
                echo '没有文件随着这个请求上传';
                break;
            default:
                echo '未知错误';
                break;
        }
    }
    $ext = substr($myupfile['name'], strrpos($myupfile['name'], '.'));
    // $name = date('YmdHis').'-'.mt_rand(1000,9999).$ext;
    $name = date('YmdHis') . '-' . uniqid() . $ext;
    $dir_name = $dir . $name;
    if (!is_uploaded_file($myupfile['tmp_name'])) {
        echo '上传有错误，请重新上传！';
    } else {
        $fs = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($fs, $myupfile['tmp_name']);
        if (in_array($mime, $arr_mime)) {
            if (move_uploaded_file($myupfile['tmp_name'], $dir_name)) {
                echo "上传成功！";
            } else {
                echo '上传失败！';
            }
        } else {
            echo '文件类型不正确，请重新上传';
        }
    }
}
