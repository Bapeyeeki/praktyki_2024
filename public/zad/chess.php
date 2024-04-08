<?php

require __DIR__ . '/../../vendor/autoload.php';

$fen = new Onspli\Chess\FEN;
echo $fen->preview() . '<br />';

$preview = $fen->preview();

$fen->move('e4');

echo $fen->preview();

print_r($fen->get_legal_moves());
