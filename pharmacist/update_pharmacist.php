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
        <li><a class="active" href="update_pharmacist.php">Profile</a></li>
		<li><a href="Orders.php">Orders</a></li> 
        <li><a href="medicine_reg.php"> Medicine Reg</a></li>
        <li><a href="view_patients.php"> View Patients</a></li>
        <li><a href="medical_history.php">Consultation</a></li>  
        <li> <a href="logout.php">Logout</a></li>
      </ul>
    </nav>
      
    <div class="header">
            <h1>Edit PHARMACIST</h1>
        </div>
      
      <div class="first-box"> 
<!-- HTML form -->
<form action="" method="post">
<?php


//check if the form is submitted
if(isset($_POST['submit'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $surname = mysqli_real_escape_string($conn, $_POST['surname']);
	$username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    //update query
    $sql = "UPDATE pharmacist SET name='$name', surname='$surname', username='$username' password='$password' WHERE pharmacist_id=$id";

    //execute the query
    if(mysqli_query($conn, $sql)) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

// Get pharmacist ID from session
$id = $_SESSION['id'];

// Fetch pharmacist details from database
$sql = "SELECT * FROM pharmacist WHERE pharmacist_id=$id";
$result = mysqli_query($conn, $sql);

if($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
} else {
    echo "Pharmacist not found";
}

//close the database connection
mysqli_close($conn);
?>

<br>
    <lable>ID:</lable>
    <br>
    <input type="text" name="id" value="<?php echo $row['pharmacist_id']; ?>" readonly><br>
    <lable>Name:</lable>
    <br>
    <input type="text" name="name" value="<?php echo $row['name']; ?>"><br>

    <lable>Surname:</lable>
    <br>
    <input type="text" name="surname" value="<?php echo $row['surname']; ?>"><br>
	
    <lable>Username:</lable>
    <br>
    <input type="text" name="username" value="<?php echo $row['username']; ?>"><br>
    <lable>Password:</lable>
    <br>
    <input type="text" name="password" value="<?php echo $row['password']; ?>"><br>

    <input type="submit" name="submit" value="Update">
</form>
</div>
</body>
</html>