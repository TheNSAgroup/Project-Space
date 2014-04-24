<html>
<body>

<?php
error_reporting(0);
$email=$_POST['email'];

if(isset($_POST['email']))
{
  mysql_connect('mysql.freehostingnoads.net','u342178811_nsa','untcsce4410') or die(mysql_error);
  mysql_select_db('u342178811_ps');

  $query="select * from accountsTable where Email= '$email'";
  $result = mysql_query($query) or die(error);

if(mysql_num_rows($result))
{
  //echo "User exist";
  //$query2 = "select * FROM accountsTable WHERE Email='". clean_string($_POST['email']) . "'";

  $result2 = mysql_query($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysql_error());
  $rows=mysql_fetch_array($result2);
  $pass  =  $rows['Password'];//FETCHING 
  //echo "your pass is ::".($pass)."";
  $to = $rows['Email'];

  //echo "Your email is ::".$to;
  //Details for sending E-mail
  $from = "Project Space";
  $url = "http://projectspace.t15.org/";
  $body  =  "   Project Space password recovery;
  -----------------------------------------------
        Url : $url;
        Email Details are: $to;
        Here is your password: $pass;
		
		
        Sincerely,
        Project Space";
        $from = "csce4410web@gmail.com";
        $subject = "Project Space Password recovered";
        $headers1 = "From: $from \n";
        $headers1 .= "Content-type: text/html;charset=iso-8859-1\r\n";
        $headers1 .= "X-Priority: 1\r\n";
        $headers1 .= "X-MSMail-Priority: High\r\n";
        $headers1 .= "X-Mailer: Just My Server\r\n";
        //$sentmail = mail( $to, $subject, $body, $headers1 );
		
		$headers = 'From: '.$from."\r\n".
 
		'Reply-To: '.$from."\r\n" .
 
		'X-Mailer: PHP/' . phpversion();
 
		@mail($to, $subject, $body, $headers); 
 }
 else
 {
    echo "No user exist with this email id";
 }
  if($sentmail==1)
    {
		echo "<br>";
        echo "<span style='color: #ff0000;'> Your Password Has Been Sent To Your Email Address.</span>";
    }
 
}
?>

<form action="forgot.php" method="post">
Enter you email ID: <input type="text" name="email">
<input type="submit" name="submit" value="Send">
</form>

</body>
</html>