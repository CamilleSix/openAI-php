<?php
// check if curl is activated in phpIni


class openIA{

    private $api_key ;
    public $model = "text-davinci-003" ;
    public $prompt ;
    public $temperature = 0.3 ;
    public $max_tokens = 150 ;
    public $top_p = 1.0 ;
    public $frequency_penalty = 0.0 ;
    public $presence_penalty = 0.0 ;


    public function __construct()
    {
        $this->api_key = file_get_contents('../api-key.txt') ;
        // create à file with the sk key in the root directory

    }

    public function setPrompt($question){
        $this->prompt = $question ;
    }

    public function sendRequest(){

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/completions');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);

        $data = [
            "model"=>$this->model,
            "prompt"=> $this->prompt,
            "temperature"=>$this->temperature,
            "max_tokens"=> $this->max_tokens,
            "top_p"=>$this->top_p,
            "frequency_penalty"=> $this->frequency_penalty,
            "presence_penalty"=> $this->presence_penalty
        ] ;
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: _ENV["Bearer '.$this->api_key.'"]';

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo "Error:" . curl_error($ch);
        }
        curl_close($ch);

        return $result ;
    }


}


