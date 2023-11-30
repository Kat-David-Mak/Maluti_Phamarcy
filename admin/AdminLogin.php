<?php
// Start session
session_start();

include_once("../connection.php");

// Check if form submitted
if (isset($_POST['submit'])) {
    // Validate input
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $result = mysqli_query($conn, "SELECT * FROM admin WHERE username='$username' AND password='$password'");
    
    

    if ($result && mysqli_num_rows($result) == 1) {
        $id = mysqli_fetch_array($result)['ID'];

        // Create session
        $_SESSION['id'] = $id;

        header("Location: Dashboard.php");
    } else {
        if ($result && mysqli_num_rows($result) == 0) {
            $error_msg = "Invalid login credentials.";
        }
    }
}

?>


<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/login.css" />
    <title>Login</title>
</head>
<body>
    <?php if (isset($error_msg)) { ?>
        <div><?php echo $error_msg; ?></div>
    <?php } ?>
    
        <h1>Maluti Pharmacy</h1>

            <div class="first-box">            
            <a href="../index.php">
            <button>Back</button>    
            </a>   

            <h2>Admin Login</h2>          
            <form method="post" action="AdminLogin.php">
                <label for="adminid">Admin UserName</label>
                <input type="text" name="username" required placeholder="Enter Your Username" >
            
                <label for="password">Password</label>
                <input type="password" name="password" required placeholder="Enter Your password">

                <input type="submit" name="submit" value="Login">
            </form>
                    
        </div>    
    
</body>
</html>
    
    
    