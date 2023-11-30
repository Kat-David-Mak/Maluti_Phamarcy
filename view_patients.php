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
      <div class="heading">
        <h4>Welcome, <?php echo $_SESSION['name']; ?>! </h4>
          
      </div>

      <ul class="nav-links">
        <li><a href="index.php">Home</a></li>
        <li><a href="update_pharmacist.php">Edit Profile</a></li>
		<li><a href="Orders.php">Orders</a></li> 
        <li><a href="medicine_reg.php">Medicine Reg</a></li>
        <li><a class="active" href="view_patients.php">Patient List</a></li>
        <li><a href="medical_history.php">Patient Medical History</a></li>  
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
		include_once("../conn.php");

		$valid = true; // Initialize validation flag as true

		// Validate id field
		if(empty($_POST['patient_id'])) {
			//echo "Please enter your ID.<br>";
			$valid = false;
		} elseif(!ctype_digit($_POST['patient_id'])) {
			echo "ID should contain only digits.<br>";
			$valid = false;
		} elseif(strlen($_POST['patient_id']) != 6) {
			echo "ID should be at least 6 digits long.<br>";
			$valid = false;
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

		// Validate email field
		if(empty($_POST['email'])) {
			//echo "Please enter your email.<br>";
			$valid = false;
		} elseif(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			echo "Invalid email format.<br>";
			$valid = false;
		} else {
			$email = $_POST['email'];
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
    $stmt = $conn->prepare("INSERT INTO patients (patient_id, name, surname, gender, password) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt1 = $conn->prepare("INSERT INTO locations (patient_id, place, distance) VALUES (?, ?, ?)");

    if ($stmt !== false && $stmt1 !== false)  {
        // bind parameters
        $stmt->bind_param('isssss', $patient_id, $name, $surname, $email, $gender, $password);
        $stmt1->bind_param('iss', $patient_id, $place, $distance);
        
        // execute query
        try {
            $conn->begin_transaction();
            if ($stmt->execute() && $stmt1->execute()) {
                $conn->commit();
                echo "New record created successfully" .$email;
            } else {
                throw new Exception("Error When Registering, Please Try Again");
            }
        } catch (Exception $e) {
            $conn->rollback();
            echo "Registration Error, Please Try Again";
        }
    }
}

?>  
        <br>
		<label for="id">ID:</label><br>
		<input type="text" id="id" name="patient_id" required><br>

		<label for="name">Name:</label><br>
		<input type="text" id="name" name="name" required><br>

		<label for="surname">Surname:</label><br>
		<input type="text" id="surname" name="surname" required><br>

		
        <label for="place">Location:</label><br>
		<input type="text" id="place" name="place" required><br>
        <label for="distance">Distance:</label><br>
		<input type="number" id="distance" name="distance" required><br>

		<label for="gender">Gender:</label><br>
		<select id="gender" name="gender" required>
			<option value="">Select gender</option>
			<option value="M">Male</option>
			<option value="F">Female</option>
			<option value="O">Other</option>
		</select><br>

		<label for="password">Password:</label><br>
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
    echo "<table id=\"customers\">";
    echo "<tr><th>ID</th><th>Name</th><th>Surname</th><th>Gender</th><th>Password</th><th>Update</th><th>Delete</th></tr>";
    // Loop through each row and output the data
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['patient_id'] . "</td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['surname'] . "</td>";
       
		echo "<td>" . $row['gender'] . "</td>";
		echo "<td>" . $row['password'] . "</td>";
		echo "<td><a href='update_patient.php?patient_id=" . $row['patient_id'] . "'>Update</a></td>";
        //echo "<td><a href='delete_patients.php?patient_id=" . $row['patient_id'] . "' onclick='return confirm(\"Are you sure you want to delete this record?\");'>Delete</a></td>";
        
		
	
        echo "<td><a href='delete_patients.php?patient_id=" . $row['patient_id'] . "' onclick='return confirm(\"Are you sure you want to delete this record?\");'>Delete</a></td>";
        
		echo "</tr>";
		
		
	
    }
    echo "</table>";
} else {
    echo "No patients found.";
}

// Close the database connection
mysqli_close($conn);

?>
      
</body>
</html>      

