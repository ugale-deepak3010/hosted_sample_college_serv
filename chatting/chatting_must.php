<?php
error_reporting(0);
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
date_default_timezone_set('Asia/Kolkata');


define('SITE_URL', 'https://hosting-sample.000webhostapp.com/hosted_sample_college_serv');//always change it


include '../php/dbconnect.php';


/***************************FUNCTIONS ***************************/
function addMsg($textMessage,$username,$usersColors,$department)
{
	
		$myFile = "../generated/chat/".$department."/chat.txt";
		$stringData = file_get_contents($myFile);
		$fh = fopen($myFile, 'w') or die("can't open file");

		$userColor = " style='color:".$usersColors.";'";

		$username;
		
		$stringDataNew = "<div class='p-chip' style='display:inline-block !important;white-space: normal;word-wrap: break-word;' ><span style='font-size:10px;color:#949494;'>".date('d M H:i')."</span>&nbsp;<span style='color:#1a80e6;'><b".$userColor.">".$username.":</b></span>&nbsp;<span class='p-chip__value' style='font-size:11px;'> ".htmlspecialchars($textMessage)."</span></div>"."\n";
		$stringData = $stringData.$stringDataNew;
		#$stringData = "";
		fwrite($fh, $stringData);
		fclose($fh);

		echo "4545";//success
	
}





function clearMessages($department) {
	//echo $department;
	#clear text
	$myFile = "../generated/chat/".$department."/chat.txt";
	$stringData = file_get_contents($myFile);
	$fh = fopen($myFile, 'w') or die("can't open file");
	fwrite($fh, "<div><span style='font-size:10px;color:#949494;'>28-05-2021</span> <span style='color:#1a80e6;'><b style='color:blue;'>Wel-Come:</b></span> <span style='font-size:11px;'>Please discuss your educational topics</span></div>");
	fclose($fh);

	#clear big images
	echo "\n";
	//echo __FILE__;//thiis file location
	 $imgs ='../generated/chat/'.$department.'/images/*'; //str_replace('chatting_must.php','../generated/'.$department.'/images/*', __FILE__);

	$files = glob($imgs); 
	
	foreach($files as $file){
	  if(is_file($file))
	    unlink($file); 
	}
	#clear thumbs
	$imgs = '../generated/chat/'.$department.'/images/thumbs/*';//str_replace('chatting_must.php','images/thumbs/*', __FILE__);
	$files = glob($imgs); 
	//var_dump($files);
	foreach($files as $file){
	  if(is_file($file))
	    unlink($file);
	}
	echo 'Messages deleted.';exit;
}				










	function imageResizeRatio($source, $imageName, $department) 
	{ 
		 $sourceW = imagesx($source); 
		 $sourceH = imagesy($source); 
		
		if($sourceW > $sourceH)
		{
			$finalWidthThumb = 180;
			$finalWidth = 800;
			$finalHeightThumb = ($finalWidthThumb * $sourceH) / $sourceW;
			$finalHeight = ($finalWidth * $sourceH) / $sourceW;
		}else
		{
			$finalHeightThumb = 180;
			$finalHeight = 800;
			$finalWidthThumb = ($finalHeightThumb * $sourceW) / $sourceH;
			$finalWidth = ($finalHeight * $sourceW) / $sourceH;
		}
		
		 $ratioImage = imageCreateTrueColor(floor($finalWidth), floor($finalHeight));
		 $bg = imagecolorallocate ( $ratioImage, 255, 255, 255 ); 
		 imagefill ( $ratioImage, 0, 0, $bg );
		 imageCopyResampled($ratioImage, 
													 $source, 
													 0, 
													 0, 
													 0, 
													 0, 
													 $finalWidth, 
													 $finalHeight, 
													 $sourceW, 
													 $sourceH);
			$ratioImageThumb = imageCreateTrueColor(floor($finalWidthThumb), floor($finalHeightThumb));
			$bg = imagecolorallocate ( $ratioImageThumb, 255, 255, 255 ); 
			imagefill ( $ratioImageThumb, 0, 0, $bg );
			imageCopyResampled($ratioImageThumb, 
													 $source, 
													 0, 
													 0, 
													 0, 
													 0, 
													 $finalWidthThumb, 
													 $finalHeightThumb, 
													 $sourceW, 
													 $sourceH); 
			
		$picture = "../generated/chat/".$department."/images/".$imageName.".jpg";
		$thumb = "../generated/chat/".$department."/images/thumbs/".$imageName.".jpg";

		ImageJPEG($ratioImage, $picture); 
		ImageJPEG($ratioImageThumb,$thumb); 

		echo "4545";//success
	}

function addPhoto($file,$usersColors,$id,$password,$department)
{
	//echo $department;
	$accepted = array("image/jpeg", "image/png");
	if(array_key_exists("file", $file) && $file['file']['tmp_name'] != "")
	{
		$image = imageCreateFromString(file_get_contents($file['file']['tmp_name']));
		
		$finalName = time();
		
		imageResizeRatio($image, $finalName, $department);
		
		$myFile = "../generated/chat/".$department."/chat.txt";
		$stringData = file_get_contents($myFile);
		$fh = fopen($myFile, 'w') or die("can't open file");
		$userColor = " style='color:".$usersColors.";'";
		
		$username = $id;
		
		$d232=time();

		$psthhh="\"".SITE_URL."/generated/chat/".$department."/images/".$finalName.".jpg\",\"".$d232."\"";
		$stringDataNew = "<div><span style='font-size:10px;color:#949494;'>".date('d M H:i')."</span> <span style='color:#1a80e6;'><b".$userColor." id=".$d232." >".$username.":</b></span> <span style='font-size:11px;'>photo: <br><img style='' class='p-card--highlighted' onclick='xModal(".$psthhh.")' src='".SITE_URL."/generated/chat/".$department."/images/thumbs/".$finalName.".jpg'></span></div>"."\n";
		$stringData = $stringData.$stringDataNew;
		
		fwrite($fh, $stringData);
		fclose($fh);
	}
}

/***************************FUNCTIONS END ***************************/



if($_POST['sendText']){
	//echo "I am not";
    $sendText=json_decode($_POST["sendText"]);

    $id=$sendText->id;
    $department=$sendText->department;
   // $password=$sendText->password;
    $userTextColor=$sendText->userTextColor;
    $textMessage=$sendText->textMessage;
    
    addMsg($textMessage,$id,$userTextColor,$department);

}





/*******************************************************/

if($_FILES['file']['error'] === 0)
{	
	 $id= $_POST['f_id'];
	 $department= $_POST['f_department'];
	 $password= $_POST['f_password'];
	 $usersColors = $_POST['f_userTextColor'];
	//echo "starting";
	addPhoto($_FILES,$usersColors,$id,$password,$department);             
//						exit;
}

/************************************************************************/

if ($_POST['clearMessages']) {

	$cred=json_decode($_POST['clearMessages']);
	$id=$cred->id;
	$department=$cred->department;
	$password=$cred->password;
	$userTextColor=$cred->userTextColor;

	clearMessages($department);
} 







?>