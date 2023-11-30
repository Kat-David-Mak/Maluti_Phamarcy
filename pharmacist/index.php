<?php
// Start session
session_start();

// Check if user is already logged in
if (isset($_SESSION['id'])) {
    header("Location: Orders.php");
    exit();
}

// Include database connection file
include_once("../connection.php");

// Check if form submitted
if (isset($_POST['submit'])) {
    // Validate input
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username)) {
        $error_msg = "Please enter a username.";
    } elseif (empty($password)) {
        $error_msg = "Please enter a password.";
    } else {
        // Query the database to get the user
        $result = mysqli_query($conn, "SELECT * FROM pharmacist WHERE username ='$username' AND password='$password' AND status='Active'");

        if ($result && mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result);
            $id = $row['pharmacist_id'];
            $name = $row['name'];

            // Store the user's id and name in the session
            $_SESSION['id'] = $id;
            $_SESSION['name'] = $name;

            // Redirect to dashboard page
            header("Location: dashboard.php");
            exit();
        } else {
            if ($result && mysqli_num_rows($result) == 0) {
                $error_msg = "Your account is blocked. Please contact the administrator.";
            } else {
                $error_msg = "Invalid login credentials. Please try again.";
            }
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
   
    
        <h1>Maluti Pharmacy</h1>

            <div class="first-box">
                         
                <a href="../index.php">
                <button>Back</button> 
                </a> 
                
    <?php if (isset($error_msg)) { ?>
        <div><?php echo $error_msg; ?></div>
    <?php } ?>
    
            <h2>Pharmacist Login</h2>          
            <form method="post" action="index.php">
                <label for="fname">Username</label>
                <input type="text" name="username" placeholder="Please Enter username.."  required>
            
                <label for="lname">Password</label>
                <input type="password" name="password" required placeholder="Please Enter Your password.." required>

                <input type="submit" name="submit" value="Login">
            </form>
                    
        </div>   
</body>
</html>
