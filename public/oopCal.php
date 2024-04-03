<?php

class Calculator {
    private $num1, $num2;

    public function __construct($num1, $num2) {
        $this->num1 = $num1;
        $this->num2 = $num2;
    }

    public function add(){
        return $this->num1 + $this->num2;
    }

    public function subtract(){
        return $this->num1 - $this->num2;
    }

    public function multiply(){
        return $this->num1 * $this->num2;
    }

    public function divide(){
        return $this->num1 / $this->num2;
    }

    public function square(){
        return $this->num1 ** $this->num2;
    }
}

$result = new Calculator(8,5);

echo "<h1>".$result->add()."</h1>";

$result = new Calculator(2,3);

echo "<h1>".$result->square()."</h1>";