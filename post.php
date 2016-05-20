<?php
	session_start();
	require_once("connect.php");

	if(isset($_SESSION['UserNo']))
	{
		
//*** Update Last Stay in Login System
	$sql = "UPDATE user_account SET LastUpdate = NOW() WHERE UserNo = '".$_SESSION["UserNo"]."' ";
	$query = mysqli_query($con,$sql);

	//*** Get User Login
	$strSQL = "SELECT * FROM user_account WHERE UserNo = '".$_SESSION['UserNo']."' ";
	$objQuery = mysqli_query($con,$strSQL);
	$objResult = mysqli_fetch_array($objQuery,MYSQLI_ASSOC);


// open log file and write message
	$text = $_POST['text'];
    $fp = fopen("log.html", 'a');
    fwrite($fp, "<div class='msgln'>(".date("g:i A").") <b>".$_SESSION['name']."</b>: ".stripslashes(htmlspecialchars($text))."<br></div>");
    fclose($fp);

	}
	
?>



