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

        if(str_starts_with($inputString, "//")){

            $newlinePosition = strpos($inputString, "\n");
            $characterByCharacter =  $inputString;

            $separators[0] = "";
            for($currentPosition = 2; $currentPosition < $newlinePosition; $currentPosition++){
                $separators[0] = $separators[0] . $characterByCharacter[$currentPosition];
            }

            $inputString = "";
            for($currentPosition = $newlinePosition+1; $currentPosition < strlen($characterByCharacter); $currentPosition++){
                $inputString .= $characterByCharacter[$currentPosition];
            }

            $splitString = explode($separators[0], $inputString);
        }
        else{

            $separators[] = ",";
            $separators[] = "\n";

            $splitString = preg_split("/[,|\n]/", $inputString);
        }

        $sum = 0;

        for($currentPosition = 0; $currentPosition < count($splitString); $currentPosition++){
            if($splitString[$currentPosition] == ""){

                $position = 1;

                while (!($this->isASeparator($inputString[$position-1],$separators) && $this->isASeparator($inputString[$position], $separators))
                        && !($position == (strlen($inputString)-1))){
                    $position++;
                }
                if($position == (strlen($inputString) - 1)){

                    return "Number expected but NOT found.";

                }
                else{
                    if($inputString[$position] == "\n"){
                        $separator = "\\n";
                    }
                    else{
                        $separator = $inputString[$position];
                    }

                    return "Number expected but $separator found at position $position.";

                }
            }
            $sum = $sum + (double)$splitString[$currentPosition];
        }

        return $sum;
    }

    public function isASeparator(String $possibleSeparator, array $separators): bool
    {
        for ($currentPosition = 0; $currentPosition < count($separators); $currentPosition++){
            if($possibleSeparator == $separators[$currentPosition]){

                return true;

            }
        }

        return false;
    }
}