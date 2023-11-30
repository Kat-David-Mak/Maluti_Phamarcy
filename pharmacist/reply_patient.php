<?php
    // Start session
    session_start();

    // Check if user is logged in
    if (!isset($_SESSION['id'])) {
       header("Location: index.php");
       exit();
    }
?>


<?php
// Connect to the database
include_once("conn.php");

if (isset($_GET['id'])) {
    // Escape the ID to prevent SQL injection attacks
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // Check if the form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Escape the input values to prevent SQL injection attacks
		 $id = mysqli_real_escape_string($conn, $_POST['id']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $health_issue = mysqli_real_escape_string($conn, $_POST['health_issue']);
        $consultation_date = mysqli_real_escape_string($conn, $_POST['consultation_date']);
        $status = mysqli_real_escape_string($conn, $_POST['status']);
		$reply = mysqli_real_escape_string($conn, $_POST['reply']);
		$reply_date = mysqli_real_escape_string($conn, $_POST['reply_date']);
		

		// Check if an image file was uploaded
		if ($_FILES['image']['size'] > 0) {
			$target_dir = "uploads/";
			$target_file = $target_dir . basename($_FILES["image"]["name"]);
			$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
			$extensions_arr = array("jpg", "jpeg", "png", "gif");

			// Check if the file extension is valid
			if (in_array($imageFileType, $extensions_arr)) {
				// Upload the file to the server
				move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

				// Update the record with the image file path
				$sql = "UPDATE medicines SET name='$name', price='$price', description='$description', status='$status', medicine_image='".basename($target_file)."' WHERE id='$id'";
			} else {
				// Invalid file type
				echo "Error: Invalid file type.";
				exit();
			}
		} else {
			// No image file uploaded
			$sql = "UPDATE medicines SET name='$name', price='$price', description='$description', status='$status' WHERE id='$id'";
		}


        if (mysqli_query($conn, $sql)) {
            echo "Record updated successfully.";
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    }

    // Get the record with the given ID from the medicines table
    $sql = "SELECT * FROM medicines WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        echo "Record not found.";
        exit();
    }
} else {
    echo "No ID parameter specified.";
    exit();
}

// Close the database connection
mysqli_close($conn);
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
        <h4>Maluti Pharmacy, Welcome,// <?php echo $_SESSION['name']; ?>! </h4>
          
      </div>

      <ul class="nav-links">
        <li><a href="index.php">Home</a></li>
        <li><a href="update_pharmacist.php">Update Profile</a></li>
        <li><a class="active" href="medicine_reg.php">Add Medicine</a></li>
        <li><a href="view_patients.php">ALL Patients</a></li>
        <li><a href="medical_history.php">Patient Medical History</a></li>  
        <li> <a href="logout.php">Logout</a></li>
      </ul>
    </nav>
      
    <div class="header">
            <h1>UPDATE MEDICINE</h1>
        </div>
      
      <div class="first-box"> 

<!-- Form for updating a record -->
<form method="post" action="update_medicine.php?id=<?php echo $_GET['id']; ?>" enctype="multipart/form-data">
    <label for="name">Name:</label>
    <input type="text" name="name" value="<?php echo $row['name']; ?>"><br>
    <label for="price">Price:</label>
    <input type="text" name="price" value="<?php echo $row['price']; ?>"><br>
    <label for="description">Description:</label>
    <textarea name="description"><?php echo $row['description']; ?></textarea><br>
    <label for="status">Status:</label>
	<input type="text" name="status" value="<?php echo $row['status']; ?>"><br>
    <label for="image">Image:</label>
    <input type="file" name="image"><br>
    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
    <input type="submit" value="Update">
	<a  href="medicine_reg.php"> BACK</a>
</form>
      </div>
    </body>
</html>

