		<?php
		// Start session
		session_start();

		//connect to database
		include_once("../connection.php");
		?>




		<!DOCTYPE html>
		<html>
		  <head>
			<meta charset="UTF-8" />
			<meta name="viewport" content="width=device-width, initial-scale=1.0" />
			<link rel="stylesheet" href="../css/style.css" />
			<title>Home</title>
		  </head>

		  <body>

			<nav>

			  <ul class="nav-links">
				<li><a  href="update_pharmacist.php">Profile</a></li>
				<li><a href="Orders.php">Orders</a></li>
				<li><a href="medicine_reg.php"> Medicine Reg</a></li>
				<li><a class="active" href="view_patients.php">View Patient</a></li>
				<li><a href="medical_history.php">Consultation</a></li>  
				<li> <a href="logout.php">Logout</a></li>
			  </ul>
			</nav>
			  
			<div class="header">
					<h1>UPDATE PATIENTS</h1>
				</div>
              
    <div class="back">
        <ul>
    <a href="view_patients.php">
        <button class="inside">Back</button>
    </a>
        </ul>
    </div>
			  
			  <div class="first-box"> 
		<!-- HTML form -->
		<form action="update_patient.php?patient_id=<?php echo $_GET['patient_id']; ?>" method="post">
	<?php
		//check if the form is submitted
		if(isset($_POST['submit'])) {
			$patient_id = mysqli_real_escape_string($conn, $_POST['patient_id']);
			$name = mysqli_real_escape_string($conn, $_POST['name']);
			$surname = mysqli_real_escape_string($conn, $_POST['surname']);
			$username = mysqli_real_escape_string($conn, $_POST['username']);
			$place = mysqli_real_escape_string($conn, $_POST['place']);
			$distance = mysqli_real_escape_string($conn, $_POST['distance']);
			$gender = mysqli_real_escape_string($conn, $_POST['gender']);
			$password = mysqli_real_escape_string($conn, $_POST['password']);
			
			//$location_id = mysqli_real_escape_string($conn, $_POST['location_id']);

			//update query
			$sql = "UPDATE patients SET name='$name', surname='$surname',username='$username', gender='$gender', password='$password' WHERE patient_id='$patient_id'";
			
			$sql1 = "UPDATE locations SET place='$place', distance='$distance' WHERE patient_id='$patient_id'";
			
			//execute the query
			if(mysqli_query($conn, $sql) && mysqli_query($conn, $sql1)) {
				echo "Record updated successfully";
			} else {
				echo "Error updating record: " . mysqli_error($conn);
			}
		}

		// Get patient patient_id from URL parameter
		$patient_id = $_GET['patient_id'];

		// Fetch patient details from database
		//$sql = "SELECT * FROM patients WHERE email='$email'";
	    //$sql = "SELECT place,distance FROM locations WHERE location_id='$location_id'";
		  
			$sql = "SELECT patients.patient_id,patients.name,patients.surname,patients.username,patients.gender, patients.password, locations.place, locations.distance FROM patients 
        INNER JOIN locations ON patients.patient_id =locations.patient_id WHERE patients.patient_id='$patient_id'";

		  
  $result = mysqli_query($conn, $sql);

  if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    // ...
  } else {
    echo "Patient not found";
  }
		


		//close the database connection
		mysqli_close($conn);
	?>

	<br>

	<lable>ID:</lable><br>
	<input type="text" id="id" name="patient_id" value="<?php echo $row['patient_id']; ?>" required><br>

	<lable>Name:</lable><br>
	<input type="text" id="name" name="name" value="<?php echo $row['name']; ?>" required><br>

	<lable for="surname">Surname:</lable><br>
	<input type="text" id="surname" name="surname" value="<?php echo $row['surname']; ?>" required><br>

	<lable>Username:</lable><br>
	<input type="text" id="username" name="username" value="<?php echo $row['username']; ?>"required><br>
	
	<lable>Location:</lable><br>
	<input type="text" id="place" name="place" value="<?php echo $row['place']; ?>" required><br>

	<lable>Distance:</lable><br>
	<input type="text" id="distance" name="distance" value="<?php echo $row['distance']; ?>" required><br>

	<lable>Gender:</lable><br>
	<input type="text" id="gender" name="gender" value="<?php echo $row['gender']; ?>" required><br>

	<lable>Password:</lable><br>
	<input type="text" name="password" value="<?php echo $row['password']; ?>"><br>

	<input type="submit" name="submit" value="Update">
</form>
</div>
</body>
</html>