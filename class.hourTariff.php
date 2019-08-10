<?php

namespace CarShare;

class HourTariff extends BaseTariff 
{
    protected $_hourTime;

    public function orderMessage()
    {
        $this->_pricePerKm = 0;
        $this->_pricePerHour = 200;
        $this->_hourTime = ceil($this->_time / self::HOUR);
        
        if (AgeValidation::ageCheck($this->_age)) {
            $resultingPrice = self::countPrice() + $this->_gps + Driver::addDriver($this->_driver);
            return ("Тариф почасовой: " . $resultingPrice . PHP_EOL);
        }    
    }

    protected function countPrice()
    {
        return $this->_hourTime * $this->_pricePerHour * $this->_risky;
    }
}

