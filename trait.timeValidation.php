<?php

trait TimeValidation {

    public function validTime($time)
    {
        if ($time < 0) {
            return 0;
        } else return $time;
    }  

}