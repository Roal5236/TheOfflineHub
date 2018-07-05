
<?php
$target_dir = "Copy/Images/";

$BackTemp = $target_dir .basename($_FILES["BackImg"]["name"]);
$BackFileType = strtolower(pathinfo($BackTemp,PATHINFO_EXTENSION));
$BackImg=$target_dir."OpBack2.".$BackFileType;


$CoverTemp = $target_dir .basename($_FILES["CoverImg"]["name"]);
$CoverFileType = strtolower(pathinfo($CoverTemp,PATHINFO_EXTENSION));
$CoverImg=$target_dir."OPCover.".$CoverFileType;

    if (file_put_contents($BackImg, file_get_contents($_FILES["BackImg"]["tmp_name"])) && 
        file_put_contents($CoverImg, file_get_contents($_FILES["CoverImg"]["tmp_name"]))) {
        echo "The files have been uploaded.";
    } 

    else {
        echo "Sorry, there was an error uploading your files.";
    }

?>
