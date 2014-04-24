<?php
session_start();
if(isset($_SESSION['email'])){
header("location:about.html");
}
?>

<html>
<head>
<!--<meta http-equiv="refresh" content="3;url=postProject.html" />-->
</head>
<body>
Login Successful
</body>
</html>