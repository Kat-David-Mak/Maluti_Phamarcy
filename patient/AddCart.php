<?php
    session_start();
?>

<html>
<body>

<?php
include_once("../connection.php");
if(isset($_POST['submit']))
{
    $patient_id = $_SESSION['patient_id'];
	$name = $_POST['name'];
	$price = $_POST['price'];
	echo "$patient_id";
	$sql = "INSERT INTO temporary_orders (patient_id,medicine_name,price)
	VALUES ('$patient_id','$name','$price')";
        
	if(mysqli_query($conn, $sql))
	{
        
		header("location: Dashboard.php");
	}
    else {
        echo "Something went wrong";
    }
}	
?>

</body>
</html>