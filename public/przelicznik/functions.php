<?php
require __DIR__ . '/../../vendor/autoload.php';
use GuzzleHttp\Client;
class CurrencyConverter {
    private $api_url = "http://api.nbp.pl/api/exchangerates/tables/A?format=json";
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }
    
    public function fetchExchangeRates() {
        $client = new Client();
        $response = $client->request('GET', $this->api_url);
        
        return json_decode($response->getBody(), true);
    }

    public function convertToPLN($zloty, $euro, $dolar) {
        $rates = $this->fetchExchangeRates();
        if ($rates) {
            $exchange_rates = $rates[0]['rates'];
    
            // Pobieramy kursy walut
            $pln_rate = 1;
            $euro_rate = $this->findRate($exchange_rates, "EUR");
            $dolar_rate = $this->findRate($exchange_rates, "USD");
    
            // Konwertujemy dane na liczby
            $zloty = floatval($zloty);
            $euro = floatval($euro);
            $dolar = floatval($dolar);
    
            // Sumujemy wartości w złotówkach
            $total_pln = $zloty + ($euro * $euro_rate) + ($dolar * $dolar_rate);
            return round($total_pln,2);
        } else {
            return "Błąd podczas pobierania kursów walut.";
        }
    }

    private function findRate($exchange_rates, $code) {
        foreach ($exchange_rates as $rate) {
            if ($rate['code'] === $code) {
                return $rate['mid'];
            }
        }
        return 0; // Jeśli nie znaleziono kursu
    }

    public function insertToDatabase($imie, $nazwisko, $suma) {
        try {
            $stmt = $this->conn->prepare("INSERT INTO portfel (imie, nazwisko, suma_zloty) VALUES (:imie, :nazwisko, :suma)");
            $stmt->bindParam(':imie', $imie);
            $stmt->bindParam(':nazwisko', $nazwisko);
            $stmt->bindParam(':suma', $suma);
            $stmt->execute();
            echo "Dane zostały pomyślnie dodane do bazy danych.";
        } catch (PDOException $e) {
            echo "Błąd podczas dodawania danych do bazy danych: " . $e->getMessage();
        }
    }

    public function showRecordsFromDatabase() {
        try {
            $stmt = $this->conn->query("SELECT * FROM portfel");
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $rows;
        } catch (PDOException $e) {
            echo "Błąd podczas pobierania danych z bazy danych: " . $e->getMessage();
            return [];
        }
    }
}

