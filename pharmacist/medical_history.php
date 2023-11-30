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
        <li><a href="view_patients.php">View Patients</a></li>
        <li><a class="active" href="medical_history.php">Consultation</a></li>  
        <li> <a href="logout.php">Logout</a></li>
      </ul>
    </nav>
      
    <div class="header">
            <h1>PATIENT MEDICAL HISTORY</h1>
        </div>
      <?php
// Include database connection file
include_once("../connection.php");

// Select all rows from the medicines table
$sql = "SELECT * FROM consultations";
$result = mysqli_query($conn, $sql);

// Check if any rows were returned
if (mysqli_num_rows($result) > 0) {
    // Start an HTML table to display the data
    echo "<table id=\"table\">";
    echo "<tr><th>ID</th><th>Health Issue</th><th>consultation_date</th><th>Status</th><th>Reply</th></tr>";
    // Loop through each row and output the data
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['consultation_id'] . "</td>";		
        echo "<td>" . $row['health_issue'] . "</td>";
        echo "<td>" . $row['consultation_date'] . "</td>";
		echo "<td>" . $row['status'] . "</td>";
		echo "<td><a href='pharmacist_reply.php?consultation_id=" . $row['consultation_id'] . "'>Reply</a></td>";
	   echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No patients consultation found.";
}

// Close the database connection
mysqli_close($conn);

?>
</body>
</html>
