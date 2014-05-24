<?php 
	session_start();

	$url  = @( $_SERVER["HTTPS"] != 'on' ) ? 'http://'.$_SERVER["SERVER_NAME"] :  'https://'.$_SERVER["SERVER_NAME"];
	$url .= $_SERVER["REQUEST_URI"];

	if (isset($_GET['sort'])) {
		$sort = urldecode($_GET['sort']);
	} else {
		$sort = '';
	} //end if

	if (isset($_GET['dept'])) {
		$dept = urldecode($_GET['dept']);
	} else {
		$dept = '';
	} //end if
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Project Space - Projects</title>
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

    <style>
        .inactive-text{
            color: #c6c6c6;
        }

        .text-right{
            text-align: right;
        }
		
		#account-button{
			margin-top: -5px;
		}
    </style>
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
                    <div class="col-xs-12" id="banner" style="background-image: url(images/banner6.jpg);">
                        <h1 class="uppercase" id="banner-text"><?php if (strlen($dept)>0) { echo $dept; echo " Projects";} else { echo "Projects"; } ?></h1> <!-- CHANGE THIS -->
                    </div>
                </div>
				<!-- End of Banner section -->
            </div>
        </header>

        <!-- Page content starts here -->
        <div class="container">
            <div class="row">
                <br/>
                <div class="col-xs-12">
                    <p class="pull-right inactive-text"> 
                    Sort by: <a href="projects.php?sort=<?php echo urlencode("deadline");?>&dept=<?php echo urlencode($dept); ?>" class="active-text">deadline</a> / 
					<a href="projects.php?sort=<?php echo urlencode("paid");?>&dept=<?php echo urlencode($dept); ?>" class="active-text">payment</a> / 
					<a href="projects.php?sort=<?php echo urlencode("team");?>&dept=<?php echo urlencode($dept); ?>" class="active-text">team size</a>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
						<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
							<div class="input-group">                               
								<input type="text" class="form-control" name="keywords" placeholder="Search projects" id="searchProjects">
								<span class="input-group-btn">
									<button type="submit" class="btn"><span class="fui-search"></span></button>
								</span>
							</div>
						</form>
                    </div>
                    <ul class="nav navmenu-nav text-right">
                        <li><a href="projects.php?sort=<?php echo urlencode($sort);?>&dept=<?php echo urlencode("Arts & Science"); ?>" class="active-text">Arts & Science</a></li>
                        <li><a href="projects.php?sort=<?php echo urlencode($sort);?>&dept=<?php echo urlencode("Business administration"); ?>" class="active-text">Business administration</a></li>
                        <li><a href="projects.php?sort=<?php echo urlencode($sort);?>&dept=<?php echo urlencode("Education"); ?>" class="active-text">Education</a></li>
                        <li><a href="projects.php?sort=<?php echo urlencode($sort);?>&dept=<?php echo urlencode("Engineering"); ?>" class="active-text">Engineering</a></li>
                        <li><a href="projects.php?sort=<?php echo urlencode($sort);?>&dept=<?php echo urlencode("Hospitality"); ?>" class="active-text">Hospitality</a></li>
                        <li><a href="projects.php?sort=<?php echo urlencode($sort);?>&dept=<?php echo urlencode("Journalism"); ?>" class="active-text">Journalism</a></li>
                        <li><a href="projects.php?sort=<?php echo urlencode($sort);?>&dept=<?php echo urlencode("Music"); ?>" class="active-text">Music</a></li>
                        <li><a href="projects.php?sort=<?php echo urlencode($sort);?>&dept=<?php echo urlencode("Public affairs"); ?>" class="active-text">Public affairs</a></li>
                        <li><a href="projects.php?sort=<?php echo urlencode($sort);?>&dept=<?php echo urlencode("Visual arts & Design"); ?>" class="active-text">Visual arts & Design</a></li>
                    </ul>
                    <a href="form.html"><button class="btn btn-info btn-wide pull-right">Post an idea/project</button></a>
                    <br/><br/><br/>
                </div>
                <div class="col-md-9">
