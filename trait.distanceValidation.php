<?php

trait DistanceValidation {

    public function validDistance($distance)
    {
        if ($distance < 0) {
            return 0;
        } else return $distance;
    }  

}