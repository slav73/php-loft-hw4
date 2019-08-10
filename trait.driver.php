<?php

namespace CarShare;

trait Driver {

    public function addDriver($driver)
    {
        return ($driver > 0) ? 100 : 0;
    }  

}