<?php

$ch = curl_init("https://www.linkedin.com/reg/join?trk=login_reg_redirect&session_redirect=http%3A%2F%2Fwww.linkedin.com%2Fjob%2Fhome%3Ftrk%3Dnav_responsive_sub_nav_jobs");

		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)");
		curl_setopt($ch, CURLOPT_AUTOREFERER, true);
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FAILONERROR, true);

$cl = curl_exec($ch);


$dom = new DOMDocument();
@$dom->loadHTML($cl);

$xpath = new DOMXpath($dom);

$btn = $xpath->query("//p[@id='agreement']");

echo $btn->length;
echo "<pre>";

foreach($btn as $btns){
echo $btns->nodeValue;
}

?>