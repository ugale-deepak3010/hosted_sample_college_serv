<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
date_default_timezone_set('Asia/Kolkata');
error_reporting(0);
//echo "deepuu";
include 'php/dbconnect.php';

$timestamp = date('Y-m-d H:i:s',time()); 


if ($_POST['exam_time']) {
	

$exam_time=$_POST['exam_time'];
$subject_code=$_POST['subject_code'];
$exam_name=$_POST['exam_name'];


$pathTest="generated/exam/$subject_code/199_live_test.txt";
$pathTime="generated/exam/$subject_code/199_live_test_time.txt";

	// 	1) CREATE TABLE FOR MARKS SELECTION.
$create_live_exam_table="CREATE TABLE live_exam_$subject_code (sr_no int NOT NULL AUTO_INCREMENT , ans varchar (10), PRIMARY KEY (sr_no))";


if ($conn->query($create_live_exam_table)) {

	for ($x=1; $x <= 210; $x++) {
		$querry = "INSERT INTO live_exam_$subject_code (sr_no) VALUE ('$x')";
		$conn->query($querry);
	}

		// 	2) GET SUBJECT NAME 

		$subject_name;
		$department_name;
		$sql_getNm="SELECT department,subject_name FROM master_semester WHERE id=$subject_code LIMIT 1";
		$result61 = mysqli_query($conn, $sql_getNm);
		while($row =mysqli_fetch_assoc($result61))
		   {
		    $subject_name = $row['subject_name'];
		    $department_name = $row['department'];
		   }
		// getted subject name.





		   // 	3) CREATE RECORD FOR EXAM.


	$sql_upld_exm="INSERT INTO master_examinition (exam_name,subject_name,subject_id,time_stamp) VALUES ('$exam_name','$subject_name',$subject_code,'$timestamp')";

	$conn->query($sql_upld_exm);

		// 	4) GET ID FOR STUDENT CAN ACCESS EXAM AND RELATED THINGS
		$exam_id;
		$get_exam_id="SELECT id FROM master_examinition WHERE time_stamp='$timestamp' LIMIT 1";
		$result66 = mysqli_query($conn, $get_exam_id);
		while($row66 =mysqli_fetch_assoc($result66))
		   {
		    $exam_id = $row66['id'];
		   }
		// getted exam id.









		   $sql_add_clmn_dept_marks="ALTER TABLE $department_name"."_marks ADD $subject_code"."_$exam_id int(3)";
		   
		   if ($conn->query($sql_add_clmn_dept_marks)) {

		   }else{
		   	echo "can not add your exam in department table<br>for student marks saving contact administrator";
		   }




		move_uploaded_file($_FILES['exam_upload']['tmp_name'],$pathTest);

		$filet = fopen($pathTime,"w");

		$t="{
			\"exam_name\":\"$exam_name\",
			\"subject_code\":\"$subject_code\",
			\"exam_id\":\"$exam_id\",
			\"test_time\":$exam_time
		}";
		fwrite($filet,$t);
		fclose($filet);


		//finished

	echo "Exam Uploaded";

} else {
	echo "cant create exam because database<br>table limit is full<br> Delete your student-selection-table <br>(or Older same subject exam table) or contact to<br>administrator and delete some table";
}





} // if post close

?>