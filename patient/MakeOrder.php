<?php
    session_start();
?>

<html>
<body>

<?php
include_once("../connection.php");

$patient_id = trim($_SESSION['patient_id']);
$medicine_names = '';
$status = 'pending';

$sql="SELECT * FROM temporary_orders WHERE patient_id = '$patient_id'";
$result = mysqli_query($conn,$sql) or die("bad query");
while($res=mysqli_fetch_array($result))
{
$medicine_name = $res['medicine_name'] . ', ';
$medicine_names .= $medicine_name;
}
$sql="SELECT * FROM locations WHERE patient_id = '$patient_id'";
$result = mysqli_query($conn,$sql) or die("bad query2");
while($res=mysqli_fetch_array($result))
{
	$distance = $res['distance'];
    $charge = ($distance - 10) * 5;
    $location_name = $res['place'];
}


$sql="SELECT SUM(price) AS total FROM temporary_orders WHERE patient_id ='$patient_id'";
$result = mysqli_query($conn,$sql) or die("bad query2");
if($result->num_rows > 0)
{
    $row = $result->fetch_assoc();
    $price = $row['total'];
    $total = $price + $charge;
}
$Date = date('Y-m-d H:i:s');
if($price > 0)
{
    $sql = "INSERT INTO orders (patient_id,medicine_names,date,location_name,price,status)
    VALUES ('$patient_id','$medicine_names','$Date','$location_name','$total','$status')";
}
else {
    header("location: Cart.php");
}

if(mysqli_query($conn, $sql))
{
    $sql = "DELETE FROM temporary_orders WHERE patient_id = '$patient_id'";
    $result = mysqli_query($conn, $sql);

    header("location: Cart.php");
}

?>

</body>
</html>