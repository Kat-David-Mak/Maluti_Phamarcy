<?php
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
            <h1>UPDATE PHARMACIST</h1>
    </div>

    <div class="back">
        <ul>
        <button><a href="Pharmacists.php">BACK</a></button>
        </ul>
    </div>
<?php
   

    $id = $_GET['id'];
    $sql="SELECT * FROM pharmacist WHERE pharmacist_id=$id";

    $result = mysqli_query($conn,$sql);

    while($res=mysqli_fetch_array($result))
    {
        $name = $res['name'];
        $surname = $res['surname'];
        $password = $res['password'];
    }

?>
    <div class="first-box">

    <form name="form1" method="post" action="UpdatingPharmacist.php">
            Name <br>
            <input type="text" name="name" value="<?php echo $name;?>">
            <br>
            SURNAME<br>
            <input type="text" name="surname" value="<?php echo $surname;?>">
            <br>
            PASSWORD<br>
            <input type="text" name="password" value="<?php echo $password;?>">
            <input type="hidden" name="pharmacist_id" value="<?php echo $_GET['id'];?>">
            <br>
            <input type="submit" name="update" value="Update">
    </form>
    </div>

    <br>
</body>
</html>


