<?php

// using curl get the site

$ch  = curl_init("http://www.craigslist.org/about/sites");


// we use this line for storing it in variable instead of just displaying. Here the variable is $cl. otherwise we couldn't store it in $cl
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$cl = curl_exec($ch);

//echo $cl; // to echo the whole site



/**
*  Now we got the site we will try to get specific elements from it
*/

$site = new DOMDocument();

$html = @$site->loadHTML($cl);

/* -- - We will get the header title of the website --- */

//$title = $site->getElementById("logo");

//echo $title->nodeValue; 



/* --- --- We will get all the links of the page --- */

$links = $site->getElementsByTagName("a"); // since it's a href.. we want the anchor tag

//echo $links->length; //for how many links are there

$output = "<ul>";

foreach($links as $link){

	//echo $link->nodeValue. '<br />'; // this is the link name
	$output .= '<li><a href="' . $link->getAttribute("href") . '">'. $link->nodeValue  .'</a></li>';
}

$output .= "</ul>";

echo $output;
?>