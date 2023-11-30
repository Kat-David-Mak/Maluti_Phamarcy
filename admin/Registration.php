<?php
    // Start session
    session_start();

    include_once '../conn.php';
  
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
        <h4>Maluti Pharmacy </h4>
          
      </div>

      <ul class="nav-links">
        <li><a href="Dashboard.php">Home</a></li>
        <li><a href="Admins.php">Admins</a></li>
        <li><a href="Pharmacists.php">Pharmacists</a></li>  
        <li><a href="AdminLogout.php">Logout</a></li>
      </ul>
    </nav>
      
    <div class="header">
            <h1>ADMIN REGISTRATION</h1>
    </div>

<div class="back">
<ul>
    <li><a href="Admins.php">BACK</a></li>
</ul>
</div>

<div class="first-box">

<?php
    
    if(isset($_POST['submit']))
    {
        $ID = $_POST['ID'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $password = $_POST['password'];
        
        $sql = "INSERT INTO admin (ID,first_name,last_name,password)
        VALUES ('$ID','$first_name','$last_name','$password')";
        if(mysqli_query($conn, $sql))
        {
            echo('Admin Successfuly Registered');
        }
        else
        {
            echo('Error: Admin alredy exist');
        }
    }	
?>
<br>
        <form id="form" name="form" method="post" action="Registration.php">
        
        ADMIN ID:
        <br>
        <input type="text" name="ID" placeholder="Enter admin ID" required>
        <br>
        FIRST NAME:<br>
        <input type="text" name="first_name" placeholder="Enter first name" required>
        <br>
        LAST NAME:<br>
        <input type="text" name="last_name" placeholder="Enter last name" required>
        <br>
        PASSWORD:<br>
        <input type="password" id="password" name="password" placeholder="Enter password" required>
        <br>
        <input type="submit" name="submit" id="submit" value="Submit">
        <br>	
</form>
</div>
</body>      
</html>