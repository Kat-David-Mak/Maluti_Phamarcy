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
    <li><a href="Dashboard.php">Home</a></li>  
    <li><a class="active" href="Cart.php">View Cart</a></li>
    <li><a href="Orders.php">Orders</a></li>
    <li><a href="Consultation.php">Consultation</a></li> 
    <li><a href="MedicalHistory.php">Medical History</a></li>
    <li> <a href="PatientLogout.php">Logout</a></li> 
    </ul>
</nav>
      
<div class="header">
    <h1>ITEMS</h1>
</div>       

<?php
include_once("../connection.php");

$sql="SELECT * FROM medicines WHERE status='available'";

$patient_id = $_SESSION['patient_id'];
   
$sql="SELECT * FROM locations WHERE patient_id = '$patient_id'";

$result = mysqli_query($conn,$sql) or die("bad query2");
while($res=mysqli_fetch_array($result))
{
    $distance = $res['distance'];
    $charge = ($distance - 10) * 5;
    $place = $res['place'];
}
$sql="SELECT SUM(price) AS total FROM temporary_orders WHERE patient_id ='$patient_id'";
$result = mysqli_query($conn,$sql) or die("bad query2");
if($result->num_rows > 0)
{
    $row = $result->fetch_assoc();
    $price = $row['total'];
    $totalprice = $price + $charge;
}

$sql= "SELECT * FROM temporary_orders WHERE patient_id ='$patient_id'";
$result= mysqli_query($conn,$sql) or die("bad query");

echo "<table id=\"table\">";
echo "<tr><th> Medicine Name</th><th> Price</th><th> Remove Item</th></tr>";
while ($row =mysqli_fetch_assoc($result)) {
           
    echo "<tr><td> {$row['medicine_name']} </td><td> {$row['price']}</td><td><a href='RemoveItem.php?id=$row[temporary_id]'>Remove</a></td></tr>";
}
if($result->num_rows > 0)
    {
        echo "<tr><td>Delivery Charge</td><td colspan='2'>$charge</td></tr>";
        echo "<tr><td>Total</td><td colspan='2'>$totalprice</td></tr>";
    }
    echo"</table>";
?>

<div> 
    <a href="MakeOrder.php"><button class="pay-button">Order </button></a>  
</div>

<br>
</body>

</html>