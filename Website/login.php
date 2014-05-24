<?php

ob_start();
session_start();

//File used to check login credentials
$host = "mysql.freehostingnoads.net";
$username="u342178811_nsa";
$password="untcsce4410";
$db_name="u342178811_ps";
$tbl_name="accountsTable";

$link = mysqli_connect("$host","$username","$password","$db_name") or die("Error " . mysqli_error($link));


$email=$_POST['email']; 
$mypassword=$_POST['password'];
$forwardURL = $_POST['url'];
$sql="SELECT * FROM $tbl_name WHERE Email='$email' and Password='$mypassword' ";


 if($sql == false) 
{
    var_dump(mysql_error());
} 
$result=mysqli_query($link,$sql);

if (!$result) 
{
    die(mysqli_error($link));
}

// Mysql_num_row is counting table row
$count= mysqli_num_rows($result);

// If result matched $email and $mypassword, table row must be 1 row
if($count==1)
{
	$sql_result = "SELECT FirstName FROM $tbl_name WHERE Email='$email' and Password='$mypassword'limit 1";
	$res = mysqli_query($link,$sql_result);
	$value = mysqli_fetch_assoc($res);
	$name = $value['FirstName'];

	$sql_result = "SELECT LastName FROM $tbl_name WHERE Email='$email' and Password='$mypassword'limit 1";
	$res = mysqli_query($link,$sql_result);
	$value = mysqli_fetch_assoc($res);
	$lname = $value['LastName'];

    $sql_result = "SELECT ID FROM $tbl_name WHERE Email='$email' and Password='$mypassword'limit 1";
    $res = mysqli_query($link,$sql_result);
    $value = mysqli_fetch_assoc($res);
    $uid = $value['ID'];
	
	// Register $emai@l, $mypassword and redirect to file "login_success2.php"
    $_SESSION['id']=$uid;
	$_SESSION['name']=$name;
	$_SESSION['lname']=$lname;
	$_SESSION['email']=$email;
	$_SESSION['password']=$mypassword;

	header("location:".$forwardURL);
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Project Space - Sign up</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" type="image/ico" href="images/favicon.ico">
    
    <!-- Loading Bootstrap, Flat UI and custom site template -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet">
    <link href="css/flat-ui.css" rel="stylesheet">
    <link href="css/template.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. -->
    <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <!-- Hidden Menu -->
    <nav id="hidden-menu" class="navmenu navmenu-inverse navmenu-fixed-left offcanvas" role="navigation">
        <p class="white uppercase" id="hidden-menu-header">Menu</p>
          <ul class="nav navmenu-nav uppercase">
            <li><a href="home.html">Home</a></li>
            <li><a href="projects.php">Projects</a></li>
            <li><a href="profiles.php">Profiles</a></li>
			<li><a href="about.html">About</a></li>
			<li><a href="contact.html">Contact</a></li>
        </ul>
		<br/>
		<p class="white uppercase" id="hidden-menu-header">Quick links</p>
		<ul class="nav navmenu-nav">
            <li><a href="form.html">Post project</a></li>
        </ul>
    </nav>

    <div id="wrap">
        <header>
            <div class="container-fluid">

                    <!-- Main header menu starts here -->
                <div class="row" id="header-top">
                    <div class="col-xs-2"> 
                        <a href="#" data-toggle="offcanvas" data-target="#hidden-menu" data-canvas="body"><img src="images/sidemenuicon.svg" alt="Menu"/></a>
                    </div>
                    <div class="col-xs-8"> 
                        <div id="logo"></div>
                    </div>
									
					
					<!-- End of Main header menu -->
                </div>

                <!-- Banner section starts here -->
                <div class="row">
                    <div class="col-xs-12" id="banner" style="background-image: url(images/banner2.jpg);">
                        <h1 class="uppercase" id="banner-text">Login</h1> <!-- CHANGE THIS -->
                    </div>
                </div>
				<!-- End of Banner section -->
            </div>
        </header>

        <!-- Page content starts here -->
        <div class="container">
            <div class="row">
				<br/><br/>
				<div class="col-xs-12 col-sm-7 col-lg-5 div-center">

					<div class="alert alert-danger">Oops.. The information you entered does not seem to match. Let's try that again.</div>

					<br>

					<form action="login.php" method="post" class="well well-lg text-center"  role="form">
						
						<label><strong class="uppercase">Email</strong></label>
						<div class="form-group col-sm-10 div-center">
							<div class="input-group">
								<span class="input-group-addon"><span class="input-icon fui-mail"></span></span>
								<input type="email" class="form-control" name="email" placeholder="Your email address" required>
							</div>
						</div>
						
						<br/>
						
						<label><strong class="uppercase">Password</strong></label>
						<div class="form-group col-sm-10 div-center">
							<div class="input-group">
								<span class="input-group-addon"><span class="input-icon fui-lock"></span></span>
								<input type="password" class="form-control" name="password" placeholder="Minimum 8 characters" required>
							</div>
						</div>
						
						<br/>
						
						<div class="form-actions">
					  		<button type="submit" class="btn btn-info">Login</button>
						</div>

						

						<div class="col-xs-12 text-center">
							<a class="lightgray" href="forgot.php">Forgot password</a>
							<br>
							<a class="lightgray" href="signup.html">Create account</a>
						</div>

						<br><br>

					</form>	
				</div>
                <br/>
            </div>
        </div>

        <div id="push"></div> <!-- This pushes the footer to the bottom -->
    
    </div>
    
    <!-- footer starts here --> 
    <footer>
        <p id="footer-text">Made with love at University of North Texas</p>
    </footer>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jasny-bootstrap.min.js"></script>

  </body>

</html>
