<?php
session_start();
include "../shared/connection.php";

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    // SQL query to delete the order
    $query = "DELETE FROM orders WHERE order_id = '$order_id' AND userid = {$_SESSION['userid']}";
    
    if (mysqli_query($conn, $query)) {
        $_SESSION['message'] = "Order cancelled successfully!";
    } else {
        $_SESSION['message'] = "Error cancelling order: " . mysqli_error($conn);
    }
}

// Redirect back to the orders page
header("Location: vieworders.php");
exit();
?>
