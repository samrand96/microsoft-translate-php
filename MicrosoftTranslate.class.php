<?php

namespace samrand\MicrosoftTranslatePHP;

class MicrosoftTranslate {

    private $client;
    private $key;
    private $location;
    private $translate_api;
    private $translate_key;
    private $translate_location;
    private $translate_version;
    private $translate_to;
    private $translate_from;
    private $translate_text;

    function __construct($key,$location){
        $this->key = $key;
        $this->location = $location;
        $this->translate_api = 'https://api.cognitive.microsofttranslator.com/translate?api-version=3.0&to=';
        $this->translate_key = $key;
        $this->translate_location = $location;
        $this->translate_version = '3.0';
        $this->translate_to = 'ku';
        $this->translate_from = 'en';
        $this->translate_text = '';
    }

    public function set_translate_to($to){
        $this->translate_to = $to;
    }

    public function set_translate_from($from){
        $this->translate_from = $from;
    }

    public function set_translate_text($text){
        $this->translate_text = $text;
    }

    public function translate(){
        $client = new GuzzleHttp\Client();
        $response = $client->request('POST', $this->translate_api . $this->translate_to, [
            'headers' => [
                'Ocp-Apim-Subscription-Key' => $this->translate_key,
                'Ocp-Apim-Subscription-Region' => $this->translate_location,
                'Content-Type' => 'application/json'
            ],
            'json' => [
                ['text' => $this->translate_text]
            ]
        ]);
        return json_decode($response->getBody())[0]->translations[0]->text;
    }

    public function translate_array($array){
        $client = new GuzzleHttp\Client();
        $response = $client->request('POST', $this->translate_api . $this->translate_to, [
            'headers' => [
                'Ocp-Apim-Subscription-Key' => $this->translate_key,
                'Ocp-Apim-Subscription-Region' => $this->translate_location,
                'Content-Type' => 'application/json'
            ],
            'json' => [ 'texts' => $array  ]
        ]);
        return json_decode($response->getBody())->translations;
    }

    public function translate_array_to_array($array,$to){
        $client = new GuzzleHttp\Client();
        $response = $client->request('POST', $this->translate_api . $to, [
            'headers' => [
                'Ocp-Apim-Subscription-Key' => $this->translate_key,
                'Ocp-Apim-Subscription-Region' => $this->translate_location,
                'Content-Type' => 'application/json'
            ],
            'json' => [ 'texts' => $array ]
        ]);
        return json_decode($response->getBody())->translations;
    }

    public function translate_array_to_array_from_array($array,$to,$from){
        $client = new GuzzleHttp\Client();
        $response = $client->request('POST', $this->translate_api . $to, [
            'headers' => [
                'Ocp-Apim-Subscription-Key' => $this->translate_key,
                'Ocp-Apim-Subscription-Region' => $this->translate_location,
                'Content-Type' => 'application/json'
            ],
            'json' => [ 'texts' => $array  ]
        ]);
        return json_decode($response->getBody());
    }

    public function set_translate_text_array($array){
        $this->translate_text = $array;
    }


}
