<?php

namespace Classes;

class Player {

    private $name;
    protected $status;

    public function __construct($name)
    {
        $this->name = $name;
        $this->status = 0;
    }

    public function getName()
    {
        return $this->name;
    }
    
    public function getStatus()
    {
        if ($this->status == 0) {
            return 'Loser';
        }
        else {
            return 'Winner';
        }
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

}