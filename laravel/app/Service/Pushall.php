<?php


namespace App\Service;


class Pushall
{
    protected $url = "https://pushall.ru/api.php";

    private $apiKey;
    private $id;

    public function __construct($apiKey,$id)
    {
        $this->id = $id;
        $this->apiKey = $apiKey;
    }

    public function send($text, $title) {
        $data = [
            'type' => 'self',
            'id' => $this->id,
            'key' => $this->apiKey,
            'text' => $text,
            'title' => "$title"
        ];
        //biblateka guzzle
        $client = new \GuzzleHttp\Client(['base_uri' => $this->url]);

        return $client->post('', ['form_params' => $data]);

        //pushall service
//        curl_setopt_array($ch = curl_init(), [
//            CURLOPT_URL => $this->url,
//            CURLOPT_POSTFIELDS => $data,
//            CURLOPT_RETURNTRANSFER => true
//        ]);
//        $result = curl_exec($ch); //получить ответ или ошибку
//        curl_close($ch);
//
//        return $result;
    }


}
