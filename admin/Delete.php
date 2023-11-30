<?php
    session_start();

    include_once '../connection.php';

    $ID = $_GET ['ID'];
    if ($ID != '')
    {
        $sql = "DELETE FROM admin WHERE ID = $ID";

        $result = mysqli_query($conn, $sql);

        echo"Admin Successfully Deleted";
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
        <li><a href="#">Admins</a></li>
        <li><a href="Pharmacists.php">Pharmacists</a></li>  
        <li><a href="AdminLogout.php">Logout</a></li>
      </ul>
    </nav>
      
        <div class="header">
            <h1>ADMINS ACCOUNTS</h1>
        </div>  

    <div class="back">
        <ul>
            <li><a href="Registration.php">Add Admin</a></li>
        </ul>
    </div>

    <?php
    $sql= "SELECT * FROM admin";

    $result= mysqli_query($conn,$sql) or die("bad query");

    echo "<table id=\"table\">";
    echo "<tr><th> Admin ID</th><th> First Name</th> <th> Last Name</th><th> Password</th><th> Delete</th></tr>";
    while ($row =mysqli_fetch_assoc($result)) {
    echo "<tr><td> {$row['ID']} </td><td> {$row['first_name']}</td> <td> {$row['last_name']}</td><td> {$row['password']}</td>
    
    <td><a href='Delete.php?ID=$row[ID]' >Delete Record</a></td></tr>";
    }
            
    echo"</table>";
    ?>

    <br>
</body>
</html>