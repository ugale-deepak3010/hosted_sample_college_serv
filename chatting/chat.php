<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
date_default_timezone_set('Asia/Kolkata');



$msgPerPage=100;

//include '../php/dbconnect.php';







if ($_POST['department']) {
	//var_dump($_POST);
	$department= $_POST['department'];




//echo '../generated/chat/'.$department.'/chat.txt';

$file = file('../generated/chat/'.$department.'/chat.txt');
end( $file );
$last_line = key($file);

//$file = file('chat2.txt'); 


?>
<div class="chat_window">
	<?php 
		$i = $last_line - $msgPerPage;
		while($i < ($last_line + 1))
		{
			if(array_key_exists($i, $file))
			{
				echo $file[$i];
			}
			$i++;
		}
	?>
</div>
<?php 
}
exit; ?>
