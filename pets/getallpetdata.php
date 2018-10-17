<!-- Sample script to print out pet data from database - you can run at testuser2.psjconsulting.com/getallpetdata.php -->
<!-- put the table header in HTML and then print the rest from PHP -->
<table width="639" height="66" border = "0" cellpadding = "0" cellspacing = "10">
   <tr>
     <td width="73" bgcolor = "#ffffaa">Name </td>
     <td width="72" bgcolor = "#ffffbb">Owner</td>
     <td width="160" bgcolor = "#ffffbb">Telephone</td>
     <td width="103" bgcolor = "#ffffbb">E-mail</td>
     <td width="68" bgcolor = "#ffffbb">Food </td>
     <td width="93" bgcolor = "#ffffcc">Breed</td>
   </tr>

   <tr>
  <?php
		 // Now get all the data
		// Create connection
	$database = new mysqli("localhost", "testuser1", "********", "testuser1_pets");
	    // Check connection
	if ($database->connect_error) {
			die("Connection failed: " . $database->connect_error);
		}
		// first query - get the data, ownerID and FoodID from the Pets table
		if ( !( $mainresult = $database->query ( "SELECT * FROM Pets") ) )
			print ("Warning!   could not execute main query <br />" );
		// Every query through the mysqli interface returns an array of associative arrays - the method fetch_assoc()
		// Pulls the next associative array (corresponding to a row, but with column names associated with each value)
		// and then we have to get the values from each associative array.   Sometimes we use all the values; in this 
		// case we are getting the values using the name of a column (like $row["Name"]) and then setting these as the
		// values of a PHP variable (like $petname)
	    while ($row = $mainresult->fetch_assoc()) {
		 $petname = $row["Name"];	
		 $foodid = $row["Eats"]; 
		 $petbreed = $row["Breed"];
		 $ownerid = $row["OwnerID"];

		 // instead of doing a big join to do everything, we go step by step.    We get the OwnerID from the Pets
		 // table and bind it to the PHP variable $ownerid.    Then we use that to get info from the next table
		 // Now get the owner info (name, tel. and e-mail)
		 if ( !( $result = $database->query ( "SELECT Name,TelNo,EMail FROM PetOwners WHERE OwnerID = '$ownerid'") ) )
			print ("Warning!   could not execute query <br />" );
	     $row = $result->fetch_assoc();
		 $ownername = $row["Name"];
		 $ownertelno = $row["TelNo"];
		 $owneremail = $row["EMail"];

		 // Finally get the name of the food
		 if ( !( $result = $database->query ( "SELECT Name FROM Petfoods WHERE ID = '$foodid'") ) )
			print ("Warning!   could not execute query <br />" );
	     $row = $result->fetch_assoc();
		 $petfood = $row["Name"];
		 //
         // Now just print each form field’s value
		 print( "<td>$petname</td>
			   	  <td>$ownername</td>
				  <td>$ownertelno</td>
				  <td>$owneremail</td>
                  <td>$petfood</td>
                  <td>$petbreed</td></tr>" );
		} // end while
		  
		 // and wrap up the table
		 print("</table><br><br>");

?>

