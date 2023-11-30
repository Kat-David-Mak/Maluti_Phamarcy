<?php
    session_start();
?>

<html>
<body>

<?php

include_once("../conn.php");


$temporary_id = $_GET ['id'];

$sql = "DELETE FROM temporary_orders WHERE temporary_id = $temporary_id";

$result = mysqli_query($conn, $sql);

header("location: Cart.php");
?>
</body>
</html>