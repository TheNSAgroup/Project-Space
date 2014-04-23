<?php

session_start();

$url  = @( $_SERVER["HTTPS"] != 'on' ) ? 'http://'.$_SERVER["SERVER_NAME"] :  'https://'.$_SERVER["SERVER_NAME"];
$url .= $_SERVER["REQUEST_URI"];

if (isset($_GET['id'])) {
	$ID = urldecode($_GET['id']);
} else {
	$ID = '';
} //end if

$host = "mysql.freehostingnoads.net";
$username="u342178811_nsa";
$password="untcsce4410";
$db_name="u342178811_ps";
$tbl_name="projects";

$link = mysqli_connect("$host","$username","$password","$db_name") or die("Error " . mysqli_error($link));


$sql="SELECT * FROM $tbl_name WHERE id='$ID'";


if ($result = mysqli_query($link, $sql)) {
	$row = $result->fetch_array(MYSQLI_BOTH);
	$id = $row['id'];
	$title = $row['title'];
	$desc = $row['description'];
	$skills = $row['skills'];
	$deadline = $row['deadline'];
	$teamSize = $row['team'];
	$paid = $row['paid'];
	$dept = $row['department'];
	$contactEmail = $row['contact'];
	$phone = $row['phone'];
	$postDate = $row['postDate'];
	//$contactName = $row['postby']; This will need to be corrected when security is added, do not store this value in the projects table
	$filename = $row['filename'];		
		
	if($teamSize > 1){
		$teamSize = $teamSize . " people";
	}else{
		$teamSize = "1 person";
	}

	if ($paid == 1){
		$paid = "Paid";
	}else{
		$paid = "Unpaid";
	}
	
	if($phone == ""){
		$phone = "Not available";
	}

	$desc = preg_replace('/\n(\s*\n)+/', '</p><p>', $desc);
	$desc = preg_replace('/\n/', '<br>', $desc);
	$desc = '<p>'.$desc.'</p>';
}

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
	  	.text-gray{
			color: gray;
		}
		.no-indent{
			text-indent: -14px;
		}
		#project-header h4{
			margin-bottom: 0px;
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

	<!-- Project moderator info modal -->
	<div class="modal fade" id="info-modal" tabindex="-1" role="dialog" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title">Contact info</h4>
		  </div>
		  <div class="modal-body text-center">
			<h5><?php //echo $contactName;  This will need to be corrected when security is added, do not store this value in the projects table ?></h5>
			<p><span class="glyphicon glyphicon-earphone"> </span> <?php echo $phone; ?></p>
			<span class="glyphicon glyphicon-envelope"> </span><a href="mailto:<?php echo $contactEmail; ?>"> <?php echo $contactEmail; ?></a>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		  </div>
		</div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	  
	  
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
            <li><a href="#">Post project</a></li>
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
					<div id="account-button" class="hidden col-xs-4 col-sm-2">
						<div class="dropdown pull-right">
					    	<button class="btn btn-default dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['name']; ?><span class="caret"></span></button>
					  		<span class="dropdown-arrow"></span>
					  		<ul class="dropdown-menu">
								<li><a href="#">Account</a></li>
								<li><a href="my-posts.php">My posts</a></li>
								<li><a href="#" id="logout">Logout</a></li>
					  		</ul>
						</div>
					</div>
					<!-- End of Main header menu -->
                </div>

                <!-- Banner section starts here -->
                <div class="row">
                    <div class="col-xs-12" id="banner" style="background-image: url(images/banner3.jpg);">
                        <h1 class="uppercase" id="banner-text">Projects</h1> <!-- CHANGE THIS -->
                    </div>
                </div>
				<!-- End of Banner section -->
            </div>
        </header>

        <!-- Page content starts here -->
        <div class="container">
            <div class="row">
					<br/>
                    <div class="col-xs-12 col-md-8 div-center" >
						
						<section id="project-header">
							<h4 id="projectTitle"><?php echo $title ?></h4>
							<small class="text-gray">Posted on <span id="posted-date"><?php echo $postDate ?></span> under <span id="posting-dept"><?php echo $dept ?></span></small>
						</section>
						
						<br>
						
						<section>
						<p id="projectDescription">
						<?php echo $desc ?>
</p>
						</section>
						
						<br>
						<section>
							<span class="label label-primary" title="Team size"><?php echo $teamSize ?></span>
							<span class="label label-success" title="Stipend"><?php echo $paid ?></span>
							<span class="label label-warning" title="Deadline"><?php echo $deadline ?></span>
						</section>
						
						<br>
						
						<section>
							<strong>Required Skills: </strong>
							<p id="projectSkills"><?php echo $skills ?></p>
						</section>

						<section>
							<strong>File: </strong>
							<p id="file"><a href="./files/<?php echo $filename; ?>"><?php echo substr($filename,strlen($id),strlen($filename) - strlen($id)); #this is where the file is listed?></a></p>
						</section>

						
						<br>
						
						<section class="div-center text-center">
							<form action="<?php if($_SESSION['name'] == ""){echo "#header-top"; }else{ echo "join-project.php";}?>" method="post">
								<input type="hidden" name="emailto" value="<?php echo $contactEmail ?>">
								<input type="hidden" name="emailfrom" value="<?php echo $_SESSION['email'] ?>">
								<input type="submit" name="submit" value="Count me in" class="btn btn-hg btn-info" id="joinButton">
							</form>
							<a href="#" data-toggle="modal" data-target="#info-modal" class="small text-gray">Contact project moderator</a>
						</section>

						<br><br>

						<section id="public-questions">
								<h4>Questions & answers </h4>

								<div id="disqus_thread"></div>
							<script type="text/javascript">
								/* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
								var disqus_shortname = 'projectspace'; // required: replace example with your forum shortname

								/* * * DON'T EDIT BELOW THIS LINE * * */
								(function() {
									var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
									dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
									(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
								})();
							</script>
							<noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
							<a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>

						</section>
						
</div>
				
<br><br>
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
		function checkLoggedIn(){
			var accountName = "<?php echo $_SESSION['name'];?>"
			if (accountName == ""){
				alert("Please login to continue");
			}
		}

		document.getElementById('joinButton').onclick=checkLoggedIn;
	</script>
	
	<script type="text/javascript">
		uname = "<?php echo $_SESSION['name'];?>";
		
		if (uname!=("")){//indicaates that no one is logged in
			$('#account-button').toggleClass('hidden');
			$('#login-text').toggleClass('hidden');
		}
	</script>
	  
	<script type="text/javascript">
		var myEl = document.getElementById('logout');

		myEl.addEventListener('click', function() {
			window.location.href = 'logout.php'
		}, false);
 	</script>
	  
  </body>

</html>
