<?php

session_start();

include "../shared/connection.php";

$pid = $_GET['pid'];
$userid = $_SESSION['userid'];

$query = "DELETE FROM cart WHERE pid = $pid AND userid = $userid";

$result = mysqli_query($conn, $query);

if ($result) {
    header("Location: viewcart.php");
} else {
    echo "Error removing product from cart: " . mysqli_error($conn);
}

?>
