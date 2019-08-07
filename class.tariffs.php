<?php

include("interface.price.php");

abstract class Tariffs implements Price
{
    protected $_pricePerKm = 10;
    protected $_pricePerMinute = 3;
    
    protected $_age;
    protected $_distance;
    protected $_time;
    protected $_risky = 1;
    
    public function __construct($distance = 0, $time = 0, $age = 18)
    {
        $this->_distance = $distance;
        $this->_time = $time;
        $this->_age = $age;
        
        if ($this->_age <= self::RISKY_AGE) $this->_risky = 1.1;
    }
    
    abstract public function validAge($age);

    abstract public function countPrice();

}

class BaseTariff extends Tariffs 
{
    public function validAge($age)
    {
        if ($age < 18) {
            throw new Exception("Мы не предоставляем авто лицам моложе 18 лет!");
        }
    }

    public function countPrice()
    {   
        try {
            $this->validAge($this->_age);
        } catch (Exception $e) {
            echo $e->getMessage() . PHP_EOL;
            return false;
        }

        return ("Базовый тариф: " . (($this->_distance * $this->_pricePerKm + $this->_time * $this->_pricePerMinute) * $this->_risky) . PHP_EOL);
    }
}

class HourTariff extends BaseTariff 
{
    public function countPrice()
    {
        try {
            $this->validAge($this->_age);
        } catch (Exception $e) {
            echo $e->getMessage() . PHP_EOL;
            return false;
        }
        $this->_pricePerKm = 0;
        $this->_time = ceil($this->_time / self::HOUR);
        return ("Тариф почасовой: " . (($this->_time * 200) * $this->_risky) . PHP_EOL);
    }
}

// class DayTariff extends Tariffs 
// {
//     public function countPrice()
//     {
//         $this->_pricePerKm = 1;

//     }
// }

// class StudentTariff extends Tariffs 
// {

// }