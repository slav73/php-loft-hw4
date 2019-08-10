<?php

namespace CarShare;

class HourTariff extends BaseTariff 
{
    public function orderMessage()
    {
        $this->_pricePerKm = 0;
        $this->_pricePerHour = 200;
                
        if (AgeValidation::ageCheck($this->_age)) {
            $resultingPrice = self::countPrice() + $this->_gps + $this->_driver;
            return ("Тариф почасовой: " . $resultingPrice . PHP_EOL);
        }    
    }

    protected function countPrice()
    {
        return $this->_hours * $this->_pricePerHour * $this->_risky;
    }
}

