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
            <a href="RegisterAdmin.php">
                <button class="inside">Add Admin</button>
            </a>
        </ul>
    </div>

    <?php
    include_once("../connection.php"); 
    $sql= "SELECT * FROM admin";

    $result= mysqli_query($conn,$sql) or die("bad query");

    echo "<table id=\"table\">";
    echo "<tr><th> Admin ID</th><th>UserName</th><th> First Name</th> <th> Last Name</th><th> Password</th><th> Delete</th></tr>";
    while ($row =mysqli_fetch_assoc($result)) {
    echo "<tr><td> {$row['ID']} </td><td> {$row['username']} </td><td> {$row['first_name']}</td> <td> {$row['last_name']}</td><td> {$row['password']}</td>
    
    <td><a href='Delete.php?ID=$row[ID]' >Delete Record</a></td></tr>";
    }
            
    echo"</table>";
    ?>

    <br>
</body>
</html>