<?php
    session_start();
?>

<html>
<body>

<?php

include_once("../conn.php");

$order_id = $_GET ['order_id'];

$sql = "UPDATE orders set status ='delivered' WHERE order_id = $order_id";

$result = mysqli_query($conn, $sql);

header("location: Orders.php");
?>
</body>
</html>