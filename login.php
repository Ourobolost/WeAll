
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>WeAll Social Center</title>
<link type="text/css" rel="stylesheet" href="style.css" />
</head>



<body>
    <div id="loginform">
      <form action="checklogin.php" method="post">


    <?php
if(isset($_SESSION['UserNo']))
{
    echo '
    <div id="loginform">
    Already Login!
    <meta http-equiv="refresh" content="2;url=index.php">
    </div>
    ';
}
    else {
    echo '
        <p>Login Form:</p>
        <label for="name">Username:</label>
        <input type="text" name="name" id="name" />
        <br><br>
        <label for="pass">Password:</label>
        <input type="text" name="pass" id="pass" /><br><br>
        <input type="submit" name="enter" id="enter" value="Login" />                
       <br> <p class="logout"><a id="regis" href="regis.php">Registration</a></p>
       ';
          }
          ?>
     </form>
    </div>
</body>
</html>