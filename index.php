<?php
session_start();
require_once("connect.php");
 

 // Create Function loginForm to go to login page
function loginForm(){
    echo'
    <div id="loginform">
    <form action="login.php" method="post">
        <p>Please login First</p>
        <input type="submit" name="enter" id="enter" value="Login" />
    </form>
    </div>
    ';

}



//logout and clear session
if(isset($_GET['logout'])){ 
     
    //Simple exit message
    $fp = fopen("log.html", 'a');
    fwrite($fp, "<div class='msgln'><i>User ". $_SESSION['name'] ." has left the chat session.</i><br></div>");
    fclose($fp);
     
    session_destroy();



    header("Location: index.php"); //Redirect the user
}

//Update Activity
if(isset($_SESSION['UserNo'])){
    $sql = "UPDATE user_account SET Login_Status = '1' , LastUpdate = NOW() WHERE UserNo = '".$_SESSION["UserNo"]."' ";
    $query = mysqli_query($con,$sql);

    //*** Get User Login
    $strSQL = "SELECT * FROM user_account WHERE UserNo = '".$_SESSION['UserNo']."' ";
    $objQuery = mysqli_query($con,$strSQL);
    $objResult = mysqli_fetch_array($objQuery,MYSQLI_ASSOC);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>WeAll Social Center</title>
	<link rel="stylesheet" href="./css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/ChatStyle.css">
	<link rel="stylesheet" type="text/css" href="./css/style.css">
	<script type="text/javascript" src="./js/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="./js/bootstrap.min.js"></script>
</head>

<?php
				    if(!isset($_SESSION['UserNo'])){
				        loginForm();
				    }
				    else{
				    ?>

<body>
<!-- Navbar Top -->
	<nav id="stickyNav" class="navbar navbar-default navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
			<!-- Menu btn Collapse -->
				<button class="navbar-toggle collapsed" data-target="#topNav"
				data-toggle="collapse">
					MENU
				</button>
				<a href="index.html" class="navbar-brand">
					WeALL
				</a>
			</div>
			<div class="">
				<form class="navbar-form navbar-left" role="search">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search">
                    </div>
                </form>
			</div>
			<div id="topNav" class="collapse navbar-collapse">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="index.html">Login</a></li>
					<li><a href="product.html">Register</a></li>
				</ul>	
			</div>
		</div>
	</nav>
<!-- Product -->
		<div class="container dw">
			<div class="col-md-3 lstFriends">

				<div class="media">
				    <span class="media-left">
				        <img src="./pic/picMan.jpg" class="img-circle " height="60px"  alt="...">
				    </span>
				    <div class="media-body">
				        <h4 class="NamePeople">Tomy Wilsons</h4>
				    </div>
				</div>
				<hr>
				<div class="media">
				    <span class="media-left">
				        <img src="./pic/picMan1.jpg" class="img-circle" height="60px"  alt="...">
				    </span>
				    <div class="media-body">
				        <h4 class="NamePeople">Draco Malfoy</h4>
				    </div>
				</div>
				<hr>
				<div class="media">
				    <span class="media-left">
				        <img src="./pic/picMan2.jpg" class="img-circle" height="60px"  alt="...">
				    </span>
				    <div class="media-body">
				        <h4 class="NamePeople">Harry Potter</h4>
				    </div>
				</div>
				<hr>
				<div class="media">
				    <span class="media-left">
				        <img src="./pic/picWo.jpg" class="img-circle" height="60px"  alt="...">
				    </span>
				    <div class="media-body">
				        <h4 class="NamePeople">Sally Jung</h4>
				    </div>
				</div>
				<hr>
				<div class="media">
				    <span class="media-left">
				        <img src="./pic/picWo2.jpeg" class="img-circle" height="60px"  alt="...">
				    </span>
				    <div class="media-body">
				        <h4 class="NamePeople">Emma Watson</h4>
				    </div>
				</div>
				<hr>
				<div class="media">
				    <span class="media-left">
				        <img src="./pic/picWo3.jpg" class="img-circle" height="60px"  alt="...">
				    </span>
				    <div class="media-body">
				        <h4 class="NamePeople">Kendall Jenner</h4>
				    </div>
				</div>
				<hr>
			</div>
			<div class="col-md-9 text-center chatRoom">
				

				    <div id="wrapper">
				        <div id="menu">
				            <p class="welcome">Welcome, <b><?php echo $_SESSION['name']; ?></b></p>
				            <p class="logout"><a id="exit" href="#">Exit Chat</a></p>
				            <div style="clear:both"></div>
				        </div>
				         
				        <div id="chatbox">
				            <?php
				            if(file_exists("log.html") && filesize("log.html") > 0){
				             $handle = fopen("log.html", "r");
				             $contents = fread($handle, filesize("log.html"));
				             fclose($handle);
				         
				             echo $contents;
				            }
				                ?>
				        </div>
				         
				        <form name="message" action="">
				            <input name="usermsg" type="text" id="usermsg" size="63" />
				            <input name="submitmsg" type="submit"  id="submitmsg" value="Send" />
				        </form>
				    </div>
    				<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
    				<script type="text/javascript">
	    				// jQuery Document
	    					$(document).ready(function(){

					    //If user wants to end session
					        $("#exit").click(function(){
					            var exit = confirm("Are you sure you want to end the session?");
					            if(exit==true){window.location = 'index.php?logout=true';}   
					        });

	            		//If user submits the form
					        $("#submitmsg").click(function(){   
					            var clientmsg = $("#usermsg").val();
					            $.post("post.php", {text: clientmsg});              
					            $("#usermsg").attr("value", "");
					            return false;
					        });

	            		//Load the file containing the chat log
				        function loadLog(){     
				            var oldscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height before the request
				            $.ajax({
				                url: "log.html",
				                cache: false,
				                success: function(html){        
				                    $("#chatbox").html(html); //Insert chat log into the #chatbox div   
				                    
				                    //Auto-scroll           
				                    var newscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height after the request
				                    if(newscrollHeight > oldscrollHeight){
				                        $("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
				                    }               
				                },
				            });
				        }
					    setInterval (loadLog, 500);    
		    			});
				    	<?php
				    	}

				    	?>
				    </script>


			</div>
		</div>
	
</body>
</html>