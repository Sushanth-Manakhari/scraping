<?php

$ch = curl_init("http://grandrapids.craigslist.org/web/4777345410.html");

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$cl = curl_exec($ch);


$site = new DOMDocument();
@$site->loadHTML($cl);

$xpath = new DOMXpath($site);


/*--- for getting title... in console --- */

// $x("//h2[@class='postingtitle']")

/* --- for getting section . in console.. */

//$xpath("//section(@id='postingbody')/text()");

/*get title*/

$titleQuery = $xpath->query("//h2[@class='postingtitle']/text()");

/* lets find out how many we get,*/
/*
echo "<pre>"; 

foreach($titleQuery as $title){


	print_r($title);
}

echo "</pre>";
// we got 2. but we want the 2nd one hence .. 
*/

$title = $titleQuery->item(1)->nodeValue;

$textQuery = $xpath->query("//section[@id='postingbody']/text()");




$bodyText =  null;

foreach($textQuery as $text){


	$bodyText .= $text->nodeValue. "<br />";
}



$ulQuery = $xpath->query("//ul[@class='notices']/li");

/*$li = '';
foreach($ulQuery as $ul){

 $li .= '<li>'.$ul->nodeValue.'</li><br />';

}*/

$li = $ulQuery->item(1)->nodeValue; 

//echo "</pre>";


//$imgQuery = $xpath->query("//img[@title='image 1']/@src");

//echo $imgQuery->length;

//$image = $imgQuery->item(0)->nodeValue;
?>

<html>
<head>
	<title>Craiglist Scrape</title>

</head>

<body>
	
	<div class="wrapper">
	<h1><?php echo $title; ?></h1>
	<!--<img src="<?php // echo $image; ?>" alt="Craiglist" />-->
	<p><?php echo $bodyText; ?></p>
	</div>

	<ul>
	<?php echo $li ; ?>
	</ul>

</body>
</html>




