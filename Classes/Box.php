<?php

namespace Classes;

class Box {

    public $sign;

    public function __construct()
    {
        $this->sign = '';
    }

    public function getSign()
    {
        return $this->sign;
    }

    public function updateSign($sign)
    {
        $this->sign = $sign;
        return $this;
    }
}