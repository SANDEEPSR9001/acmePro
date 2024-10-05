<?php
include "../shared/connection.php"; 
include "authguard.php"; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);
    $complete_address = mysqli_real_escape_string($conn, $_POST['complete_address']);
    $payment_option = mysqli_real_escape_string($conn, $_POST['payment_option']);
    
    foreach ($_POST['pids'] as $pid) {
        
        $sql = "INSERT INTO orders (pid, userid, order_date, customer_name, complete_address, payment_option) 
                VALUES ('$pid', '$_SESSION[userid]', NOW(), '$customer_name', '$complete_address', '$payment_option')";
        mysqli_query($conn, $sql);
    }

   
    mysqli_query($conn, "DELETE FROM cart WHERE userid = $_SESSION[userid]");
    
    
    header("Location: viewcart.php?message=Order placed successfully!");
    exit();
}
?>
