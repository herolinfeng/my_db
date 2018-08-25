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

class sum
{
    protected $num1;
    protected $num2;
    public function num($n1, $n2)
    {
        $this->num1 = $n1;
        $this->num2 = $n2;
        return $this;
    }
}

$obj = new sum();
echo json_encode($obj->num(1, 2));
var_dump($obj->num(1,2));
