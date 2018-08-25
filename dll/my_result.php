<?php

class My_Result {
    public $id;
    public $msg;

    public function Show() {
        return array($this->id, $this->msg);
    }
}