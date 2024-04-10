<?php
require __DIR__ . '/../../vendor/autoload.php';

use GuzzleHttp\Client;
use Carbon\Carbon;

// Klucz API Bing Maps
$bing_maps_api_key = "AikRLMqT-X0vxfShlWl5_2o_s1COfj1RzNP3fTn9mN00VxeS7EJa9jXwGCXXc602";

// URL do endpointa API Bing Maps
$bing_maps_api_url = "https://dev.virtualearth.net/REST/v1/Routes/Driving";

// Funkcja do wysyłania żądania HTTP GET do Bing Maps API
function getRouteDuration($start, $end, $apiKey) {
    global $bing_maps_api_url;

    $client = new Client();

    $startEncoded = urlencode($start);
    $endEncoded = urlencode($end);

    $requestUrl = "$bing_maps_api_url?wp.0=$startEncoded&wp.1=$endEncoded&key=$apiKey";

    try {
        $response = $client->request('GET', $requestUrl);
        $responseData = json_decode($response->getBody(), true);
        $travelDurationInSeconds = $responseData["resourceSets"][0]["resources"][0]["travelDurationTraffic"];
        
        // Utwórz obiekt CarbonInterval z czasem podróży w sekundach
        $travelDuration = Carbon::now()->addSeconds($travelDurationInSeconds)->setTimezone('Europe/Warsaw');
        
        // Zwróć sformatowany czas podróży (H:i)
        return $travelDuration->format('H:i');
    } catch (Exception $e) {
        return "Błąd podczas pobierania danych: " . $e->getMessage();
    }
}