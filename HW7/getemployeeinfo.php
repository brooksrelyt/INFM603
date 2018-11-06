<table width="639" height="66" border = "0" cellpadding = "0" cellspacing = "10">
   <tr>
     <td width="" bgcolor = "#ffffaa">Last Name </td>
     <td width="" bgcolor = "#ffffbb">Title</td>
     <td width="" bgcolor = "#ffffbb">Department</td>
     <td width="" bgcolor = "#ffffbb">Department Location</td>
     <td width="" bgcolor = "#ffffbb">Department Phone </td>
     
   </tr>
 
   <tr>
<?php
 
           // Now get all the data
          // Create connection
     $database = new mysqli("localhost", "tdbrooks", "tdbrooks38", "tdbrooks");
         // Check connection
     if ($database->connect_error) {
              die("Connection failed: " . $database->connect_error);
          }
         $Employee_lname = $_REQUEST['Employee_lname'];
          // first query - get the data, ownerID and FoodID from the Pets table
          if ( !( $result = $database->query ( "SELECT Employee_lname,Employee_title,Department_id FROM Employee WHERE Employee_lname = '$Employee_lname'") ) )
              print ("Warning!   could not execute query <br />" );
         $row = $result->fetch_assoc();
          $Employee_lname = $row["Employee_lname"];
          $Employee_title = $row["Employee_title"];
          $Department_id = $row["Department_id"];
 
          // Now get the department info (name, tel. and e-mail)
          if ( !( $result = $database->query ( "SELECT Department_name,Department_location,Department_phone_ext FROM Department WHERE Department_id = '$Department_id'") ) )
              print ("Warning!   could not execute query <br />" );
         $row = $result->fetch_assoc();
          $Department_name = $row["Department_name"];
          $Department_location = $row["Department_location"];
          $Department_phone_ext = $row["Department_phone_ext"];
 
        // Now just print each form field’s value
          print( "<td>$Employee_lname</td>
                     <td>$Department_name</td>
                     <td>$Department_location</td>
                     <td>$Department_phone_ext</td>" );
                    
           // and wrap up the table
           print("</tr></table><br><br>")
 
?>