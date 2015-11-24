<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if ( ! function_exists('site_name'))
{
    function site_name()
    {
       $CI = & get_instance();
       return $CI ->config->item('site_name');
   }
}
if ( ! function_exists('user_url'))
{
    function user_url($only_admin=false)
    {
       $CI = & get_instance();
       $type=($CI->current_login_type)?$CI->current_login_type."/":'';
       if($only_admin==true && $CI->current_login_type!="admin"){
          $type="";
      }

      return base_url().$type;
  }
}

if ( ! function_exists('reverse_geocode'))
{   
   function reverse_geocode($array,$field=NULL) {
    $address='';
    if(isset($array['address']) && $array['address']!=''){
        $address = str_replace(" ", "+", $array['address']);
        $url = "http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false";
    }
    elseif (isset($array['latlng']) && $array['latlng']!='') {
        $latlng=$array['latlng'];
        $url = "http://maps.google.com/maps/api/geocode/json?latlng=$latlng&sensor=false";
    }
    $result = file_get_contents("$url");
    $json = json_decode($result);
    $address_final["street"]="";
    $address_final["route"]="";
    $types = "";
    $city = "";
    $state = "";
    $postal_code = "";
    $country = "";
    $lat = "";$lon = "";
    $country_short_name = "";
    $city_short_name = "";
    $state_short_name = "";
    $final_adrs = '';
    $response = array();
    $res = array();
    $address1_arr = array("street_number","sublocality_level_2","sublocality_level_1","sublocality");
    $address2_arr = array("route","point_of_interest","establishment");
    $city_arr = array("locality");
    $state_arr = array("administrative_area_level_1","administrative_area_level_2");
    $postal_arr = array("postal_code");
    $country_arr = array("country");
    $result=$json->results[0];
    $geometry = $result->geometry;
    $latitude = $geometry->location->lat;
    $longitude = $geometry->location->lng;
    foreach($result->address_components as $addressPart) {
        $types = $addressPart->types; 
        if (in_array($types[0],$city_arr)){
            $city = $addressPart->long_name;
            $city_short_name=$addressPart->short_name;
        }
        else if (in_array($types[0],$state_arr)){
            $state = $addressPart->long_name;
            $state_short_name=$addressPart->short_name;
        }
        else if (in_array($types[0],$postal_arr)){
            $postal_code = $addressPart->long_name;
        }
        else if (in_array($types[0],$country_arr)){
            $country = $addressPart->long_name;
            $country_short_name = $addressPart->short_name;
        }
    }
    $response["city"] = $city;
    $response["city_short_name"] = $city_short_name;
    $response["state_short_name"] = $state_short_name;
    $response["state"] = $state;
    $response["postal_code"] = $postal_code;
    $response["country"] = $country;
    $response["country_short_name"] = $country_short_name;
    $response["lat"] = $latitude;
    $response["lng"] = $longitude;
    if($response['postal_code']==''){
        $latlng=$latitude.",".$longitude;
        $postal_code = reverse_geocode(array("latlng"=>$latlng),"postal_code");
        $response["postal_code"]=$postal_code;
    }
    if($address!=''){
        if(!empty($response)){
            foreach ($response as $key => $value) {
                array_push($res,$value);
            }
        }
        $adrs_arr=explode(",",$array['address']);
        foreach ($adrs_arr as $key => $value) {
            $value=trim($value);
            if(!in_array($value,$res)){
                $final_adrs.=",".$value;
            }
        }
        $final_adrs=trim($final_adrs,",");
    } 
    $response["address"]=$final_adrs;
    if($field!=NULL){
        return $response[$field];
    }
    return $response;
}
}


function admin_url(){
   $CI = & get_instance();
   $curl_arr=$CI->uri->segment_array();
   $curl_arr=array_filter($curl_arr);

   if(!empty($curl_arr))
   {
    if(in_array("admin",$curl_arr)){
        return "true";
    } 
}
return "false";
}


if ( ! function_exists('check_session'))
{   
    function check_session($flag = false) {
     $CI = & get_instance();
     if( $CI->login_type != false)
     {   
        $function_name = $CI->login_type."_loggedin";
        $response = call_user_func(array($CI,$function_name));
        if($flag == true)
        {
            return $response;
        }     

        if($response == true &&  $CI->access == "nologin") {
         redirect(user_url(true)."dashboard","refresh");
     }
     else if($response == false &&  $CI->access == "login"){
        $url=($CI->isadminurl)?"admin/login":"login";
        redirect($url,"refresh");
    }
}

}
}

