<?php

namespace CarShare;

trait TimeValidation {

    public function validTime($time)
    {
        return ($time >= 0) ? $time : $time = 0;
    }  

}