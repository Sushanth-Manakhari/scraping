<?php

$ch = 	curl_init("http://www.snapdeal.com/products/women-apparel-topwear");
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

$product_name = $xpath->query("//div[@class='product-title']/a/text()");

$product_img = $xpath->query("//div[@class='hoverProductImage product-image ']//img/@src");

$product_price = $xpath->query("//span[@id='price']/text()"); 

$array = array();

for($x=0; $x<$product_name->length; $x++){

	$array[$x]["product_name"] = $product_name->item($x)->nodeValue;
	$array[$x]["product_img"] = $product_img->item($x)->nodeValue;
	$array[$x]["product_price"] = $product_price->item($x)->nodeValue;



}

/*echo "<pre>";
print_r($array);
*/

foreach($array as $thing){

echo '<h4>' . $thing["product_name"] . '</h4>';
echo '<img src="'.  $thing["product_img"]  .'" alt="Snapdeal Images" />';
echo 'Price : '.$thing["product_price"];
echo '<br />';
}

?>
