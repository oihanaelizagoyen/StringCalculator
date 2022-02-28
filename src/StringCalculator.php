<?php

namespace Deg540\PHPTestingBoilerplate;

use phpDocumentor\Reflection\Types\Boolean;
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

        for($current_position = 0; $current_position < count($splitString); $current_position++){
            if($splitString[$current_position] == ""){
                if(str_contains($inputString, ",\n")){
                    $position = strpos($inputString,",\n") + 1;
                    $separator = "\\n";
                }
                else{
                    $position = strpos($inputString,"\n,") + 1;
                    $separator = ",";
                }
                return "Number expected but $separator found at position $position.";
            }
            $sum = $sum + (double)$splitString[$current_position];
        }
        return $sum;
    }
}
