<?php extract ( $_POST ); ?>
<html xmlns = "http://www.w3.org/1999/xhtml">
<head>
	<title>Project Input Validation Form</title>
	<style type="text/css">
      th, td {
          text-align: left;
          padding: 8px;
      }
  </style>
</head>
<body>

	<p>Add an employee to a project </p>
	
	<form action="projaddtask.php" method="post">
	<?php
		$database = new mysqli("localhost", "tdbrooks", "tdbrooks38", "tdbrooks");

		if ($database->connect_error){
			die("Connection failed: " . $database->connect_error);
		}

		// build pull-down list of employees from database - allow "add new"
	  if ( !( $result = $database->query ( "SELECT Project_name FROM Project WHERE 1") ) )
			print ("Warning!   could not execute query <br />" );
	   	print("<select name='project_name'>");
	   	
		while($row = $result->fetch_assoc()) {
			foreach ($row as $value) {
				print ("<option>$value</option>");		
			}
		}
		
		print("<option>Add New</option>");
		print("</select><br><br>");
		print("Employee last name:<input type='text' name='emplname'><br>");
		print("Employee first name:<input type='text' name='empfname'><br>");
		print("Employee title:<input type='text' name='emptitle'><br>");
		print("Employee department name:<input type='text' name='empdepname'><br>");
		print("<input type='submit' value='Submit'>");

		$query = "INSERT INTO Employee " .
		"( Project_name, Employee_fname, Employee_lname, Employee_title ) " .
		"VALUES ( '$project_name','$emplname','$empfname','$emptitle','$empdepname' )" ;

		if ( !( $result = $database->query ( $query ))) {
			die ( "Could not execute query! " . $database->connect_error );
		}





	  // build pull-down list of employees from database - allow "add new"
	 //  if ( !( $result = $database->query ( "SELECT Employee_lname FROM Employee WHERE 1") ) )
		// 	print ("Warning!   could not execute query <br />" );
	 //   	print("<select name='empname'>");

		// while($row = $result->fetch_assoc()) {
		// 	foreach ($row as $value) {
		// 		print ("<option>$value</option>");		
		// 	}
		// }
		// print("<option>Add New</option>");
		// print("</select><br>");
		// print("Employee last name:<input type='text' name='emplname'><br>");
	 //    print("Employee first name:<input type='text' name='empfname'><br>");
		// print("Employee title:<input type='text' name='emptitle'><br>");
		// print("Employee department name:<input type='text' name='empdepname'><br>");
	?>
</form>



</body>
