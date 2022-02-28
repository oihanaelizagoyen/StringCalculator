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
            $copyOfInputString =  $inputString;

            $separators[0] = "";
            for($currentPosition = 2; $currentPosition < $newlinePosition; $currentPosition++){
                $separators[0] = $separators[0] . $copyOfInputString[$currentPosition];
            }

            $inputString = "";
            for($currentPosition = $newlinePosition+1; $currentPosition < strlen($copyOfInputString); $currentPosition++){
                $inputString .= $copyOfInputString[$currentPosition];
            }

            $splitString = explode($separators[0], $inputString);
        }
        else{

            $separators[] = ",";
            $separators[] = "\n";

            $splitString = preg_split("/[,|\n]/", $inputString);
        }

        $errorMessages = "";
        $negativesChecked = false;
        $sum = 0;

        for($currentPosition = 0; $currentPosition < count($splitString); $currentPosition++){
            if($splitString[$currentPosition] == ""){

                $position = 1;

                while (!($this->isASeparator($inputString[$position-1],$separators) && $this->isASeparator($inputString[$position], $separators))
                        && !($position == (strlen($inputString)-1))){
                    $position++;
                }
                if($position == (strlen($inputString) - 1)){

                    $errorMessages = $this->concatenateErrorMessage($errorMessages, "Number expected but NOT found.");

                }
                else{
                    if($inputString[$position] == "\n"){
                        $separator = "\\n";
                    }
                    else{
                        $separator = $inputString[$position];
                    }

                    $errorMessages = $this->concatenateErrorMessage($errorMessages, "Number expected but '$separator' found at position $position.");

                }
            }
            elseif (!is_numeric($splitString[$currentPosition])){

                $position = 0;

                while(is_numeric($splitString[$currentPosition][$position]) || $splitString[$currentPosition][$position] == "."){
                    $position++;
                }
                $separator = $splitString[$currentPosition][$position];
                $position = $position + strpos($inputString, $splitString[$currentPosition]);

                $errorMessages = $this->concatenateErrorMessage($errorMessages, "'$separators[0]' expected but '$separator' found at position $position.");

            }
            elseif (((double)$splitString[$currentPosition] < 0) && !$negativesChecked){

                $negatives = $splitString[$currentPosition];

                for($position = $currentPosition+1; $position < count($splitString); $position++){
                    if(is_numeric($splitString[$position]) && ($splitString[$position] < 0)){
                        $negatives .= ", " . $splitString[$position];
                    }
                }

                $errorMessages = $this->concatenateErrorMessage($errorMessages, "Negative not allowed : $negatives");

                $negativesChecked = true;

            }
            else{
                $sum = $sum + (double)$splitString[$currentPosition];
            }
        }
        if($errorMessages != ""){

            return $errorMessages;

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


    public function concatenateErrorMessage(String $errorMessages, String $stringToConcatenate):String
    {
        if($errorMessages != ""){
            $errorMessages .= "\n";
        }
        $errorMessages .= $stringToConcatenate;

        return $errorMessages;
    }
}