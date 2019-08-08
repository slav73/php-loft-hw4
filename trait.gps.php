<?php

trait Gps {

    public function calcGps($time, $gps)
    {
        return ceil($time / 60) * 15 * $gps;
    }  

}