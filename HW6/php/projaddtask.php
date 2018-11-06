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

	<p>Results of adding an employee</p>

  <table width="800">
    <tr>
      <th>New Project Name</th>
      <th>Employee First Name</th>
      <th>Employee Last Name</th>
      <th>Employee Title</th>
      <th>Employee Department Name</th>
    </tr>

		<tr>
			<?php
	      print("
          <td>$project_name</td>
          <td>$empfname</td>
          <td>$emplname</td>
          <td>$emptitle</td>
          <td>$empdepname</td>
	      ");
		  ?>
		</tr>
	</table>

	<br /><br />
	<a href="project_employee.php">add an employee to this project</a>
	<br />
	
	<?php
		$database = new mysqli("localhost", "tdbrooks", "tdbrooks38", "tdbrooks");

		if ($database->connect_error){
			die("Connection failed: " . $database->connect_error);
		}

		$query = "INSERT INTO Project " .
		"( Project_name, Project_id_no, Project_due_date, Supervisor_id ) " .
		"VALUES ( '$project_name','$project_id','$project_due_date','$supervisor_id' )" ;

		if ( !( $result = $database->query ( $query ))) {
			die ( "Could not execute query! " . $database->connect_error );
		}
	?>



	</body>