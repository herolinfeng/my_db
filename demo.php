<?php

// class MyObj
// {
//     public $body;
//     public $id;
//     public $approved;
//     public $favorite_count;
//     public $status;
// }

// $obj = new MyObj();
// $obj->body           = 'another post';
// $obj->id             = 21;
// $obj->approved       = true;
// $obj->favorite_count = 1;
// $obj->status         = NULL;
// echo json_encode($obj);

// class sum
// {
//     protected $num1;
//     protected $num2;
//     public function num($n1, $n2)
//     {
//         $this->num1 = $n1;
//         $this->num2 = $n2;
//         return $this;
//     }
// }

// $obj = new sum();
// echo json_encode($obj->num(1, 2));
// var_dump($obj->num(1,2));

//session_start();必须位于<html>标签之前
session_start();
$_SESSION['view'] = 4;
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
// put your code here
echo 'session的id为：' . session_id() . '<br>';
if (session_destroy()) {
    echo "清除成功！" . "<br>";
    echo 'session的id为：' . session_id() . '<br>';
    echo 'Views1 = ' . $_SESSION['view'] . '<br>';
    unset($_SESSION['view']);
    var_dump($_SESSION['view']);
    echo 'Views2 = ' . $_SESSION['view'];
} else {
    unset($_SESSION['view']);
    var_dump($_SESSION['view']);
    echo 'Views2 = ' . $_SESSION['view'];
}

?>
    </body>
</html>