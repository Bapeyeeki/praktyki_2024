<?php
require __DIR__ . '/../../vendor/autoload.php';

use Carbon\Carbon;

// Klucz API Bing Maps
$bing_maps_api_key = "AikRLMqT-X0vxfShlWl5_2o_s1COfj1RzNP3fTn9mN00VxeS7EJa9jXwGCXXc602";

// URL do endpointa API Bing Maps
$bing_maps_api_url = "https://dev.virtualearth.net/REST/v1/Routes/Driving";

// Funkcja do wysyłania żądania HTTP GET do Bing Maps API
function getRouteDuration($start, $end, $apiKey) {
    global $bing_maps_api_url;

    $startEncoded = urlencode($start);
    $endEncoded = urlencode($end);

    $requestUrl = "$bing_maps_api_url?wp.0=$startEncoded&wp.1=$endEncoded&key=$apiKey";

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $requestUrl,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_CUSTOMREQUEST => "GET",
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        return "Błąd podczas pobierania danych: " . $err;
    } else {
        $responseData = json_decode($response, true);
        $travelDurationInSeconds = $responseData["resourceSets"][0]["resources"][0]["travelDurationTraffic"];
        
        // Utwórz obiekt CarbonInterval z czasem podróży w sekundach
        $travelDuration = Carbon::now()->addSeconds($travelDurationInSeconds)->setTimezone('Europe/Warsaw');
        
        // Zwróć sformatowany czas podróży (H:i)
        return $travelDuration->format('H:i');
    }
}



