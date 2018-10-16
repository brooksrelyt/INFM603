			// if ( !( $result = $database->query ( "SELECT Project_name FROM Project 
			// 	WHERE (Project_name = '$project_name')")))
			// 	print ("Warning! Could not execute project name query <br />" );
			// 	$row = $result->fetch_assoc();
			// 	$project_name = $row[""];

			// 	if ( $row["Project_name"] == 0 ){ print("Project Name: $project_name is already in the database<br>");
			// 		$database->query("UPDATE Project SET Project_name = '$project_name', Project_id_no = '$project_id', Project_due_date = '$project_due_date' WHERE Project_name = '$project_name'");
			// 	} else {
			// 		$database->query("INSERT INTO Project (Project_name,Project_id_no,Project_due_date,Supervisor_id) VALUES ('$project_name','$project_id','$project_due_date','$supervisor_id')");
			// 			$project_name = $database->insert_id;
			// }

			
if ( !( $result = $database->query ( "SELECT ID FROM Petfoods WHERE Name = '$petfood'") ) )
				print ("Warning!   could not execute food query <br />" );
				$row = $result->fetch_assoc();
				$foodid = $row["ID"];

			if (! ( $result = $database->query ( "SELECT OwnerID FROM PetOwners WHERE Name = '$ownername'") ) )
				print ("Warning!   could not execute owner query <br />" );
				$row = $result->fetch_assoc();

			if ( $row["OwnerID"] == 0 ){
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