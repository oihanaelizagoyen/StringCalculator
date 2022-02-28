<?php

namespace Deg540\PHPTestingBoilerplate\Test;

use Deg540\PHPTestingBoilerplate\StringCalculator;
use PHPUnit\Framework\TestCase;

class StringCalculatorTest extends TestCase
{
    private StringCalculator $stringCalculator;

    /**
     * @setUp
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->stringCalculator = new StringCalculator();
    }

    /**
     * @test
     */
    public function empty_string_returns_string_0()
    {
        $returnedString = $this->stringCalculator->add("");

        $this->assertEquals("0", $returnedString);
    }

    /**
     * @test
     */
    public function one_number_string_returns_same_string()
    {
        $returnedString = $this->stringCalculator->add("1");

        $this->assertEquals("1", $returnedString);
    }

    /**
     * @test
     */
    public function two_numbers_string_returns_sum_string()
    {
        $returnedString = $this->stringCalculator->add("1.1,2.2");

        $this->assertEquals("3.3", $returnedString);
    }

    /**
     * @test
     */
    public function string_with_unknown_number_of_numbers_returns_sum_string()
    {
        $returnedString = $this->stringCalculator->add("1.1,2.2,1.1,2.2");

        $this->assertEquals("6.6", $returnedString);
    }

    /**
     * @test
     */
    public function string_with_newline_as_separator_returns_sum_string()
    {
        $returnedString = $this->stringCalculator->add("1\n2,3");

        $this->assertEquals("6", $returnedString);
    }

    /**
     * @test
     */
    public function string_with_separator_instead_of_number_returns_error_message()
    {
        $returnedString = $this->stringCalculator->add("175.2,\n35");

        $this->assertEquals("Number expected but \\n found at position 6.", $returnedString);
    }

    /**
     * @test
     */
    public function string_ended_in_separator_returns_error_message()
    {
        $returnedString = $this->stringCalculator->add("1,3,");

        $this->assertEquals("Number expected but NOT found.", $returnedString);
    }

    /**
     * @test
     */
    public function string_with_new_separator_returns_sum_string()
    {
        $returnedString = $this->stringCalculator->add("//;\n1;2");

        $this->assertEquals("3", $returnedString);
    }

    /**
     * @test
     */
    public function string_with_new_separator_but_uses_default_separators_returns_error_message()
    {
        $returnedString = $this->stringCalculator->add("//|\n1|2,3");

        $this->assertEquals("'|' expected but ',' found at position 3.", $returnedString);
    }

    /**
     * @test
     */
    public function string_with_negative_numbers_returns_error_message()
    {
        $returnedString = $this->stringCalculator->add("2,-4,-5");

        $this->assertEquals("Negative not allowed : -4, -5", $returnedString);
    }
}
