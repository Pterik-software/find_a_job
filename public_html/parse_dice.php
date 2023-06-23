<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <title>Job search</title>
  </head>
  <body>    
<h2>Парсинг сайта dice.com</h2>
<?php

	$url = 'https://www.dice.com/jobs?q=Oracle&location=Toronto,%20%D0%9E%D0%BD%D1%82%D0%B0%D1%80%D0%B8%D0%BE,%20%D0%9A%D0%B0%D0%BD%D0%B0%D0%B4%D0%B0&latitude=43.653226&longitude=-79.3831843&countryCode=CA&locationPrecision=City&radius=30&radiusUnit=mi&page=1&pageSize=20&filters.workFromHomeAvailability=TRUE&language=en&eid=S2Q_';
	// Use basename() function to return the base name of file
	//$file_name = basename($url).'.html';
	//$file_name = 'try1.html';
	
	//$html = file_get_contents($url);
	$html = 'try1.html';
	if (file_put_contents($html, file_get_contents($url)))
	{
		echo "File ".$html." downloaded successfully";
	}
	else
	{
		echo "File ".$html." downloading failed.";
	}


	//echo $html;
	
	$document = new DOMDocument();
	
	$document->loadHTML($html);
	
	$xpath = new DOMXpath($document);
	
	$elements = $xpath->query('//div[contains(@class,"card-company")]');
	
	echo '<pre>';
	print_r($elements['elements']);
	echo '<pre>';
	
	//var_dump($elements);
    echo "Well done";
?>
</body>
</html>