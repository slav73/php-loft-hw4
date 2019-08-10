<?php

namespace CarShare;

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
            $resultingPrice = self::countPrice() + $this->_gps + $this->_driver;
            return ("Тариф посуточный: " . $resultingPrice . PHP_EOL);
        } 
    }

    protected function countPrice()
    {
        return ($this->_distance * $this->_pricePerKm + $this->_days * $this->_pricePerDay) * $this->_risky;
    }
}
