<?php

namespace CarShare;

interface Price
{
    const MIN_AGE = 18;
    const MAX_AGE = 65;
    const RISKY_AGE = 21;
    const MINUTE = 1;
    const HOUR = 60 * self::MINUTE;
    const DAY = 24 * self::HOUR;
}