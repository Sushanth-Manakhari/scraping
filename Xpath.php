<?php

/*

	XPATH - A simple wrapper for using Xpath with the DOMDocument and DOMXpath classes in php. 

	Copyright © 2013 Nate Wiley

	This program is free software: you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation, either version 3 of the License, or any 
	later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program.  If not, see <http://www.gnu.org/licenses/>.

*/ 

class XPath {
	public $dom, $xpath, $proxy;

	// pass in the url you want to crawl to the XPATH constructor 
	function __construct($url){
		set_time_limit(0); // give the script unlimited time to run

		// if using proxies, uncomment next line
		//$this->proxy = $this->__getProxy();

		$html = $this->__curl($url); // get the url with curl
		$this->dom = new DOMDocument(); // create Dom 
		@$this->dom->loadHTML($html); // load as html
		$this->xpath = new DOMXPath($this->dom); // create xpath instance 
		
	}

	// pass in an xpath expression as a string. "//div[@class='main']/text()"
	// returns an xpath result, pass the result to the preview function for testing

	public function query($q){
		$result = $this->xpath->query($q);
		return $result;
	}

	// this is a function to loop through the properties of a selected node,
	// it is used for testing/debugging xpath queries.
	// pass in the result returned from query() .. 

	public function preview($results){
		echo "<pre>";
		print_r($results);
		echo "<br>Node Values <br>";
		foreach($results as $result){
			echo trim($result->nodeValue) . '<br>';
			$array[] = $result;
		}
		if(is_array($array)){
			echo "<br><br>";
			print_r($array);
		}
		
	}

	// retrieve a webpage with curl
	private function __curl($url){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)");
		curl_setopt($ch, CURLOPT_AUTOREFERER, true);
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FAILONERROR, true);

		// Uncomment the following 2 lines if you're using proxies, 
		// you'll want to make sure you have proxies in the proxy.txt file
		// curl_setopt($ch, CURLOPT_PROXY, $this->proxy);
		// curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);

		// execute 
		$result = curl_exec($ch);

		// if we get errors, let us know whyy
		if (!$result) {
			echo "<br />cURL error number:" .curl_errno($ch);
			echo "<br />cURL error:" . curl_error($ch) . " on URL - " . $url;
			var_dump(curl_getinfo($ch));
			var_dump(curl_error($ch));
			exit;
		}
		return $result;
				
	}

	// returns random proxies from the proxy.txt file
	private function __getProxy(){
		$fh = fopen("../proxy.txt", 'r+');
		while(!feof($fh)){
			$proxies[] = trim(fgets($fh));
		}
		$proxy = $proxies[array_rand($proxies)]; // choose random proxy
		fclose($fh);
		return $proxy;
	}


}
?>