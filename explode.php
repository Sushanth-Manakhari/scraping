<?php


$fh = fopen("imdb.txt", "r");

while(!feof($fh)){ // while it's not the end of file

	$array = trim(fgets($fh));

	$iArray[] = explode("*", $array);

}

$count = count($iArray);


for($x=0; $x<$count; $x++){

	$newArray[$x]["imageTitle"] = $iArray[$x][0];
	$newArray[$x]["imageSrc"] = $iArray[$x][1];
	$newArray[$x]["linkTitle"] = $iArray[$x][2];
	$newArray[$x]["linkHref"] = $iArray[$x][3];
}

echo "<pre>";
print_r($newArray);

?>