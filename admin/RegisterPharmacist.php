<?php
    // Start session
    session_start();

    include_once '../connection.php';
  	
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
        <h1>PHARMACIST REGISTRATION</h1>
    </div>

<div class="back">
<ul>
    <a href="Pharmacists.php">
        <button class="inside">BACK</button>
    </a>  
</ul>
</div>

<div class="first-box">
<form id="form" name="form" method="post" action="RegistrationPharmacist.php">
<?php

    if(isset($_POST['submit']))
    {
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $status = $_POST['status'];
        $password = $_POST['password'];
        
        $sql = "INSERT INTO pharmacist (name,surname,status,password)
	    VALUES ('$name','$surname','$status','$password')";
        if(mysqli_query($conn, $sql))
        {
            echo"Pharmacist Successfuly Registered";
        }
        else
        {
            echo('Error: Pharmacist alredy exist');
        }
    }	
?>
<br>
        <lable>NAME:</lable>
        <br>
        <input type="text" name="name" placeholder="Enter name" required>
        <br>
        <lable>SURNAME:</lable>
        <br>
        <input type="text" name="surname" placeholder="Enter surname" required>
        <br>
        <lable>PASSWORD:</lable>
        <br>
        <input type="password" name="password" placeholder="Enter password" required>
        <input type="hidden" name="status" value="active">
        <br>
        <input type="submit" name="submit" id="submit" value="Submit">
        <br>
</form>
</div>
</body>      
</html>