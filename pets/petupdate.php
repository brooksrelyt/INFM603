<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
extract ( $_POST );
?>
<!-- petupdate.php                 -->
<!-- Read information sent from petform.html -->

<html xmlns = "http://www.w3.org/1999/xhtml">
   <head>
      <title>Pet Form Validation and Database Update</title>
   </head>

   <body style = "font-family: arial,sans-serif">

      <p>Hi 
         <span style = "color: blue">
            <strong>
               <?php print( "$petname" ); ?>'s owner
            </strong>
         </span>.
         Thank you for telling us about
		 <?php print ("$petname"); ?>
		 .<br />
   
         He/she has been added to the 
         <span style = "color: blue">
            <strong>
               <?php print( "$petbreed " ); ?>
            </strong>
         </span>
         database.
      </p>
      <strong>The following information has been saved 
          in our database:</strong><br />
   
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

               // print each form field’s value
               print( "<td>$petname</td>
			   	  <td>$ownername</td>
				  <td>$ownertelno</td>
				  <td>$owneremail</td>
                  <td>$petfood</td>
                  <td>$petbreed</td>" );
            ?>
         </tr>
      </table>
   
      <br /><br /><br />

	  <?php

		// Create connection
		$database = new mysqli("localhost", "testuser1", "*********", "testuser1_pets");
	    // Check connection
       if ($database->connect_error) {
        die("Connection failed: " . $database->connect_error);
      }
	  	if ( !( $result = $database->query ( "SELECT ID FROM Petfoods WHERE Name = '$petfood'") ) )
			print ("Warning!   could not execute food query <br />" );
	    $row = $result->fetch_assoc();
		$foodid = $row["ID"]; 
	    if (! ( $result = $database->query ( "SELECT OwnerID FROM PetOwners WHERE Name = '$ownername'") ) )
			print ("Warning!   could not execute owner query <br />" );
	    $row = $result->fetch_assoc();
		if ( $row["OwnerID"] == 0 )
			{
				$database->query ("INSERT INTO PetOwners " .
					" ( Name , TelNo , Email ) " .
					"VALUES ( '$ownername' , '$ownertelno' , '$owneremail' )");
				$ownerid = $database->insert_id;
			}
		else
			{
			$ownerid = $row["OwnerID"];
			$database->query ("UPDATE PetOwners SET Name = '$ownername', TelNo = '$ownertelno', Email = '$owneremail' WHERE ID = '$ownerid'");
 	      }
		 // Now that the owner id and food id have both been found, we can add the pet to the pet database
		$query = "INSERT INTO Pets " .
			"( Name , Breed , Eats, OwnerID) " .
			"VALUES ( '$petname' , '$petbreed', '$foodid', '$ownerid' )" ;
		
		if ( !( $result = $database->query ( $query ) ) ) {
			die ( "Could not execute query! " . $database->connect_error );
			}

	  			?>
	  
   </body>
</html>
