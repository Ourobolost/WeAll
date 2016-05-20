<html>
<header>
</header>
<body>


<?php


if($_POST['name'] == '' ){
	echo "Error Please input username";
	echo '<meta http-equiv="refresh" content="5;url=index.php">';
}
else if($_POST['pass']){
	echo "Please input password";
	echo '<meta http-equiv="refresh" content="5;url=index.php">';
}
else if($_POST['fname'] == ''){
	echo "Please input Firstname";
	echo '<meta http-equiv="refresh" content="5;url=index.php">';
}
else if($_POST['lname'] == ''){
	echo "Please input Lastname";
echo '<meta http-equiv="refresh" content="5;url=index.php">';
}
 else {
$con=mysqli_connect("127.0.0.1","root","","chat");
if (mysqli_connect_errno()){echo "Failed to connect to MySQL: " .
mysqli_connect_error();}

$username= mysqli_real_escape_string($con, $_POST['name']);
$password= mysqli_real_escape_string($con, $_POST['pass']);
$firstname = mysqli_real_escape_string($con, $_POST['fname']);
$lastname = mysqli_real_escape_string($con, $_POST['lname']);


$sql = "INSERT INTO user_account (USERNAME, PASSWORD, FirstName, LastName)VALUES
('$username','$password','$firstname','$lastname');";
if (!mysqli_query($con,$sql)) {
die('Error: ' . mysqli_error($con));
}
mysqli_close($con);
echo '<meta http-equiv="refresh" content="0;url=index.php">';


}
?>

</body>
</html>