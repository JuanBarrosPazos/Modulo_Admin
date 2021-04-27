<?php

    //////////////////////////

require_once('geoplugin.class.php');
	$geoplugin = new geoPlugin();
	$geoplugin->locate();

	echo "* IP GEOPLUGIN: {$geoplugin->ip} <br>";
	echo "* LATITUDE: {$geoplugin->latitude} <br>";
	echo "* LONGITUDE: {$geoplugin->longitude} <br>";
	echo "* CONTINENT NAME: {$geoplugin->continentName} <br>";
	echo "* COUNTRY NAME: {$geoplugin->countryName} <br>";
	echo "* COUNTRY CODE: {$geoplugin->countryCode} <br>";
	echo "* REGION: {$geoplugin->region} <br>";
	echo "* CITY: {$geoplugin->city} <br><hr>";

    //////////////////////////

	global $uip;
	$uip = $_SERVER['REMOTE_ADDR'];
	echo "* IP REMOTE_ADDR: ".$uip.".<br>";
	/*echo "* IP HTTP_CLIENT_IP: ".isset($_SERVER['HTTP_CLIENT_IP'])."<br>";*/
	/*echo "* IP HTTP_X_FORWARDED_FOR: ".isset($_SERVER['HTTP_X_FORWARDED_FOR'])."<br><hr>";*/

    //////////////////////////

    function getRealIPa() {

        if (!empty($_SERVER['HTTP_CLIENT_IP']))
            return $_SERVER['HTTP_CLIENT_IP'];
           
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
       
        return $_SERVER['REMOTE_ADDR'];
}
echo "* getRealIPa(): ".getRealIPa().".<br>";

    //////////////////////////

function getRealIPb()
{

    if (isset($_SERVER["HTTP_CLIENT_IP"]))
    {
        return $_SERVER["HTTP_CLIENT_IP"];
    }
    elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
    {
        return $_SERVER["HTTP_X_FORWARDED_FOR"];
    }
    elseif (isset($_SERVER["HTTP_X_FORWARDED"]))
    {
        return $_SERVER["HTTP_X_FORWARDED"];
    }
    elseif (isset($_SERVER["HTTP_FORWARDED_FOR"]))
    {
        return $_SERVER["HTTP_FORWARDED_FOR"];
    }
    elseif (isset($_SERVER["HTTP_FORWARDED"]))
    {
        return $_SERVER["HTTP_FORWARDED"];
    }
    else
    {
        return $_SERVER["REMOTE_ADDR"];
    }
}
echo "* getRealIPb(): ".getRealIPa().".<br><hr>";

    //////////////////////////

function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
echo get_client_ip()."<hr>";

    //////////////////////////

if (!empty($_SERVER['HTTP_CLIENT_IP'])){ $ip = $_SERVER['HTTP_CLIENT_IP']; } 
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) { $ip = $_SERVER['HTTP_X_FORWARDED_FOR']; } 
else { $ip = $_SERVER['REMOTE_ADDR']; } 
echo $ip."<hr>";

    //////////////////////////


?>
