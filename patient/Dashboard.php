<?php
    session_start();
    $patient_id = $_SESSION['patient_id'];
    
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
    <li><a class="active" href="Dashboard.php">Home</a></li>  
    <li><a href="Cart.php">View Cart</a></li>
    <li><a href="Orders.php">Orders</a></li>
    <li><a href="Consultation.php">Consultation</a></li> 
    <li><a href="MedicalHistory.php">Medical History</a></li>
    <li> <a href="PatientLogout.php">Logout</a></li> 
    </ul>
</nav>
      
<div class="header">
    <h1>Catalog</h1>
</div>       

<?php
include_once("../connection.php");

$sql="SELECT * FROM medicines WHERE status='available'";

$result = mysqli_query($conn,$sql);

if (mysqli_num_rows($result) > 0)
{
    echo "<table id=\"table\">";
    echo "<tr><th>Description</th><th> Name</th><th> Price</th><th>Display</th><th> </th></tr>";
    while ($row = mysqli_fetch_assoc($result))
    {
        echo "<tr>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['price'] . "</td>";
        echo "<td>" . $row['description'] . "</td>";
        echo "<td><img src='../med/" . $row['medicine_image'] . "' width='200' height='200'></td>";
        echo "<td>
        <FORM id='form' name='form' method='post' action='AddCart.php' >
            <input type='hidden' name='medicine_id' value=" . $row['medicine_id'] . ">
            <input type='hidden' name='name' value=" . $row['name'] . ">
            <input type='hidden' name='price' value=" . $row['price'] . ">
            <input type='submit' name='submit' value='Add to Cart'>
        </FORM>
        </td>";
        echo "</tr>";
    }
    echo"</table>";

}
?>
<br>
</body>

</html>