<?php
class TriviaAPI
{
    private $url;

    public function __construct($url)
    {
        $this->url = $url;
    }

    public function getQuestions($amount = 10, $category = null)
    {
        $url = $this->url . "?amount=" . $amount;
        if ($category !== null) {
            $url .= "&category=" . urlencode($category);
        }

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);

        $data = json_decode($response, true);
        return isset($data['results']) ? $data['results'] : null;
    }
}