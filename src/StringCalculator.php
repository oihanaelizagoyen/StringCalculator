<?php

namespace Deg540\PHPTestingBoilerplate;

use function PHPUnit\Framework\isEmpty;

class StringCalculator
{
    public function add (String $inputString) : String
    {
        //explode
        //str_contains
        if ($inputString == ""){
            return "0";
        }
        if (str_contains($inputString, ",")){
            $splitString = explode(",", $inputString);
            $sum = 0;
            for($i = 0; $i < 2; $i++){
                $sum = $sum + (double)$splitString[$i];
            }
            return $sum;
        }
        return $inputString;
    }
}