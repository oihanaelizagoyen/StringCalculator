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
        return $inputString;
    }
}