<?php
include "../shared/connection.php"; // Database connection
include "authguard.php"; // Ensure the user is authenticated

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);
    $complete_address = mysqli_real_escape_string($conn, $_POST['complete_address']);
    $payment_option = mysqli_real_escape_string($conn, $_POST['payment_option']);
    
    foreach ($_POST['pids'] as $pid) {
        // Insert order details into the orders table
        $sql = "INSERT INTO orders (pid, userid, order_date, customer_name, complete_address, payment_option) 
                VALUES ('$pid', '$_SESSION[userid]', NOW(), '$customer_name', '$complete_address', '$payment_option')";
        mysqli_query($conn, $sql);
    }

    // Optionally clear the cart after placing the order
    mysqli_query($conn, "DELETE FROM cart WHERE userid = $_SESSION[userid]");
    
    // Redirect to view cart with a success message
    header("Location: viewcart.php?message=Order placed successfully!");
    exit();
}
?>
