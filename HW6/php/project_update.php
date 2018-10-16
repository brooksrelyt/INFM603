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

	<p>Hi you have successfully input the project named: <?php print( "$project_name" ); ?></p>

	<p>Additional information can be found in the table below.</p>


  <table width="800">
    <tr>
      <th>New Project Name</th>
      <th>Project ID Number</th>
      <th>Project Due Date</th>
      <th>Supervisor ID Number</th>
    </tr>

		<tr>

			<?php
	      print("
          <td>$project_name</td>
          <td>$project_id</td>
          <td>$project_due_date</td>
          <td>$supervisor_id</td>
	      ");
		  ?>
			</tr>
		</table>
		<br /><br /><br />

		<?php
			$database = new mysqli("localhost", "tdbrooks", "tdbrooks38", "tdbrooks");

			if ($database->connect_error){
				die("Connection failed: " . $database->connect_error);
			}
			
			if ( !( $result = $database->query ( "SELECT Project_id_no FROM Project WHERE Project_name = '$project_name'") ) )
				print ("Warning!   could not execute project name query <br />" );
				$row = $result->fetch_assoc();
				$project_id = $row["Project_id_no"];

			if (! ( $result = $database->query ( "SELECT Supervisor_id FROM Project WHERE Supervisor_id = '$supervisor_id'") ) )
				print ("Warning!   could not execute supervisor query <br />" );
				$row = $result->fetch_assoc();

			if ( $row["Project_id_no"] == 0 ){
				$database->query ("INSERT INTO Project " .
					" ( Project_name, Project_id_no, Project_due_date, Supervisor_id ) " .
					"VALUES ( '$project_name','$project_id','$project_due_date','$supervisor_id' )");
					$ownerid = $database->insert_id;
			} else {
				$project_id = $row["Project_id_no"];
				$database->query ("UPDATE Project SET Project_name = '$project_name', Project_id_no = '$project_id', Project_due_date = '$project_due_date', Supervisor_id = '$supervisor_id' WHERE Project_id_no = '$project_id'");
			}

			$query = "INSERT INTO Projects " .
			"( Project_name, Project_id_no, Project_due_date, Supervisor_id ) " .
			"VALUES ( '$project_name','$project_id','$project_due_date','$supervisor_id' )" ;

			if ( !( $result = $database->query ( $query ) ) ) {
				die ( "Could not execute query! " . $database->connect_error );
			}

		?>



	</body>