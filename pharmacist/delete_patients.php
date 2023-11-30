 
  

<?php

include_once("../connection.php");


$patient_id = $_GET['patient_id'];
$sql="DELETE FROM patients WHERE patient_id= '$patient_id'";
$result = mysqli_query($conn,$sql);
 header("Location: view_patients.php");
echo "$patient_id";
?>

 <script>
  alert("Record Deleted!");
  
 </script>
<br><br>
  
  </body>
 </html>