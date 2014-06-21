<?php

class Cube {
	public function isContected(){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://api.spark.io/v1/devices/" . $deviceID . "/colourLight");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "access_token=" . $access_token . "&params=" . $light);
		curl_exec($ch);
		curl_close($ch);
	}
}

?>