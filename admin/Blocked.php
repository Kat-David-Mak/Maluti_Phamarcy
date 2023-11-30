<?php
    session_start();

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
            <a href="Pharmacists.php">
                <button class="inside">BACK</button>
            </a>  
        </ul>

    </div>

    <?php
    include_once("../connection.php"); 
    $sql= "SELECT * FROM Pharmacist WHERE status = 'blocked'";

    $result= mysqli_query($conn,$sql) or die("bad query");

    echo "<table id=\"table\">";
    echo "<tr><th> Pharmacist ID</th><th> Name</th> <th> Surname</th><th> Password</th><th> Unblock Account</th></tr>";
    while ($row =mysqli_fetch_assoc($result)) {
    echo "<tr><td> {$row['pharmacist_id']} </td><td> {$row['name']}</td> <td> {$row['surname']}</td><td> {$row['password']}</td>
    <td><a href='UnblockPharmacist.php?id=$row[pharmacist_id]'>Unblock</a></td></tr>";
    }
            
    echo"</table>";
    ?>

    <br>
</body>
</html>