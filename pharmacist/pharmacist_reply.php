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
        <h4> Welcome, <?php echo $_SESSION['name']; ?>! </h4>
          
      </div>

      <ul class="nav-links">
        <li><a href="index.php">Home</a></li>
        <li><a href="update_pharmacist.php">Profile</a></li>
		<li><a href="Orders.php">Orders</a></li> 
        <li><a href="medicine_reg.php">+ Medicine Reg</a></li>
        <li><a href="view_patients.php">View Patients</a></li>
        <li><a  class="active"href="medical_history.php">Consultation</a></li>  
        <li> <a href="logout.php">Logout</a></li>
      </ul>
    </nav>
      
    <div class="header">
            <h1>RESPONSE TO PATIENT CONSULTATION</h1>
        </div>
      
      
<div class="back">
<ul>
    <li><a  href="medical_history.php"> BACK</a></li>
</ul>
</div>
      
      <div class="first-box"> 

<!-- Form for updating a record -->
<form method="post" action="" enctype="multipart/form-data">
	<?php
// Connect to the database
include_once("../connection.php");

if (isset($_GET['consultation_id'])) {
    // Escape the ID to prevent SQL injection attacks
    $consultation_id = mysqli_real_escape_string($conn, $_GET['consultation_id']);

    // Check if the form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Escape the input values to prevent SQL injection attacks
           
            $health_issue = mysqli_real_escape_string($conn, $_POST['health_issue']);
            $consultation_date = mysqli_real_escape_string($conn, $_POST['consultation_date']);
            $status = "Read";
            $reply = mysqli_real_escape_string($conn, $_POST['reply']);
            $id = $_SESSION['id'];
            $reply_date = date("Y-m-d H:i:s");
		
		 //update query
    
	$sql = "UPDATE consultations SET status='$status', reply='$reply', pharmacist_id= '$id',reply_date='$reply_date' WHERE consultation_id='$consultation_id'";

   if (mysqli_query($conn, $sql)) {
            echo "Record updated successfully.";
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    }

    // Get the record with the given ID from the medicines table
    $sql = "SELECT * FROM consultations WHERE consultation_id='$consultation_id'";
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
	<br>
	
		<label for="ID">ID:</label>
		
		    <input type="text" name="id" value="<?php echo $_GET['consultation_id']; ?>">
          
		
		
        <label for="health_issue">Health Issue:</label><br>
        <input type="text" id="health_issue" name="health_issue" value="<?php echo $row['health_issue']; ?>" readonly><br>
        
        <label for="consultation_date">Consultation date:</label>

		<input type="text" id="consultation_date" name="consultation_date" value="<?php echo $row['consultation_date']; ?>" readonly><br>

		<label for="status">Status:</label><br>
		<input type="text" id="status" name="status" value="<?php echo $row['status']; ?>" readonly><br>

		<label for="Response">Previous Response:</label><br>
        <input type="text" id="Response" name="reply" value="<?php echo $row['reply']; ?>" readonly><br>
        		
        <label for="Response">Response:</label><br>
		<textarea  id="Response" name="reply" value="<?php echo $row['reply']; ?>" ></textarea><br>
		
		<label for="id">Pharmacist ID:</label>
		<input type="text" id="id" name="id" value="<?php echo $_SESSION['id']; ?>" readonly>
	
    <input type="submit" value="Reply">
</form>
      </div>
    </body>
</html>

