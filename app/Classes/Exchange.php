<?php

namespace App\Classes;

class Exchange
{
    public $url = 'https://api.privatbank.ua/p24api/pubinfo?exchange&coursid=5';

    public function getExchange()
    {
        $curl = curl_init($this->url);
        if($curl)
        {
            curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
            $result = curl_exec($curl);

            curl_close($curl);
            unset($curl);
        }
        $xml = new \SimpleXMLElement($result);
        $sale = $xml->row['2']->exchangerate['sale'];
        return rtrim($sale, 0);
    }
}