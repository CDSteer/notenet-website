<?php

$email = new Email();
$email->getMailCount();

class Email{
	public function getMailCount() {
		$xml = $this -> getGmail("mynotecube@gmail.com","mynote13");
		$mailCount = $xml->fullcount;
		echo $mailCount;
	}

	public function getMailFeed() {
		$xml = simplexml_load_file(rawurlencode("https://mynotecube@gmail.com:mynote13@gmail.google.com/gmail/feed/atom/"));
		return $xml;
	}

	public function getGmail($username , $password) {
	    $url = "https://mail.google.com/mail/feed/atom";

	    $c = curl_init();

	    $options = array(
	        CURLOPT_HTTPAUTH => CURLAUTH_BASIC ,
	        CURLOPT_USERPWD => "$username:$password" ,
	        CURLOPT_SSLVERSION => 3 ,
	        CURLOPT_SSL_VERIFYPEER => FALSE ,
	        CURLOPT_SSL_VERIFYHOST => 2 ,
	        CURLOPT_RETURNTRANSFER => true ,
	        CURLOPT_USERAGENT => "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)" ,
	        CURLOPT_URL => $url
	    );

	    curl_setopt_array($c, $options);
	    $output = curl_exec($c);
	    echo $output;
	    return $output;
	}
};

?>