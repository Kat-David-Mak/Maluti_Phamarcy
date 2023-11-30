<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/login.css" />
    <title>Login</title>
</head>
<body>
    <?php if (isset($error_msg)) { ?>
        <div><?php echo $error_msg; ?></div>
    <?php } ?>
    
        <h1>Maluti Pharmacy</h1>

            <div class="first-box">
                <a href="../index.php">Back</a></p>   
                
            </div>
             
            <div class="second-box"> 
            <div class="title">Pharmacist Registration</div>          
            <form action="register_phamarsist.php" method="post">
              <label for="id">ID:</label>
              <input type="text" id="id" name="id" required><br><br>

              <label for="name">Name:</label>
              <input type="text" id="name" name="name" required><br><br>

              <label for="surname">Surname:</label>
              <input type="text" id="surname" name="surname" required><br><br>

              <label for="email">Email:</label>
              <input type="email" id="email" name="email" required><br><br>

              <label for="password">Password:</label>
              <input type="password" id="password" name="password" required><br><br>

                <input type="submit" name="submit">

                  <div><label>Already have an account? <a  href="index.php">Sign in</a></label></div>
            </form>
                    
        </div>    
    
</body>
</html>
	  
	  
	 <?php
	 //including the database connection file
        include_once("conn.php");
		
		 $valid = true; // Initialize validation flag as true
		 
		  //if (!ctype_digit($id) || strlen($id) != 6) {
        //$error_msg = "Invalid login ID. Please enter a 6-digit number.";

        // Validate id field
        if(empty($_POST['id'])) {
           // echo "Please enter your ID.<br>";
            $valid = false;
        } elseif(!ctype_digit($_POST['id'])) {
            echo "ID should contain only digits.<br>";
            $valid = false;
        } elseif(strlen($_POST['id']) != 6) {
            echo "ID should be at least 6 digits long.<br>";
            $valid = false;
        } else {
            $id = $_POST['id'];
        }
		
		        // Validate name field
        if(empty($_POST['name'])) {
           // echo "Please enter your name.<br>";
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
		
		
		
	//elseif (empty($password)) {
     //   $error_msg = "Please enter a password.";
   // } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/', $password)) {
    //    $error_msg = "Invalid password. Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, and one number.";
    //} else {
		  // Validate id field
      
		  // Validate password field
        if(empty($_POST['password'])) {
           // echo "Please enter your password.<br>";
            $valid = false;
        } elseif(strlen($_POST['password']) != 8) {
            echo "Password should be at least 8 characters long.<br>";
            $valid = false;
        } elseif(!preg_match('/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[^\w\d\s:])([^\s]){8,}$/m', $_POST['password'])) {
			
			echo "Password should contain at least one uppercase letter, one lowercase letter, one digit, and one special character.<br>";
$valid = false;
} else {
$password = $_POST['password'];
}

$status = "Pending...";

 if ($valid) {
    // Insert data into database
    $stmt = $conn->prepare("INSERT INTO pharmacist (id, name, surname, email, password, status) VALUES (?, ?, ?, ?, ?, ?)");
	


    if ($stmt !== false) {
        // bind parameters
        $stmt->bind_param('isssss', $id, $name, $surname, $email, $password, $status);

        // set parameter values
       // $id = 1; // example value
        //$name = "John"; // example value
       // $surname = "Doe"; // example value
       // $email = "john.doe@example.com"; // example value
       // $password = "password123"; // example value

try {
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        throw new Exception("Error When Registering, Please Try Again");
    }
} catch (Exception $e) {
    echo "Registration Error, Please Try Again";
}
}
 }
  ?>
</form>


  </body>
</html>