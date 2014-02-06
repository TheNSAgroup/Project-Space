<HTML>
<HEAD>
</HEAD>
<BODY>
<!--Open form -->
<form action ="form_script.php" method="POST">

<p>Name: <input type="text" name ="name" size="30"/></p>

<p>Size: <select name="size">
<option value ="small">Small</option>
<option value ="medium">Medium</option>
<option value="large">Large</option>
</select></p>

<p>Gender: <input type="radio" name="gender" value="girl"/>Girl
<input type="radio" name="gender" value="boy"/>Boy</p>
<!--Close form -->
<input type="submit" name ="submit" value ="Submit"/>
</BODY>
</HTML>