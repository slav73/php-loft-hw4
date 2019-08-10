<?php
namespace CarShare;

trait Gps {

    public function calcGps($hours, $gps)
    {
        return ($gps > 0) ? ceil($hours * 15) : 0;
    }  

}