<?php
	$GLOBALS['dir'] = 'C:/Users/rohaa/Downloads/ANIME/My Hero Academy/Season 2';

$TempEpisodes=array();
$handle=fopen($GLOBALS['dir']."/testMHA2.txt", "w");
fwrite($handle, " ");
fclose($handle);

function getVideo($dir){
	//echo $dir."<br>";
	$mainFile = scandir($dir);

	for($i=0;$i<sizeof($mainFile);$i++){

			if ($mainFile[$i] != "." && $mainFile[$i] != ".." && $mainFile[$i] != "desktop.ini"){
				if(!strpos($mainFile[$i], '.srt') && !strpos($mainFile[$i], '.jpg') && !strpos($mainFile[$i], '.txt') && !strpos($mainFile[$i], '.png' && !strpos($mainFile[$i], '.html'))){
					if(strpos($mainFile[$i], '.mp4') || strpos($mainFile[$i], '.mkv')){
		    	    	$x= $dir.'/'.$mainFile[$i].'+';
		    	    	$handle=fopen($GLOBALS['dir']."/testMHA2.txt", "a");
		    	    	fwrite($handle, $x);
		    	    	fclose($handle);

		        	}
		        	else{
		        		$mainFile[$i]=$dir.'/'.$mainFile[$i];
		        		if(is_dir($mainFile[$i])){
		        		getVideo($mainFile[$i]);
		        		}
		        		else 
		        		{
		        			break;
		        		}
		        	}
		        }
			}
	}
	
}

getVideo($GLOBALS['dir']);
$readz=file_get_contents($GLOBALS['dir']."/testMHA2.txt");
$TempEpisodes=explode('+', $readz);
$Episodes=array();
array_reverse($TempEpisodes);

for($r=0;$r<sizeof($TempEpisodes)-1;$r++){//This is for Anime
	$x=split("/", $TempEpisodes[$r]);
	$y=explode(".", $x[sizeof($x)-1])[0];

	if (preg_match_all('/[-]*\d+/', $y, $z)) {
		$w=(int)$z[0][0];
		$Episodes[$w]=$TempEpisodes[$r];
	}
	if (preg_match_all('/[--]\d+/', $y, $z)) {
		$w=(int)(split("-", $z[0][0])[1]);
		$Episodes[$w]=$TempEpisodes[$r];
	}
}
ksort($Episodes);

?>