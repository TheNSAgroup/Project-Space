<?php

session_start();

$url  = @( $_SERVER["HTTPS"] != 'on' ) ? 'http://'.$_SERVER["SERVER_NAME"] :  'https://'.$_SERVER["SERVER_NAME"];
$url .= $_SERVER["REQUEST_URI"];

    $host = "mysql.freehostingnoads.net";
    $username="u342178811_nsa";
    $password="untcsce4410";
    $db_name="u342178811_ps";
    $tbl_name="accountsTable";
    $email = $_SESSION['email'];

    $link = mysqli_connect("$host","$username","$password","$db_name") or die("Error " . mysqli_error($link));

    $sql="SELECT ID FROM $tbl_name WHERE Email='$email'";

    $result = mysqli_query($link, $sql);
    $row = $result->fetch_array(MYSQLI_BOTH);
    $posterID = $row['ID'];
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Project Space - Post Project</title>
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

    <!--Login Modal -->
    <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Login</h4>
                </div>
                <div class="modal-body">
                    <form role="form" id="login-form" action="login.php" method="post">
                        <div class="form-group">
                            <input type="text" name="email" id="email" placeholder="Email address" class="form-control flat" />
                        </div>

                        <div class="form-group">
                            <input type="password" name="password" id="password" placeholder="Password" class="form-control flat" />
                        </div>
                        
                        <input type="hidden" name="url" value="<?php echo $url ?>">
                </div>
                <div class="modal-footer">
                    <a class="pull-left lightgray" href="forgot.php">Forgot password?</a>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="login-btn" value="submit">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Hidden Menu -->
    <nav id="hidden-menu" class="navmenu navmenu-inverse navmenu-fixed-left offcanvas" role="navigation">
        <p class="white uppercase" id="hidden-menu-header">Menu</p>
          <ul class="nav navmenu-nav uppercase">
            <li><a href="home.html">Home</a></li>
            <li><a href="projects.php">Projects</a></li>
            <li><a href="profiles.html">Profiles</a></li>
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
									
					<!-- Will be show by default -->
                    <div id="login-text" class="show col-xs-2"> 
						<div class="row  pull-right account-text">
							<div class="col-sm-6 col-md-5 col-lg-4">
								<a href="#" data-toggle="modal" data-target="#login-modal">Login</a>
							</div>
							<div class="col-sm-6 col-md-5 col-lg-4">
								<a href="signup.html">Signup</a>
							</div>
                    	</div>
					</div>
					
					<!-- User account drop down. Only visible when logged in -->
					<div id="account-button" class="hidden col-xs-2">
                        <div class="dropdown pull-right">
                            <button class="btn btn-default dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['name']; ?><span class="caret"></span></button>
                            <span class="dropdown-arrow"></span>
                            <ul class="dropdown-menu">
                                <li><a href="account.html">Account</a></li>
                                <li><a href="my-posts.php">My posts</a></li>
                                <li><a href="logout.php" id="logout">Logout</a></li>
                            </ul>
                        </div>
                    </div>
					<!-- End of Main header menu -->
                </div>

                <!-- Banner section starts here -->
                <div class="row">
                    <div class="col-xs-12" id="banner" style="background-image: url(images/banner2.jpg);">
                        <h1 class="uppercase" id="banner-text">Post a Project</h1> <!-- CHANGE THIS -->
                    </div>
                </div>
				<!-- End of Banner section -->
            </div>
        </header>

        <!-- Page content starts here -->
        <div class="container">
            <div class="row">
				<br/><br/>
				<div class="col-xs-10 col-lg-8 div-center">
					<?php
					
						$con=mysqli_connect("mysql.freehostingnoads.net","u342178811_nsa","untcsce4410","u342178811_ps");

						// Check connection
						if (mysqli_connect_errno())
						  {
						  echo "Failed to connect to MySQL: " . mysqli_connect_error();
						  }
						  
						  
						#set vars for db entry	
						$title = trim(addslashes($_POST['title']));	
						$description = trim(addslashes($_POST['description']));	
						$skills = trim(addslashes($_POST['skills']));	
						$date = trim(stripslashes($_POST['date']));	
						$size = trim(addslashes($_POST['size']));	
						$contact = trim(addslashes($_POST['contact']));
						$group1 = trim(stripslashes($_POST['group1']));	
						$department = trim(stripslashes($_POST['department']));	
						$phone = trim(addslashes($_POST['phone']));
                        $postDate = date("Y/m/d");
						$postby = $_SESSION['name'] . " " . $_SESSION['lname'];

						if ( (isset($_SESSION['uid'])) and ($_SESSION['uid'] != NULL) ) {
							$uid = $_SESSION['uid'];
						} else {
							$uid = 0;
						} //end if		
						
						$tablename = "projects"; //table to insert to
						$sql="INSERT INTO $tablename VALUES (NULL, '$title','$description','$skills','$date','$size','$contact','$group1','$department','$postDate','$phone','$posterID',NULL)";
                        
						$run = mysqli_query($con, $sql);

						if (!$run)
						  {?>
						
							<div class="alert alert-danger">
										<h4><span class="input-icon fui-cross"> </span> Oops.. Something went wrong.</h4>
							</div>
						  
						  <?php
						  die();
						  }
						#deal with file upload
  					  	if (isset($_FILES['file'])) { //check for file upload
							$pid = ($con->insert_id); //get id for project, this will be added to filename incase 2 users upload same file
							if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') { //check server os
								$file = '\\files\\';
							} else {
								$file = '/files/';
 							} //end if
							$file = getcwd() . $file;	
							$file .=  $pid . ($_FILES['file']['name']);
							if (file_exists($file) )  { //check if file already there
								unlink ($file); //if file with same name exists, delete it
							} //end if file exists

							if (move_uploaded_file($_FILES['file']['tmp_name'], $file) ) { //copy file to files folder
								$file = addslashes($pid . ($_FILES['file']['name']) ); //prep filename for entry to db
								$sql="UPDATE $tablename SET filename = '$file' WHERE id = '$pid'"; //set filename in DB								
								$run = mysqli_query($con, $sql);
							} //end if
						} //end if			  

						  
						  
						  ?>
						
						<div class="alert alert-success text-center">
							<h4><span class="input-icon fui-check"> </span> Your project information has been receieved successfully.</h4>	
						</div>
						<br/>
                        <div class="text-center">
						  <a href="projects.php" style="color: gray;"><span class="glyphicon glyphicon-th-list"> </span> Go back to projects</a>
						</div>
                        <?
						mysqli_close($con);
					?>
					<br/><br/>
				</div>

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
    
	<script type="text/javascript">
        uname = "<?php echo $_SESSION['name'];?>";
        
        if (uname!=("")){//indicaates that no one is logged in
            $('#account-button').toggleClass('hidden');
            $('#login-text').toggleClass('hidden');
        }
    </script>

  </body>

</html>
