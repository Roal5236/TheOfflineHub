<?php
set_time_limit(1100000);

include('ImageUpload.php');


	$GLOBALS['dir'] =str_replace("\\", '/', (string)$_POST['Direct']);
	$title1=explode('/', $GLOBALS['dir']);
	$title2=$title1[sizeof($title1)-1];
	$title=strtoupper($title2);
	$GLOBALS['DirectoryLinkTxtName']=$title.' DirectoryLinks';
	$GLOBALS['EpName']=$title.' EpisodeNameList';
	$URLz=$_POST['ImdbUrl'];
	$ThemeColor=$_POST['ColorImg'];
	// if(isset($_POST['ColorImg'])){
	// 	$ThemeColor=$_POST['ColorImg'];
	// }

	include('getVideo.php');

	include('ImdbFetchData.php');

	$begin='<!DOCTYPE html>
<html>
<head>
    <title>'.$title.'</title>
    <link rel="stylesheet" type="text/css" href="Copy/Style/Roboto-Codensed">
    <link rel="stylesheet" type="text/css" href="Copy/Style/EpisodesStylez.css">  
    <script src="Copy/Style/jquery-3.3.1.min.js"></script>


</head>
<body style="background-color:'.$ThemeColor.'">  
    <script>
        $(document).ready(function() {
        
            $(".nonInfo").each(function() {

                $(this).css("display","none");
            });

            $("#Read").click(function(){
                $(".Discription").css("overflow-y","visible");
                $(".MainlyDiscrip").css("height","350px");
                $("#Read").hide();

            });';

            for($i=0;$i<sizeof($Titles);$i++){
            	$begin=$begin.'$("#c'.$i.'").hover(
	                function() {
	                    var d=$(this).attr("id");
	                    $("#"+d+"> .info").css("display","none");
	                    $("#"+d+"> .nonInfo").stop().slideDown(200);
	                },
	    
	                function() {
	                    var d=$(this).attr("id");
	                    $("#"+d+"> .nonInfo").hide();
	                    $("#"+d+"> .info").css("display","block");

	                });';
            }

            $begin=$begin.'

        });

        
    </script>
     <div class="CoverPageMain" style="background-image:url('.$BackImg.');
">
        <div class="CoverPageSubDiv">
            <div class="CoverPageDataDiv">
                <div class="CoverPageDataSubDiv" style="border:30px solid '.$ThemeColor.';">
                    <h1 class="TitleHeading">'.$title.'</h1>

                     <p class="SmallDescription">Follows the adventures of Monkey D. Luffy and his friends in order to find the greatest treasure ever left by the legendary Pirate, Gol D Roger. The famous mystery treasure named "One Piece". </p>

                     <br>
                     <br>
                     <br>

                    <div class="GenreDiv">
                        <p class="GenreElement">ACTION</p>
                        <p class="GenreElement">ADVENTURE</p>
                        <p class="GenreElement">DRAMA</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="DescriptionMainDiv">
        <div class="DescriptionSubDiv">

            <div class="DescriptionSpaceLeft">
            </div>

            <div class="DescriptionSpaceRight">
                <h1>Description.</h1>
                <hr class="LineColor">
                <div class="Description">
                    Gol D. Roger was known as the "Pirate King," the strongest and most infamous being to have sailed the Grand Line. The capture and death of Roger by the World Government brought a change throughout the world. His last words before his death revealed the existence of the greatest treasure in the world, One Piece. It was this revelation that brought about the Grand Age of Pirates, men who dreamed of finding One Piece—which promises an unlimited amount of riches and fame—and quite possibly the pinnacle of glory and the title of the Pirate King. Enter Monkey D. Luffy, a 17-year-old boy who defies your standard definition of a pirate. Rather than the popular persona of a wicked, hardened, toothless pirate ransacking villages for fun, Luffy’s reason for being a pirate is one of pure wonder the thought of an exciting adventure that leads him to intriguing people and ultimately, the promised treasure. Following in the footsteps of his childhood hero, Luffy and his crew travel across the Grand Line, experiencing crazy adventures, unveiling dark mysteries and battling strong enemies, all in order to reach the most coveted of all fortunes—One Piece...
                </div>
                <br>
                <center><h3 class="ReadMore">READ MORE</h3></center>

            </div>
        </div>
    </div>


    <div class="BasicInfoMainDiv">
        <div class="BasicInfoSubDiv">
            <img src="'.$CoverImg.'" class="CoverImage">
        </div>
    </div>

    <div class="MainInfo">

        <div class="SubInfo">

            <h1 class="InformartionHeading">Information.</h1>
            <hr class="InformartionHeading">

            <div class="IconInfoDiv">

                <div class="IconSubDiv">
                    <img src="Copy/Icons/eye7.png" class="IconImage" >
                    <p class="IconHeader">VIEWS</p>
                    <h4 class="IconValue">1234</h4>
                </div>

                <div class="IconSubDiv">
                    <img src="Copy/Icons/star3.png" class="IconImage" >
                    <p class="IconHeader">Rating</p>
                    <h4 class="IconValue">4.6</h4>
                </div>

                <div class="IconSubDiv">
                    <img src="Copy/Icons/ep2.png" class="IconImage" >
                    <p class="IconHeader">EPISODES</p>
                    <h4 class="IconValue">839</h4>
                </div>

                <div class="IconSubDiv">
                    <img src="Copy/Icons/status.png" class="IconImage" >
                    <p class="IconHeader">STATUS</p>
                    <h4 class="IconValue">ONGOING</h4>
                </div>

                <div class="IconSubDiv">
                    <img src="Copy/Icons/ep.png" class="IconImage" >
                    <p class="IconHeader">TYPE</p>
                    <h4 class="IconValue">ANIME</h4>
                </div>
            </div>                    
        </div>               
    </div>


    <div class="MainlyDiscrip">
    </div>

    <!--=====================EPISODES================================================-->  

    <div class="EpisodeListMain">
        <div class="EpisodesGen">

        	<center><h1>EPISODES</h1></center>
            <hr class="LineColor">
            <br>
            <br>';

            for($i=0;$i<sizeof($Titles);$i++){

            	$begin=$begin.'<a href="ep'.($i+1).'.html">
	                <div id="c'.$i.'" class="EpisodeDiv">
	                    <div class="info">
	                        <img src="Copy/Cover/'.$i.'.jpg" class="EpisodeImage">
	                        <p class="EpisodeNumber">EPISODE  '.($i+1).'</p>
	                    </div>
	                    <div class="nonInfo">
	                        <p>'.$Titles[$i].'</p>
	                        <div style="width:100%;">
	                            <br>
	                            <br>
	                            <p class="nonInfoRating">'.$Rating[$i].'</p>
	                            <p class="nonInfoDate">'.$Date[$i].'</p>
	                        </div>
	                    </div>
	                </div>
	            </a>';           
            }

        $begin=$begin.    '
        </div>
