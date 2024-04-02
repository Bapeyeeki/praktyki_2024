<?php
// Popraw kod tak, aby w tablicę data, indeks result wpisały się poprawne pola prostokątów.
// Klasa Detail musi dziedziczyć pola $a i $b z klasy Base, a liczenie odbywać się w metodzie calculate w klasie Detail
// Poniżej linii 50 jest sprawdzenie poprawności, nie można modyfikować

class Base {

    protected $a;
    protected $b;

    public function __construct($a, $b) {
        $this->a = $a;
        $this->b = $b;
    }

}
class Detail extends Base {

    public function __construct($a, $b) {
        parent::__construct($a, $b);
    }

    public function calculate() {
        return $this->a * $this->b;
    }

}
$data = [
    ['a' => 5, 'b' => 6, 'result' => null],
    ['a' => 3, 'b' => 2, 'result' => null],
    ['a' => 2, 'b' => 4, 'result' => null],
    ['a' => 1, 'b' => 4, 'result' => null],
    ['a' => 7, 'b' => 2, 'result' => null],
];

foreach($data as &$object) {
    $detail = new Detail($object['a'], $object['b']);
    $object['result'] = $detail->calculate();
}


// Sprawdzenie poprawności. Kod poniżej nie może być modyfikowany
$dataOriginal = [
    ['a' => 5, 'b' => 6, 'result' => 30],
    ['a' => 3, 'b' => 2, 'result' => 6],
    ['a' => 2, 'b' => 4, 'result' => 8],
    ['a' => 1, 'b' => 4, 'result' => 4],
    ['a' => 7, 'b' => 2, 'result' => 14],
];

echo $dataOriginal === $data ? 'Poprawny wynik' : 'Niepoprawny wynik';