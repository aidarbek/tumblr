<?php
define("API_KEY", "");//Insert your key here

if(isset($_GET['tag']))
	$tag = $_GET['tag'];
else
	$tag = "swag";

if(isset($_GET['limit']))
	$limit = $_GET['limit'];
else
	$limit = 20;

$url = "http://api.tumblr.com/v2/tagged?api_key=".API_KEY."&tag=".$tag."&limit=".$limit;

if(isset($_GET['last']))
	$url = $url."&before=".$_GET['last'];

$ch = curl_init($url);
curl_exec($ch); 
curl_close($ch);
?>