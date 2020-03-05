<?php

namespace App\Utils;

class TimeUtils
{

    /**
     * Check if input time is between $fromTime and $toTime
     * @param int $inputTime
     * @param int $fromTime
     * @param int $toTime
     * @return bool
     */
    public function isTimeBetween($inputTime, $fromTime, $toTime)
    {
        if ($fromTime < $toTime) {
            return $inputTime >= $fromTime && $inputTime <= $toTime;
        }

        return $inputTime >= $fromTime || $inputTime <= $toTime;
    }

}
