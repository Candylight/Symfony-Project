<?php

namespace AppBundle\Services;

/**
 * Created by PhpStorm.
 * User: sylva
 * Date: 05/02/2017
 * Time: 15:50
 */
class GeocodingFunctions
{

    private $apiKey;

    /**
     * GeocodingFunctions constructor.
     *
     * @param string $apiKey
     */
    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function getGeocode($address)
    {
        $fields = array(
            "address" => $address,
            "key" => $this->apiKey
        );

        $ch = curl_init();

        curl_setopt($ch,CURLOPT_URL,"https://maps.googleapis.com/maps/api/geocode/json?address=".str_replace(' ', '+', $address)."&key=".$this->apiKey);
        curl_setopt($ch,CURLOPT_HTTPHEADER,array("Accept: application/json","Accept-Language: fr_FR"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close($ch);

        $parseResults = json_decode($result,true);
        if($parseResults['status'] == "OK")
        {
            return $parseResults['results'][0]['geometry']['location'];
        }
        else
        {
            return false;
        }
    }
}