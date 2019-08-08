<?php

include("interface.price.php");
include("trait.ageValidation.php");
include("trait.timeValidation.php");
include("trait.distanceValidation.php");
include("trait.gps.php");
include("trait.driver.php");

abstract class Tariffs implements Price
{
    protected $_pricePerKm = 10;
    protected $_pricePerMinute = 3;
    
    protected $_age;
    protected $_distance;
    protected $_time;
    protected $_risky = 1;
    protected $_gps;
    protected $_driver;
    
    public function __construct($distance = 0, $time = 0, $age = 18, $gps = 1, $driver = 0)
    {
        $this->_distance = $distance;
        $this->_time = $time;
        $this->_age = $age;
        $this->_gps = $gps;
        $this->_driver = $driver;
        
        if ($this->_age <= self::RISKY_AGE) $this->_risky = 1.1;
    }
    
    abstract public function orderMessage();

}

class BaseTariff extends Tariffs 
{
    use AgeValidation, TimeValidation, DistanceValidation, Gps, Driver;

    public function orderMessage()
    {   
        $this->_time = TimeValidation::validTime($this->_time);
        $this->_distance = DistanceValidation::validDistance($this->_distance);
        
        if (AgeValidation::ageCheck($this->_age)) {
            $resultingPrice = self::countPrice() + Gps::calcGps($this->_time, $this->_gps);
            return ("Базовый тариф: " . $resultingPrice . PHP_EOL);
        }
    }

    protected function countPrice()
    {
        return ($this->_distance * $this->_pricePerKm + $this->_time * $this->_pricePerMinute) * $this->_risky;
    }
}

class HourTariff extends BaseTariff 
{
    protected $_hourTime;

    public function orderMessage()
    {
        $this->_pricePerKm = 0;
        $this->_pricePerHour = 200;
        $this->_hourTime = ceil($this->_time / self::HOUR);
        
        if (AgeValidation::ageCheck($this->_age)) {
            $resultingPrice = self::countPrice() + Gps::calcGps($this->_time, $this->_gps) + Driver::addDriver($this->_driver);
            return ("Тариф почасовой: " . $resultingPrice . PHP_EOL);
        }    
    }

    protected function countPrice()
    {
        return $this->_hourTime * $this->_pricePerHour * $this->_risky;
    }
}

class DayTariff extends BaseTariff 
{
    protected $_days; 
    
    public function orderMessage()
    {
        $this->_pricePerKm = 1;
        $this->_pricePerDay = 1000;
        if (abs(self::DAY - ($this->_time % self::DAY)) <= 30 || $this->_time > self::DAY) {
            $this->_days = round($this->_time / self::DAY);
        } else {
            $this->_days = ceil($this->_time / self::DAY);
        }
        $this->_pricePerKm = 1;

        if (AgeValidation::ageCheck($this->_age)) {
            $resultingPrice = self::countPrice() + Gps::calcGps($this->_time, $this->_gps) + Driver::addDriver($this->_driver);
            return ("Тариф посуточный: " . $resultingPrice . PHP_EOL);
        } 
    }

    protected function countPrice()
    {
        return ($this->_distance * $this->_pricePerKm + $this->_days * $this->_pricePerDay) * $this->_risky;
    }
}

class StudentTariff extends BaseTariff 
{
    public function orderMessage()
    {
        $this->_pricePerKm = 4;
        $this->_pricePerMinute = 1;

        if ($this->_age > 25) {
            return ("Ваш возраст не соответствует данному тарифу. Выберите другой тариф!");
        } else {
            $resultingPrice = self::countPrice() + Gps::calcGps($this->_time, $this->_gps);
            return ("Тариф студенческий: " . $resultingPrice . PHP_EOL);
        }
    }
}