<?php
namespace CarShare;

class BaseTariff extends Tariffs 
{
    
    public function orderMessage()
    {          
        $this->_driver = 0;
        if (AgeValidation::ageCheck($this->_age)) {
            $this->_resultingPrice = self::countPrice() + $this->_gps + $this->_driver;
        }
        return ("Базовый тариф: " . $this->_resultingPrice . PHP_EOL);
    }

    protected function countPrice()
    {
        return ($this->_distance * $this->_pricePerKm + $this->_time * $this->_pricePerMinute) * $this->_risky;
    }
}
