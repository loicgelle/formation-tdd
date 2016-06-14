<?php

include('src/StringCalculator.php');

class StringCalculatorTest extends PHPUnit_Framework_TestCase {

    public function testAddZero() {
        $testStr = "";
        $this->assertEquals(0, StringCalculator::add($testStr));
    }

    public function testAddOne() {
        $testStr = "2";
        $this->assertEquals(2, StringCalculator::add($testStr));
    }

    public function testAddTwo() {
        $testStr = "2,4";
        $this->assertEquals(6, StringCalculator::add($testStr));
    }

    public function testMultipleDelimiters() {
        $testStr = "2,4\n3";
        $this->assertEquals(9, StringCalculator::add($testStr));
    }

    public function testNegativeHandling() {
        $testStr = "3,-1,2,-3";
        $exceptionCaught = false;
        try {
            StringCalculator::add($testStr);
        }
        catch (Exception $e) {
            $exceptionCaught = true;
            $this->assertEquals("negatives non allowed: -1, -3", $e->getMessage());
        }
        $this->assertEquals(true, $exceptionCaught);
    }

    public function testBigNumbers() {
        $testStr = "3,1002,5";
        $this->assertEquals(8, StringCalculator::add($testStr));
    }

    public function testAheadDelimiter() {
        $testStr = "//[***]\n1***2***3";
        $this->assertEquals(6, StringCalculator::add($testStr));
    }

    public function testAheadMultipleDelimiters() {
        $testStr = "//[**][%]\n1**2%3";
        $this->assertEquals(6, StringCalculator::add($testStr));
    }

}
?>
