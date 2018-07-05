<?php
$Titles=array();
$ImageLinks=array();
$Discription=array();
$Rating=array();
$Date=array();

$html = file_get_contents($URLz); //get the html returned from the following url
    $init_doc = new DOMDocument();

    libxml_use_internal_errors(TRUE); //disable libxml errors

    if(!empty($html)){ //if any html is actually returned

        $init_doc->loadHTML($html);
        libxml_clear_errors(); //remove errors for yucky html
        
        $init_xpath = new DOMXPath($init_doc);
		//$init_row = $init_xpath->query('//tr[@class="list_header"]');
		$EpNameOdd = $init_xpath->query('//div[@class="list_item odd"]//div[@class="info"]//a[@itemprop="name"]');
		$EpNameEven = $init_xpath->query('//div[@class="list_item even"]//div[@class="info"]//a[@itemprop="name"]');

		$ImageOdd = $init_xpath->query('//div[@class="list_item odd"]//div[@class="image"]//a//div//img');
		$ImageEven = $init_xpath->query('//div[@class="list_item even"]//div[@class="image"]//a//div//img');

		$DisOdd = $init_xpath->query('//div[@class="list_item odd"]//div[@class="info"]//div[@class="item_description"]');
		$DisEven = $init_xpath->query('//div[@class="list_item even"]//div[@class="info"]//div[@class="item_description"]');

		$RateOdd = $init_xpath->query('//div[@class="list_item odd"]//div[@class="info"]//div[@class="ipl-rating-widget"]//div[@class="ipl-rating-star "]//span[@class="ipl-rating-star__rating"]');
		$RateEven = $init_xpath->query('//div[@class="list_item odd"]//div[@class="info"]//div[@class="ipl-rating-widget"]//div[@class="ipl-rating-star "]//span[@class="ipl-rating-star__rating"]');

		$DateOdd = $init_xpath->query('//div[@class="list_item odd"]//div[@class="info"]//div[@class="airdate"]');
		$DateEven = $init_xpath->query('//div[@class="list_item even"]//div[@class="info"]//div[@class="airdate"]');


		$odd=array();
		$even=array();
		$Imgodd=array();
		$Imgeven=array();
		$discriptionOdd=array();
		$discriptionEven=array();

		if($ImageOdd->length > 0){
			foreach($ImageOdd as $row2){

				array_push($Imgodd,$row2->getAttribute('src'));
				
			}
		}
		if($ImageEven->length > 0){
			foreach($ImageEven as $row2){

				array_push($Imgeven,$row2->getAttribute('src'));				
			}
		}
		
		$i=0;
		$j=0;
		$len=sizeof($Imgodd)+sizeof($Imgeven);
		while($i<$len){
			$Titles[$i]=$EpNameOdd[$j]->nodeValue;
			$ImageLinks[$i]=$Imgodd[$j];
			$Discription[$i]=$DisOdd[$j]->nodeValue;
			$Rating[$i]=$RateOdd[$j]->nodeValue;
			$Date[$i]=$DateOdd[$j]->nodeValue;
			$i++;

			if($len%2!=0 && $i==$len){
				break;
			}

			$Titles[$i]=$EpNameEven[$j]->nodeValue;
			$ImageLinks[$i]=$Imgeven[$j];
			$Discription[$i]=$DisEven[$j]->nodeValue;
			$Rating[$i]=$RateEven[$j]->nodeValue;
			$Date[$i]=$DateEven[$j]->nodeValue;
			$i++;
			$j++;
		}
		$save=$GLOBALS['dir']."/Websites";
		if(!is_dir($save)){
			mkdir($save);
			$save=$GLOBALS['dir']."/Websites/Copy";

			if(!is_dir($save)){
				mkdir($save);
				$save=$save."/Cover";

				if(!is_dir($save)){
					mkdir($save);
				}
			}
		}
		else{
		$save=$save."/Cover";
		echo "bye";
		}

		$filename=basename($save);
		

		for($l=0;$l<sizeof($ImageLinks);$l++){
			$complete=$save.'/'.$l.'.jpg';
			file_put_contents($complete , file_get_contents($ImageLinks[$l]));
		}
	}
	
?>