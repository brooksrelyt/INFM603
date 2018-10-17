<html>
<head>
  <meta charset="utf-8">
  <title>PHP Script to get pet data by name</title>
  
  <!-- Bootstrap CSS Toolkit styles -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/styles.css">
</head>

<body>
      <h1>I keep a database of pets.</h1>
      Select a pet to get information.<br>
<div id="my-input">
		  <form action="getpetinfo.php" method="post">
		  <select name="petname">
<?php
		// Create connection
		$database = new mysqli("localhost", "testuser1", "********", "testuser1_pets");
	    // Check connection
       if ($database->connect_error) {
        die("Connection failed: " . $database->connect_error);
      }
	  	if ( !( $result = $database->query ( "SELECT Name FROM Pets WHERE 1") ) )
			print ("Warning!   could not execute query <br />" );
	    while($row = $result->fetch_assoc()) {
			foreach ($row as $value) {
				print ("<option>$value</option>");		
			}
		}
?>
<input type="submit" value="Get data">
</div>	  
</select>
</html>
