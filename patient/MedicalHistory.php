<?php
    session_start();
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
    <li><a  href="Dashboard.php">Home</a></li>  
    <li><a href="Cart.php">View Cart</a></li>
    <li><a href="Orders.php">Orders</a></li>
    <li><a href="Consultation.php">Consultation</a></li> 
    <li><a class="active" href="MedicalHistory.php">Medical History</a></li>
    <li> <a href="PatientLogout.php">Logout</a></li> 
    </ul>
</nav>
      
<div class="header">
    <h1>MEDICAL HISTORY</h1>
</div>       

<?php
include_once("../connection.php");
$patient_id = $_SESSION['patient_id'];
$sql = "SELECT * FROM orders where patient_id = '$patient_id' AND status = 'delivered'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0)
{
echo "<table id=\"table\">";
echo "<tr><th>Medicine</th><th>Date</th><th>Price</th></tr>";
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $row['medicine_names'] . "</td>";
    echo "<td>" . $row['date'] . "</td>";
    echo "<td>" . $row['price'] . "</td>";
    echo "</tr>";
}
echo "</table>";
} else {  
    echo "No Medical History";
}
mysqli_close($conn);

?>
<br>
</body>

</html>