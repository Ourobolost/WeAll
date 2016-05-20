
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>WeAll Social Center</title>
<link type="text/css" rel="stylesheet" href="style.css" />
</head>

<?php

//start session and correct login condition

	session_start();

	require_once("connect.php");
// if user not enter username or password display the error
if(!isset($_POST['name']) || !isset($_POST['pass']))	{
		echo '
		<div id="loginform">
		Please Enter Username/Password
		<meta http-equiv="refresh" content="2;url=login.php">
		</div>
		';
}

// check username and password from database

else{
	$strUsername = mysqli_real_escape_string($con,$_POST['name']);
	$strPassword = mysqli_real_escape_string($con,$_POST['pass']);

	$strSQL = "SELECT * FROM user_account WHERE USERNAME = '".$strUsername."' 
	and PASSWORD = '".$strPassword."'";
	$objQuery = mysqli_query($con,$strSQL);
	$objResult = mysqli_fetch_array($objQuery);

// if dont get data from database it means Incorrect Username or Password
	if(!$objResult)
	{
		echo "Username and Password Incorrect!";
		echo '<meta http-equiv="refresh" content="2;url=login.php">';
	exit();
	}
	else
	{
		if($objResult["Login_Status"] == "1")
		{
			echo "'".$strUsername."' Exists login!";
			echo '<meta http-equiv="refresh" content="2;url=index.php">';
			exit();
		}
		else
		{
			//*** Update Status Login
			$sql = "UPDATE user_account SET Login_Status = '1' , LastUpdate = NOW() WHERE UserNo = '".$objResult["UserNo"]."' ";
			$query = mysqli_query($con,$sql);

			//*** Session
			$_SESSION["UserNo"] = $objResult["UserNo"];
			$_SESSION["name"] = $objResult["FirstName"];
			session_write_close();
			//*** Go to Main page
			header("location:index.php");
		}
			
	}
	mysqli_close($con);
}
?>
</html>