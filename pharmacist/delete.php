  <html>
  <body>
  

<?php

include_once("../conn.php");


$id = $_GET['id'];
$sql="DELETE FROM medicines WHERE medicine_id=$id";
$result = mysqli_query($conn,$sql);
 header("Location: medicine_reg.php");

?>

 <script>
  alert("Record Deleted!");
  
 </script>
 <a href="admindashboard.php">Home</a>
	<br><br>
  
  </body>
 </html>