if ( ! function_exists('addScheme'))
{  
    function addScheme($url, $scheme = 'http://')
    {
      return parse_url($url, PHP_URL_SCHEME) === null ?
      $scheme . $url : $url;
  }

}

if(! function_exists('chkDataIsExits')){
    function chkDataIsExits($select_fields='id',$tbl_name,$compare_field,$compare_field_value,$compare_field_1,$compare_field_value_1,$totalCompareField = 2,$return='ret'){
        //echo $tbl_name;
        //echo $select_fields;
        $CI =& get_instance();
        $CI -> db -> select($select_fields);
        $CI->db-> from($tbl_name);  
        if($totalCompareField == 2){
            $CI -> db -> where($compare_field,$compare_field_value);
            $CI -> db -> where($compare_field_1, $compare_field_value_1);
        }elseif($totalCompareField == 1){
            $CI -> db -> where($compare_field,$compare_field_value);
        }
        $CI -> db -> limit(1);
        $query = $CI -> db -> get();
        if($query -> num_rows() == 1){
            if($return == 'ret'){
                return true;
            }elseif($return == 'val'){
                return $query->row_array();
            }
        }else {
            return false;
        }
    }
}


if(! function_exists('get_element_array')){
    function get_element_array($array,$key,$value)
    {

        if(!empty($array))
        {
            foreach($array as $arr)
            {

                if($arr[$key]==$value)
                {
                    return $arr;
                }
            }
        }
        return array();
    }
}


if(! function_exists('check_ip')){
    function check_ip($checkme,$MULTIPLE_HOSTS) {
        $checkme = strtolower($checkme);
        if ($MULTIPLE_HOSTS) {
            $hostregex = '/^(([0-9*-]{1,7}\.){3}[0-9*-]{1,7}|([0-9a-z_-]+\.)*([0-9a-z_-][0-9a-z_-]{0,61})?[0-9a-z]\.[a-z]{2,6})$/';
        } else {
            $hostregex = '/^(([0-9]{1,3}\.){3}[0-9]{1,3}|([0-9a-z_-]+\.)*([0-9a-z_-][0-9a-z_-]{0,61})?[0-9a-z]\.[a-z]{2,6})$/';
        }
        if (preg_match("$hostregex", $checkme) OR $checkme == "localhost") {
            return 1; 
        } else { 
            return 0;
        }
    }
}


if(! function_exists('check_portrange')){
    function check_portrange($checkme,$DEBUG) {
        $portrangeregex ='/^(T\:|U\:){0,1}[TU\:0-9-\,]+$/';
        if (preg_match("$portrangeregex",$checkme)) {
            return 1;
        } else {
            return 0;
        }
    }
}

if(! function_exists('check_randomhosts')){
    function check_randomhosts($checkme,$DEBUG) {
        $randomhostsregex = '/^([0-9])+$/';
        if (preg_match("$randomhostsregex",$checkme)) {
            return 1;
        } else {
            return 0;
        }
    }
}


if(! function_exists('check_decoys')){
    function check_decoys($checkme,$DEBUG) {
        $decoyregex = '/^((([0-9]{1,3}\.){3}[0-9]{1,3}|([0-9a-z_-]+\.)*([0-9a-z_-][0-9a-z_-]{0,61})?[0-9a-z]\.[a-z]{2,6}),)*$/';
        if (preg_match("$decoyregex",$checkme)) {
            return 1;
        } else {
            if ($DEBUG) echo "<BR><B>Error: check_decoy() failed.</B><BR>";
            return 0;
        }
    }
}


if(! function_exists('check_idlescan')){
    function check_idlescan($checkme, $DEBUG) {
        $idlescanregex = '/^((([0-9]{1,3}\.){3}[0-9]{1,3}|([0-9a-z_-]+\.)*([0-9a-z_-][0-9a-z_-]{0,61})?[0-9a-z]\.[a-z]{2,6}),)*(:[0-9])*$/';
        if (preg_match("$idlescanregex",$checkme)) {
            return 1;
        } else {
            if ($DEBUG) echo "<BR><B>Error: check_idlescan() failed.</B>";
            return 0;
        }
    }
}
/* End of file MY_language_helper.php */
/* Location: ./application/helpers/My_url_helper*/ 