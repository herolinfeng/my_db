<?php

header('Content-Type:text/html; charset=UTF-8;');
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);

class My_DB
{
    protected $host = "127.0.0.1";
    protected $name = 'root';
    protected $pwd = '123456';
    protected $db = 'my_db';

    public function GetConn()
    {
        $conn = new mysqli($this->host, $this->name, $this->pwd, $this->db);

        if ($conn->connect_errno) {
            // var_dump(mysqli_connect_error());
            return null;
        }

        //设置字符集
        $conn->set_charset('utf8');

        return $conn;
    }

    public function Select($conn, $sql)
    {
        $result = $conn->query($sql);
        // var_dump($result);
        while ($result && $row = $result->fetch_object()) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function Insert($conn, $sql)
    {
        $result = $conn->query($sql);
        if ($result) {
            return $conn->insert_id;
        } else {
            return 0;
        }

        // return $result; // bool
    }

    public function Update($conn, $sql)
    {
        $result = $conn->query($sql);
        return $result; // bool
    }

    public function Delete($conn, $sql)
    {

    }

    public function Close($conn)
    {
        $conn->close();
    }
}
