<?php

require_once("Xpath.php");

set_time_limit(0);



// all the links

// pagination next button --> ("(//span[@class='pagination']/a[contains(., 'Next')])[1]")
// title --> ("//td[@class='title']/a/text()")
// href --> ("//td[@class='title']/a/@href")
// img src --> ("//td[@class='image']//img/@src")

function scrapeImdb($url){
	$baseurl = "http://www.imdb.com";
	$array = array();
	$xpath = new XPath($url);

$imgsrcQuery = $xpath->query("//td[@class='image']//img/@src");
$imgtitleQuery = $xpath->query("//td[@class='image']//img/@title");
$linktitleQuery = $xpath->query("//td[@class='title']/a/text()");
$linkhrefQuery = $xpath->query("//td[@class='title']/a/@href");

$fh = fopen("imdb.txt", "a++");


for($x=0; $x<$linkhrefQuery->length; $x++){


$string = $array[$x]['imageTitle'] = $imgtitleQuery->item($x)->nodeValue."*";
$string .= $array[$x]['imageSource'] = $imgsrcQuery->item($x)->nodeValue."*";
$string .= $array[$x]['linkTitle'] = $linktitleQuery->item($x)->nodeValue."*";
$string .= $array[$x]['linkHref'] = $baseurl . $linkhrefQuery->item($x)->nodeValue."*";
$string .=


fwrite($fh, $string. "\n\n\n\n");

/*$array[$x]['imageTitle'] = $imgtitleQuery->item($x)->nodeValue;
$array[$x]['imageSource'] = $imgsrcQuery->item($x)->nodeValue;
$array[$x]['linkTitle'] = $linktitleQuery->item($x)->nodeValue;
$array[$x]['linkHref'] = $baseurl . $linkhrefQuery->item($x)->nodeValue;
*/
}

fclose($fh);
// check for the "Next" link

$nextPageQuery = $xpath->query("(//span[@class='pagination']/a[contains(., 'Next')])[1]/@href");

if($nextPageQuery->length){

	$nextUrl = $baseurl . $nextPageQuery->item(0)->nodeValue;

//	$array = array_merge($array, scrapeImdb($nextUrl)); // merging the array and recursively calling the function
scrapeImdb($nextUrl);
}

return $array;

}

$data = scrapeImdb("http://www.imdb.com/search/title?certificates=us%3Apg_13&colors=color&genres=comedy&start=1");

//echo "<pre>";

//print_r($data);

?>