<?php
	session_start();

	$ini_array = parse_ini_file("configuration.ini", true);	
	$query = isset($_GET["query"]) ? $_GET["query"] : null;
	$update = isset($_GET["update"]) ? $_GET["update"] : null;
	
	$returnValue = "";
	if($query != null)
	{
		switch($query)
		{
			case "nagios":

				
			break;
			case "network":
				$username = $ini_array[prtg_settings][username];
				$password = $ini_array[prtg_settings][password];
				$loginurl = $ini_array[prtg_settings][url];
			break;
			case "weather_camera":
				$image_path = $ini_array[weather_settings][cam_url];
				$returnValue = "<img id='CameraCtl1__cameraImage' src='{$image_path}' />";
			break;
			case "weather":
				$url = $ini_array[weather_settings][url];
				$returnValue = file_get_contents($url);
			break;
			case "redmine":
				if( isset($_GET["ticknum"]) ){
					$ticket = "/{$_GET["ticknum"]}";
				}
				else{
					$ticket = "";
				}
				$redmine_url = $ini_array[redmine_settings][url];
				$rest_api_key = $ini_array[redmine_settings][api_key]; 
				$link = "http://{$redmine_url}/projects/incoming/issues{$ticket}.json?key={$rest_api_key}";
				$returnValue = file_get_contents($link);
			break;
			case "news":
				$url = $ini_array[news_settings][url];
				$returnValue = file_get_contents($url);
			break;
			case "employee":
			
			break;
		}
	}
	echo $returnValue;
?>