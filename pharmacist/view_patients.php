<?php
    // Start session
    session_start();

    // Check if user is logged in
    if (!isset($_SESSION['id'])) {
       header("Location: index.php");
       exit();
    }
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
        <li><a href="update_pharmacist.php">Profile</a></li>
        <li><a href="Orders.php">Orders</a></li>
        <li><a href="medicine_reg.php">Medicine Reg</a></li>
        <li><a class="active" href="view_patients.php">View Patients</a></li>
        <li><a href="medical_history.php">Consultation</a></li>  
        <li> <a href="logout.php">Logout</a></li>
      </ul>
    </nav>
      
    <div class="header">
            <h1>REGISTER PATIENTS</h1>
        </div>
      
          
      <div class="first-box">
	<form action="view_patients.php" method="POST">
        
        
        	 <?php
	 //including the database connection file
		include_once("../connection.php");

		$valid = true; // Initialize validation flag as true

		// Validate id field
		if(empty($_POST['patient_id'])) {
			//echo "Please enter your ID.<br>";
			$valid = true;
		} else {
			$patient_id = $_POST['patient_id'];
		}

		// Validate name field
		if(empty($_POST['name'])) {
			//echo "Please enter your name.<br>";
			$valid = false;
		} elseif(!preg_match("/^[a-zA-Z ]*$/", $_POST['name'])) {
			echo "Name should contain only letters and white spaces.<br>";
			$valid = false;
		} else {
			$name = $_POST['name'];
		}

		// Validate surname field
		if(empty($_POST['surname'])) {
			//echo "Please enter your surname.<br>";
			$valid = false;
		} elseif(!preg_match("/^[a-zA-Z ]*$/", $_POST['surname'])) {
			echo "Surname should contain only letters and white spaces.<br>";
			$valid = false;
		} else {
			$surname = $_POST['surname'];
		}
		
	   // Validate username field
		if(empty($_POST['username'])) {
			//echo "Please enter your surname.<br>";
			$valid = false;
		} elseif(!preg_match("/^[a-zA-Z ]*$/", $_POST['username'])) {
			echo "Username should contain only letters and white spaces.<br>";
			$valid = false;
		} else {
			$username = $_POST['username'];
		}

		
        
      		// Validate location field
		if(empty($_POST['place'])) {
			//echo "Please enter your place.<br>";
			$valid = false;
		} elseif(!preg_match("/^[a-zA-Z ]*$/", $_POST['place'])) {
			echo "place should contain only letters and white spaces.<br>";
			$valid = false;
		} else {
			$place = $_POST['place'];
		}

        // Validate distance field
        if(empty($_POST['distance'])) {
           // echo "Please enter your distance.<br>";
            $valid = false;
        } elseif(!is_numeric($_POST['distance'])) {
            echo "Distance should contain only numbers.<br>";
            $valid = false;
        } else {
            $distance = $_POST['distance'];
        }

		
		      // Validate gender field
        if(empty($_POST['gender'])) {
            //echo "Please enter your gender.<br>";
            $valid = false;
        } elseif(!preg_match("/^[a-zA-Z ]*$/", $_POST['gender'])) {
            echo "gender should contain only letters and white spaces.<br>";
            $valid = false;
        } else {
            $gender = $_POST['gender'];
        }
		
      
		  // Validate password field
        if(empty($_POST['password'])) {
           // echo "Please enter your password.<br>";
            $valid = false;
        } elseif(strlen($_POST['password']) != 8) {
            echo "Password should be 8 characters long.<br>";
            $valid = false;
        } else {
$password = $_POST['password'];
}

$status = "Pending...";
        
if ($valid) {
    // Insert data into database
    $stmt = $conn->prepare("INSERT INTO patients (patient_id, name, surname, username, gender, password) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt1 = $conn->prepare("INSERT INTO locations (patient_id, place, distance) VALUES (?, ?, ?)");

    if ($stmt !== false && $stmt1 !== false)  {
        // bind parameters
        $stmt->bind_param('isssss', $patient_id, $name, $surname, $username, $gender, $password);
        $stmt1->bind_param('sss', $patient_id, $place, $distance);
        
        // execute query
        try {
            $conn->begin_transaction();
            if ($stmt->execute() && $stmt1->execute()) {
                $conn->commit();
                echo "New record created successfully" .$patient_id;
            } else {
                throw new Exception("Error When Registering, Please Try Again");
            }
        } catch (Exception $e) {
            $conn->rollback();
        }
    }
}

?>  
        <br>
		<lable>ID:</lable><br>
		<input type="text" id="id" name="patient_id" required><br>

		<lable>Name:</lable><br>
		<input type="text" id="name" name="name" required><br>

		<lable>Surname:</lable><br>
		<input type="text" id="surname" name="surname" required><br>

		<lable>Username:</lable><br>
		<input type="text" id="username" name="username" required><br>
        <lable>Location:</lable><br>
		<input type="text" id="place" name="place" required><br>
        <lable>Distance:(km)</lable><br>
		<input type="number" id="distance" name="distance" required><br>

		<lable>Gender:</lable><br>
		<select id="gender" name="gender" required>
			<option value="">Select gender</option>
			<option value="M">Male</option>
			<option value="F">Female</option>
			<option value="O">Other</option>
		</select><br>

		<lable>Password:</lable><br>
		<input type="password" id="password" name="password" required><br><br>

		<input type="submit" value="submit">
	</form>
      </div>
      
          <div class="header">
            <h1>VIEW PATIENTS</h1>
        </div>
</body>
</html>
	  
<?php
// Include database connection file
//include_once("conn.php");


// Select all rows from the medicines table
$sql = "SELECT * FROM patients";
$result = mysqli_query($conn, $sql);

// Check if any rows were returned
if (mysqli_num_rows($result) > 0) {
    // Start an HTML table to display the data
    echo "<table id=\"table\">";
    echo "<tr><th>ID</th><th>Name</th><th>Surname</th><th>Username</th><th>Gender</th><th>Password</th><th>Update</th><th>Delete</th></tr>";
    // Loop through each row and output the data
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['patient_id'] . "</td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['surname'] . "</td>";
		echo "<td>" . $row['username'] . "</td>";
		echo "<td>" . $row['gender'] . "</td>";
		echo "<td>" . $row['password'] . "</td>";
		echo "<td><a href='update_patient.php?patient_id=" . $row['patient_id'] . "'>Update</a></td>";
        //echo "<td><a href='delete_patients.php?email=" . $row['email'] . "' onclick='return confirm(\"Are you sure you want to delete this record?\");'>Delete</a></td>";
        
		
	
        echo "<td><a href='delete_patients.php?patient_id=" . $row['patient_id'] . "' onclick='return confirm(\"Are you sure you want to delete this record?\");'>Delete</a></td>";
        
		echo "</tr>";
		
		
	
    }
    echo "</table>";
} else {
    echo "No Patients found.";
}

// Close the database connection
mysqli_close($conn);

?>
      
</body>
</html>      

