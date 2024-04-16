<?php
class GameSummary {
    private $score;

    function __construct($score) {
        $this->score = $score;
    }

    public function generateSummary() {
        $summary = '';
        if ($this->score == 10) {
            $summary = "Gratulacje! Geniusz!";
        } elseif ($this->score >= 8) {
            $summary = "Gratulacje! Świetnie Ci poszło!";
        } elseif ($this->score >= 5) {
            $summary = "Dobrze Ci poszło, ale można lepiej!";
        } else {
            $summary = "Może następnym razem będzie lepiej!";
        }
        return $summary;
    }
}