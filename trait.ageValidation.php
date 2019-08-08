<?php

trait AgeValidation {

    public function validAge($age)
    {
        if ($age < 18) {
            throw new Exception("Мы не предоставляем авто лицам моложе 18 лет!");
        }
    }  

    public function ageCheck($age) 
    {
        try {
            self::validAge($age);
            return true;
        } catch (Exception $e) {
            echo $e->getMessage() . PHP_EOL;
            return false;
        }
    }

}