<?php


						$con=mysqli_connect("mysql.freehostingnoads.net","u342178811_nsa","untcsce4410","u342178811_ps");

						// Check connection
						if (mysqli_connect_errno())
						  {
						  echo "Failed to connect to MySQL: " . mysqli_connect_error();
						  }
						#set vars for db entry	
						if (isset($_GET['sort'])) {
							$sort = addslashes(urldecode($_GET['sort']));
						} else {
							$sort = '';
						} //end if

						if (isset($_GET['dept'])) {
							$dept = addslashes(urldecode($_GET['dept']));
						} else {
							$dept = '';
						} //end if
																			
						$tablename = "projects"; //table to insert to

						if ( (isset($_POST['keywords'])) and (!empty($_POST['keywords'])) ) {
							$keywords = $_POST['keywords'];
							$sql="SELECT * FROM $tablename WHERE title LIKE '%$keywords%' OR description LIKE '%$keywords%' OR skills LIKE '%$keywords%'";
						} else {															
							$sql="SELECT * FROM $tablename";
							
							if (strlen($dept) > 0) {
								$sql .= " WHERE department = '$dept'";
							} //end if
	
							if (strlen($sort) > 0) {
								$sql .= " ORDER BY $sort ASC";
							} //end if
						} //end if

						if ($result = mysqli_query($con, $sql)) {
							
							if (mysqli_num_rows($result) == 0) { 
								echo "<br><br>";
							   echo "<div class=\"col-xs-12 text-center\">";
								echo "<h4 class=\"lightgray\">No projects posted in this category</h4>";
									echo "</div>";
								echo "<br><br>";
							} 
							
							while ($row = $result->fetch_array(MYSQLI_BOTH)) {

								$title = stripslashes($row['title']);
								$description = stripslashes($row['description']);
								$skills = stripslashes($row['skills']);
								$date = $row['deadline'];
								$team = stripslashes($row['team']);
								$contact = stripslashes($row['contact']);
								$paid = $row['paid'];
								$ID = $row['id'];
								$department = $row['department'];
								if ($paid == 1) {
									$paid = "paid";
								} else {
									$paid = "unpaid";		
								} //end if
								
								if($team > 1){
									$team = $team . " people";
								}else{
									$team = "1 person";
								}
								
								$description = preg_replace( "/\r|\n/", "", $description);
								if (strlen($description) > 300){
									$description = wordwrap($description, 300);
									$description = explode("\n", $description);
									$description = $description[0] . '...';
								}
?>
	                    <div class="row">
                        <div class="col-xs-12  well">
                            <h6><?php echo $title; ?></h6>
                            <p><?php echo $description;
					echo "<br>";
					
					
 				?></p>
                            <div class="row">
                                <div class="col-xs-8">
                                    <span class="label label-primary" title="Team size"><?php echo $team ?></span>
									<span class="label label-success" title="Stipend"><?php echo $paid ?></span>
									<span class="label label-warning" title="Deadline"><?php echo $date ?></span>
                                </div>
                                <div class="col-xs-4">
									<form action="view-project.php?id=<?php echo $ID ?>" method="post">
										<input type="submit" class="btn btn-danger pull-right" name="submit" value="More.." style="margin-top: -15px;">
									</form>
                                </div>
                                <br/>
                            </div>    
                        </div>
                    </div>							



<?php

							} //end while
						} //end if
						
?>

                    <br/>

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
    <script src="js/jasny-bootstrap.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-select.js"></script>   
    <script src="js/jquery.tagsinput.js"></script>
    <script src="js/jquery.placeholder.js"></script>
    <script src="js/application.js"></script>
	  
	<script type="text/javascript">
		uname = "<?php echo $_SESSION['name'];?>";
		
		if (uname!=("")){//indicaates that no one is logged in
			$('#account-button').toggleClass('hidden');
			$('#login-text').toggleClass('hidden');
		}
	</script>
	 
  </body>

</html>
