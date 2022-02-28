<?php

namespace Deg540\PHPTestingBoilerplate;

use function PHPUnit\Framework\isEmpty;

class StringCalculator
{
    public function add (String $inputString) : String
    {
        if ($inputString == ""){
            return "0";
        }
        $splitString = preg_split("/[,|\n]/", $inputString);
        $sum = 0;
        for($i = 0; $i < count($splitString); $i++){
            $sum = $sum + (double)$splitString[$i];
        }
        return $sum;
    }
}