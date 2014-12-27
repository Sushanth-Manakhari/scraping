<?php

$ch = curl_init("http://stopshoppe.com/");

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

$title = $xpath->query("//span[@class='floating_element']/text()");
$img = $xpath->query("//img[@class='floating_element']/@src");
$content = $xpath->query("(//div[@class='content_section_text']/p)[1]/text()");

echo $title->item(0)->nodeValue;
//echo $img->item(0)->nodeValue;

echo '<img src="http://stopshoppe.com/'. $img->item(0)->nodeValue.'" /><br /><br />';

echo $content->item(0)->nodeValue;
?>
