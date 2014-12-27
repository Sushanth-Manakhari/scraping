scraping
========

Some practiced site scraping with DOMDocument and DOMXpath and CURL..

Scraped one instance from Craigslit.

Scraped and write to imdb.txt another instance from IMDB. So you can watch the scraped items got written into the file while the process goes on.

---------------------------------------------------------------------

Initialize curl with 

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // has been done to get the result and store it in a variable
$cl = curl_exec($ch);

// Dom Document

$dom = new DOMDocument();
$dom->loadHTML($cl);

// XPath
$xpath = new DOMXpath($dom)

And here's all the initialization have been done, then start the scraping query.
