<?php
namespace CarShare;

class BaseTariff extends Tariffs 
{
    public function orderMessage()
    {          
        if (AgeValidation::ageCheck($this->_age)) {
            $resultingPrice = self::countPrice() + $this->_gps;
            return ("Базовый тариф: " . $resultingPrice . PHP_EOL);
        }
    }

    protected function countPrice()
    {
        return ($this->_distance * $this->_pricePerKm + $this->_time * $this->_pricePerMinute) * $this->_risky;
    }
}
