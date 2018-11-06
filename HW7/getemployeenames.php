<?php
          // Create connection
          $database = new mysqli("localhost", "tdbrooks", "tdbrooks38", "tdbrooks");
         // Check connection
       if ($database->connect_error) {
        die("Connection failed: " . $database->connect_error);
      }
          if ( !( $result = $database->query ( "SELECT Employee_lname FROM Employee WHERE 1") ) )
              print ("Warning!   could not execute query <br />" );
         while($row = $result->fetch_assoc()) {
              foreach ($row as $value) {
                   print ("<option>$value</option>");     
              }
          }
?>