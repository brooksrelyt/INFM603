<form method = "post" action = "project_update.php">
<select name="clerkname">
<?php
	// Create connection
	$database = new mysqli("localhost", "tdbrooks", "tdbrooks38", "tdbrooks");
    // Check connection
     	if ($database->connect_error) {
    		  die("Connection failed: " . $database->connect_error);
  	  }
  // build pull-down list of employees from database - allow "add new"
  	if ( !( $result = $database->query ( "SELECT Employee_lname FROM Employee WHERE 1") ) )
		print ("Warning!   could not execute query <br />" );
   		   print("<select name='empname'>");
	while($row = $result->fetch_assoc()) {
		foreach ($row as $value) {
			print ("<option>$value</option>");		
		}
	}
	print("<option>Add New</option>");
	print("</select><br>");
	print("Employee last name:<input type='text' name='emplname'><br>");
    print("Employee first name:<input type='text' name='empfname'><br>");
	print("Employee title:<input type='text' name='emptitle'><br>");
	print("Employee department name:<input type='text' name='empdepname'><br>");
?>
</select>
</form>