<?php

$Links=array();
$handle=fopen($GLOBALS['dir']."/".$GLOBALS['DirectoryLinkTxtName'].".txt", "w");
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
		    	    	$handle=fopen($GLOBALS['dir']."/".$GLOBALS['DirectoryLinkTxtName'].".txt", "a");
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

$readz=file_get_contents($GLOBALS['dir']."/".$GLOBALS['DirectoryLinkTxtName'].".txt");
unlink($GLOBALS['dir']."/".$GLOBALS['DirectoryLinkTxtName'].".txt");
$TempEpisodes=explode('+', $readz);
$Links=array();
array_reverse($TempEpisodes);

for($r=0;$r<sizeof($TempEpisodes)-1;$r++){//This is for Anime
	$x=split("/", $TempEpisodes[$r]);
	$y=explode(".", $x[sizeof($x)-1])[0];

	if (preg_match_all('/[-]*\d+/', $y, $z)) {
		$w=(int)$z[0][0];
		$Links[$w]=$TempEpisodes[$r];
	}
	if (preg_match_all('/[--]\d+/', $y, $z)) {
		$w=(int)(split("-", $z[0][0])[1]);
		$Links[$w]=$TempEpisodes[$r];
	}
}
ksort($Links);
?>