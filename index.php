<?php

$site = new DOMDocument();

// creating a div
$div = $site->createElement("div");

// creating a class
$class = $site->createAttribute("class");
$class->nodeValue = "wrapper";  // giving the class a name

// create a heading

$heading = $site->createElement("h1");
$heading->nodeValue = "This is the heading";


// append the class to div

$div->appendChild($class);
$div->appendChild($heading);

// append te div to site

$site->appendChild($div);

// saving the html

$html = $site->saveHTML();

echo $html;
?>