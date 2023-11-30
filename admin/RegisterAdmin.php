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
            <h1>ADMIN REGISTRATION</h1>
    </div>

<div class="back">
<ul>
    <a href="Admins.php">
        <button class="inside">Back</button>
    </a>
</ul>
</div>

<div class="first-box">

<?php
    
    if(isset($_POST['submit']))
    {
        $ID = $_POST['ID'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $sql = "INSERT INTO admin (ID,first_name,last_name,username,password)
        VALUES ('$ID','$first_name','$last_name','$username','$password')";
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
        
        <lable>ADMIN ID:</lable>
        <br>
        <input type="text" name="ID" placeholder="Enter admin ID" required>
        <br>
        <lable>FIRST NAME:</lable>
        <br>
        <input type="text" name="first_name" placeholder="Enter first name" required>
        <br>
        <lable>LAST NAME:</lable>      
        <br>
        <input type="text" name="last_name" placeholder="Enter last name" required>
        <br>
        <lable>USER NAME:</lable>        
        <br>
        <input type="text" name="username" placeholder="Enter username" required>
        <br>
        <lable>PASSWORD:</lable>        
        <br>
        <input type="password" id="password" name="password" placeholder="Enter password" required>
        <br>
        <input type="submit" name="submit" id="submit" value="Submit">
        <br>	
</form>
</div>
</body>      
</html>