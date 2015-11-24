<?php defined('BASEPATH') OR exit('No direct script access allowed');

class GoogleGeocoder
{
    public function __construct()
    {
        $this->baseURL = "https://maps.google.com/maps/api/geocode/json?sensor=false";
    }
    public function checkPostalCode($address,$postal_code){
        $zip='';
	
        if($postal_code!='' && $address){
            $result=$this->geocode($address);
         /*   dispPreview($result);*/
            if($result){
                $location=$result->lat.",".$result->lng;
                $result_address=$this->reverseGeocode($location);
               /*dispPreview($result_address);*/
                if($result_address){
                    foreach ($result_address as $i => $s) {
                        if(!empty($s->types) && in_array('postal_code', $s->types))
                            $zip=$s->long_name;
						
                    }
                }
            }
        }
        if($zip == $postal_code )
		return false;
        else
		return true;
    }
    public function geocode($address)
    {
       $addressclean = str_replace (" ", "+", $address);
        $url = $this->baseURL . "&address=" . urlencode($addressclean);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $contents = curl_exec($ch);
        curl_close($ch);

        if ($contents) {
            $resp = json_decode($contents);
            if($resp->status == 'OK'){
                return $resp->results[0]->geometry->location;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    public function reverseGeocode($location)
    {
        $url = $this->baseURL . "&latlng=" . $location;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $contents = curl_exec($ch);
        curl_close($ch);

        if ($contents) {
            $resp = json_decode($contents);
            if($resp->status == 'OK'){
                return $resp->results[0]->address_components;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }
}

?>