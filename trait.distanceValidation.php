<?php

namespace CarShare;

trait DistanceValidation {

    public function validDistance($distance)
    {
        return ($distance >= 0) ? $distance : $distance = 0;
    }  

}