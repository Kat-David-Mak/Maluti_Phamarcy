<?php
    session_start();

    include_once '../connection.php';

    $id = $_GET ['id'];

    if ($id != '')
    {
        $sql = "UPDATE pharmacist set status='blocked' WHERE pharmacist_id = $id";

        $result = mysqli_query($conn, $sql);
    
        echo"Successfully Blocked"; 
    }     
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/style.css" />
  </head>

  <body>

    <nav>
      <div class="heading">
        <h4>Maluti Pharmacy</h4>
          
      </div>

      <ul class="nav-links">
      <li><a href="Dashboard.php">Home</a></li>
        <li><a href="Admins.php">Admins</a></li>
        <li><a href="Pharmacists.php">Pharmacists</a></li>  
        <li><a href="AdminLogout.php">Logout</a></li>
      </ul>
    </nav>
      
        <div class="header">
            <h1>PHARMACISTS ACCOUNTS</h1>
        </div>  

    <div class="back">
        <ul>
            <button><a href="RegistrationPharmacist.php">Add Pharmacist</a></button> ||  <button><a href="BlockedPharmacists.php">Blocked Accounts</a></button>
        </ul>
      
    </div>

    <?php
    $sql= "SELECT * FROM Pharmacist WHERE status = 'active'";

    $result= mysqli_query($conn,$sql) or die("bad query");

    echo "<table id=\"table\">";
    echo "<tr><th> Pharmacist ID</th><th> Name</th> <th> Surname</th><th> Password</th><th> Update Account</th><th> Block Account</th><th> Delete Account</th></tr>";
    while ($row =mysqli_fetch_assoc($result)) {
    echo "<tr><td> {$row['pharmacist_id']} </td><td> {$row['name']}</td> <td> {$row['surname']}</td><td> {$row['password']}</td>
    <td><a href='UpdatePharmacist.php?id=$row[pharmacist_id]'>Update</a></td>
    <td><a href='BlockPharmacist.php?id=$row[pharmacist_id]'>Block</a></td>
    <td><a href='DeletePharmacist.php?id=$row[pharmacist_id]' >Delete</a></td></tr>";
    }
            
    echo"</table>";
    ?>

    <br>
</body>
</html>