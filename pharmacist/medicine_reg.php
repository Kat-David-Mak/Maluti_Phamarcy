



<?php
    // Start session
    session_start();
	
	// Include database connection file
include_once("../connection.php");

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
        <li><a class="active" href="medicine_reg.php">Medicine Reg</a></li>
        <li><a href="view_patients.php">View Patients</a></li>
        <li><a href="medical_history.php">Consultation</a></li>  
        <li> <a href="logout.php">Logout</a></li>
      </ul>
    </nav>
      
    <div class="header">
            <h1>REGISTER MEDICINE</h1>
        </div>

    <?php if (isset($error_msg)) { ?>
        <div><?php echo $error_msg; ?></div>
    <?php } elseif (isset($success_msg)) { ?>
        <div><?php echo $success_msg; ?></div>
    <?php } ?>
     <div class="first-box"> 
    <form method="post" action="medicine_reg.php" enctype="multipart/form-data">
	<?php


// Check if form submitted
if (isset($_POST['submit'])) {
    // Validate input
    //$id = trim($_POST['id']);
    $name = trim($_POST['name']);
    $price = trim($_POST['price']);
    $description = trim($_POST['description']);
	$status = "Available";

    // Check if all required fields are filled
    //if (empty($name) || empty($price) || empty($description)) {
        //$error_msg = "Please fill all required fields.";
   // } else {
        // Upload image file
        $image = $_FILES['medicine_image']['name'];
        $target_dir = "../medication/";
        $target_file = $target_dir . basename($image);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowedTypes = array("jpg", "jpeg", "png", "gif");
        if (!in_array($imageFileType, $allowedTypes)) {
            $error_msg = "Invalid image format. Only JPG, JPEG, PNG, and GIF files are allowed.";
        } elseif ($_FILES['medicine_image']['size'] > 10000000) {
            $error_msg = "File size too large. Maximum file size is 10MB.";
        } elseif (move_uploaded_file($_FILES['medicine_image']['tmp_name'], $target_file)) {
            // Insert data into the database
            $sql = "INSERT INTO medicines (medicine_image, name, price, description,status) VALUES ('$image', '$name', '$price', '$description','$status')";
            $success_msg = "Medicine added successfully.";
            try{
                
    if (mysqli_query($conn, $sql)) {
        $success_msg = "Medicine added successfully.";
    } else {
        throw new Exception("Error adding medicine: " . mysqli_error($conn));
    }
} catch (Exception $e) {
    $error_msg = $e->getMessage();
}
        }
   // }
}
?>
	
	<br>
       
        <lable>Medicine Image:</lable>
        <br>
        <input type="file" name="medicine_image" accept="image/*" required><br><br>
        <lable>Name:</lable>
        <br>
        <input type="text" name="name" required><br><br>
        <lable>Price:</lable>
        <br>
        <input type="number" name="price" required min="0"><br><br>
        <lable>Description:</lable>
        <br>
        <textarea name="description" required></textarea><br><br>
        <input type="submit" name="submit">
    </form>
    </div>
      <div class="meds">
          <h1> Available and Unavailable Medicine</h1>
      </div>
      
</body>
</html>
<br>


<?php

// Connect to the database
//$conn = mysqli_connect("localhost", "username", "password", "database_name");

// Check connection


// Select all rows from the medicines table
$sql = "SELECT * FROM medicines";
$result = mysqli_query($conn, $sql);

// Check if any rows were returned
if (mysqli_num_rows($result) > 0) {
    // Start an HTML table to display the data
    echo "<table id=\"table\">";
    echo "<tr><th>ID</th><th>Name</th><th>Price</th><th>Description</th><th>Image</th><th>Status</th><th>Update</th><th>Delete</th></tr>";
    // Loop through each row and output the data
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['medicine_id'] . "</td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['price'] . "</td>";
        echo "<td>" . $row['description'] . "</td>";
        echo "<td><img src='../medication/" . $row['medicine_image'] . "' width='100' height='100'></td>";
		echo "<td>" . $row['status'] . "</td>";
		echo "<td><a href='update_medicine.php?id=" . $row['medicine_id'] . "'>Update</a></td>";
        echo "<td><a href='delete.php?id=" . $row['medicine_id'] . "' onclick='return confirm(\"Are you sure you want to delete this record?\");'>Delete</a></td>";
        

		echo "</tr>";
		 
    }
    echo "</table>";
} else {
    echo "No medicines found.";
}

// Close the database connection
mysqli_close($conn);

?>

