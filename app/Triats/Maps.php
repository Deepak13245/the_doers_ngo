<?php
/**
 * Created by PhpStorm.
 * User: deepak
 * Date: 17/2/18
 * Time: 2:26 PM
 */

namespace App\Triats;


use Exception;
use GuzzleHttp\Client;

trait Maps
{
    /**
     * @param $address
     * @return mixed
     * @throws Exception
     */
    public function getMapLL($address)
    {
        $client = new Client();
        $result = $client->get('https://maps.googleapis.com/maps/api/geocode/json?address=' . htmlentities($address) . '&key=' . config('app.map_key'));
        if ($result->getStatusCode() != 200)
            throw new Exception('Try again later');
        $result = json_decode($result->getBody()->getContents());
        if (count($result->results) < 1) {
            throw new Exception('Not able to verify address');
        }
        $location = $result->results[0]->geometry->location;
        return $location;

    }

    public function getMapDistance(
        $latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371)
    {
        // convert from degrees to radians
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);

        $lonDelta = $lonTo - $lonFrom;
        $a = pow(cos($latTo) * sin($lonDelta), 2) +
            pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
        $b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);

        $angle = atan2(sqrt($a), $b);
        return $angle * $earthRadius;
    }
}