<?php

class my_result
{
    public $id;
    public $msg;
    public $obj;
}

$res = new my_result();
if (isset($_FILES["upFile"]) && $_FILES["upFile"]["error"] == UPLOAD_ERR_OK) {
    $UploadDirectory = 'uploads/';

    if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
        $res->id = -101;
        $res->msg = "HTTP_X_REQUESTED_WITH";
        die(json_encode($res));
    }

    if ($_FILES["upFile"]["size"] > 10 * 1024 * 1024) {
        $res->id = -102;
        $res->msg = "File size is too big!";
        die(json_encode($res));
    }

    switch (strtolower($_FILES['upFile']['type'])) {
        case 'image/png':
        case 'image/gif':
        case 'image/jpeg':
        case 'image/pjpeg':
        case 'text/plain':
        case 'text/html':
        case 'application/x-zip-compressed':
        case 'application/pdf':
        case 'application/msword':
        case 'application/vnd.ms-excel':
        case 'video/mp4':
            break;
        default:
            $res->id = -103;
            $res->msg = "Unsupported File!";
            die(json_encode($res));
    }

    $File_Name = strtolower($_FILES['upFile']['name']);
    $File_Ext = substr($File_Name, strrpos($File_Name, '.'));
    $Random_Number = rand(0, 9999999999);
    $NewFileName = $Random_Number . $File_Ext;

    if (move_uploaded_file($_FILES['upFile']['tmp_name'], $UploadDirectory . $NewFileName)) {
        $res->id = 100;
        $res->msg = $UploadDirectory . $NewFileName;
        die(json_encode($res));
    } else {
        $res->id = -104;
        $res->msg = "error uploading File!";
        die(json_encode($res));
    }
} else {
    $res->id = -100;
    $res->msg = 'Something wrong with upload! Is "upload_max_filesize" set correctly?';
    die(json_encode($res));
}
