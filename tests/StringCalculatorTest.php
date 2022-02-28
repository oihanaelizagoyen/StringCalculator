<?php

namespace Deg540\PHPTestingBoilerplate\Test;

use Deg540\PHPTestingBoilerplate\StringCalculator;
use PHPUnit\Framework\TestCase;

class StringCalculatorTest extends TestCase
{
    /**
     * @test
     */
    public function empty_string_returns_string_0()
    {
        $stringCalculator = new StringCalculator();

        $returnedString = $stringCalculator->add("");

        $this->assertEquals("0", $returnedString);
    }

    /**
     * @test
     */
    public function one_number_string_returns_same_string()
    {
        $stringCalculator = new StringCalculator();

        $returnedString = $stringCalculator->add("1");

        $this->assertEquals("1", $returnedString);
    }

    /**
     * @test
     */
    public function two_numbers_string_returns_sum_string()
    {
        $stringCalculator = new StringCalculator();

        $returnedString = $stringCalculator->add("1.1,2.2");

        $this->assertEquals("3.3", $returnedString);
    }
}
