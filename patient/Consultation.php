<?php
    session_start();

    include_once("../connection.php");

    $patient_id = $_SESSION['patient_id'];
    $status = 'pending';
    if (isset($_POST['submit']))
    {
        $health_issue = trim($_POST['health_issue']);
        $consultation_date = date('Y-m-d H:i:s');
        $sql = "INSERT INTO consultations (patient_id, health_issue, consultation_date, status)
        VALUES ('$patient_id', '$health_issue', '$consultation_date', '$status')";

        if(mysqli_query($conn, $sql)) {
        echo "Consultation successfully!";

        } else {

        echo "Error: " . $stmt->error;
        }
    }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/style.css" />
    <title>Dashboard</title>
  </head>

  <body>

<nav>
    <ul class="nav-links">
    <li><a href="Dashboard.php">Home</a></li>  
    <li><a href="Cart.php">View Cart</a></li>
    <li><a href="Orders.php">Orders</a></li>
    <li><a class="active" href="Consultation.php">Consultation</a></li> 
    <li><a href="MedicalHistory.php">Medical History</a></li>
    <li> <a href="PatientLogout.php">Logout</a></li> 
    </ul>
</nav>

<div class="first-box">       
			<h1>Consultation</h1>
            <br>
			<form action="consultation.php" method="post">
                
            <lable>Write your Consultation:</lable><br>
            <textarea name="health_issue"></textarea><br>
            <input type="submit" name="submit" value="Consult"> 
			</form>
    </div>
    <br>
<?php
include_once("../connection.php");

$patient_id = $_SESSION['patient_id'];
$sql = "SELECT * FROM consultations WHERE patient_id='$patient_id'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<table id=\"table\">";
    echo "<tr><th>Consultation</th><th>consultation Date</th><th>Status</th><th>Pharmacist response</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $row['health_issue'] . "</td>";
    echo "<td>" . $row['consultation_date'] . "</td>";
    echo "<td>" . $row['status'] . "</td>";
    echo "<td>" . $row['reply'] . "</td>";
    echo "</tr>";
    }
    echo "</table>";
    echo"<br><br><br><br>";
} else {
    echo "No Consultations.";
}

mysqli_close($conn);

?>

<br>
</body>

</html>