</body>
</html>';

$list=$begin;

$loc2=$GLOBALS['dir']."/Websites/List.html";

file_put_contents($loc2,$list);

	for($i=1;$i<sizeof($Links);$i++){
		$Link=explode($title2, $Links[$i])[1];

		$htm='<!DOCTYPE html>
			<html>
			<head>
				<title>Episode 537</title>
				<meta name="viewport" content="width=device-width, initial-scale=1.0">
				<style type="text/css">

						p{
							font-size:22px;
						}

						h3{
							font-size:30px;
						}

						h2{
							width:10%;
							font-size:16px;
						}
						img{
							width:30%;
						}

					@media screen and (max-width:566px){

						p{
							font-size:16px;
						}

						h3{
							font-size:20px;
						}

						h2{
							width:10%;
							font-size:8px;
						}

						img{
							width:20%;
						}

					}
					
					@media screen and (min-width:900px){

						img{
							width:15%;
						}

						p{
							font-size:18px;
						}

						h3{
							font-size:25px;
						}

						h2{
							width:10%;
							font-size:16px;
						}
						.row {
						  display: flex;  /* equal height of the children */
						}

						.col {
						  text-align:center;
						  flex-wrap: wrap; /* additionally, equal max-width */
						  padding: 2%;
						}
					}

					
				</style>

			<script>

				    
			</script>
			</head>
			<body style="margin:0px;font-family:Calibri;height:100%;">
			<header>
				<div class="row" style="max-width:100%;height:10%;box-shadow: 0px 0px 20px 1px grey;background-color: #ffffff">
					<img class="col" src="Copy/Images/OPLogo.jpg" ></p>
					<p class="col">HOME</p >
					<p class="col">EPISODES</p>
					<p class="col">ARCS</p>
					<p class="col">CHARACTERS</p>
					<p class="col">ABOUT</p>

				</div>
			</header>

			<div id="VideoPlay" style="margin-top:1%">
				<h2 style="margin:0px;margin-left:16.35%;padding:1%;background-color:#0061ff;color:#ffffff;border-radius:3px;box-shadow:0px 10px 10px 2px grey;width:10%">EPISODE '.$i.'</h2>
				<center>
					<video style="max-width:80%;z-index:3" controls poster="Copy/Images/poster1.jpg">
					  <source id="playTime" src="..'.$Link.'" type="video/mp4" >
					  			Right Click and Play with VlC media Player

					</video> 
				</center>
			</div>

			<div class="title" style="max-width:100%;background:#1c262f;padding-top:1%;margin-top:3%;color:#ffffff; ">

				<center><h1 style="max-width:100%">'.$Titles[$i-1].'</h1></center>
				
				<div class="row" style="padding:2%">
						<div class="col" style="">
							<h3>Short Summary</h3>
							<p>
								'.$Discription[$i-1].'
							</p>
						</div>
						<div class="col" style="">
							<p><h3>RATING: </h3>'.$Rating[$i-1].'</p>
							<p><h3>AIR DATE: </h3>'.$Date[$i-1].'</p>

						</div>
					</div>
			</div>
			</body>
		</html>';

		$loc=$GLOBALS['dir']."/Websites/ep".$i.".html";

		file_put_contents($loc,$htm);				
	}

include('copyFolder.php');
$kk='Location:'.$GLOBALS['dir'].'/Websites/List';
header($kk);


?>