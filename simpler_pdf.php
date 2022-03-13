<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
date_default_timezone_set('Asia/Kolkata');
error_reporting(0);

include 'php/dbconnect.php';

$timestamp = date('Y-m-d H:i:s',time());

function formatSizeUnits($bytes){
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
}


if($_POST['is_file_name']){

   $is_file_name=$_POST['is_file_name'];
   $subject_id=$_POST['subject_id'];
   $id=$_POST['id'];
   $password=$_POST['password'];
   $is_ReadOnlyPDF=$_POST['is_ReadOnlyPDF'];

$file_name_uid=substr(md5(time()), 0, 3);

$file_size_for_format= $_FILES['uploaded_pdf_file']['size'];
$file_size=formatSizeUnits($file_size_for_format);

$findNm_for_ext=$_FILES['uploaded_pdf_file']['name'];
$tmp = explode('.', $findNm_for_ext);
$file_extension = end($tmp);



//$conNm= "pdf_simpler/".$is_file_name.".pdf";
$path_move_path="generated/pdf/$subject_id/".$is_file_name."__$file_name_uid.$file_extension";



if (move_uploaded_file($_FILES['uploaded_pdf_file']['tmp_name'], $path_move_path)) {
	
	$insertFileQuery="INSERT INTO file_share_manager (file_name,file_name_uid,file_extension,file_size,subject_id,time_stamp,read_only) VALUES ('$is_file_name','$file_name_uid','$file_extension','$file_size',$subject_id,'$timestamp',$is_ReadOnlyPDF)";

	if ($conn->query($insertFileQuery)) {
		echo "File Uploaded";
	}else{
		echo "File Database Stored Fail";
	}

	//
}else{
	echo "File System Problem";
}





//echo "PDF Uploaded";

}

?>