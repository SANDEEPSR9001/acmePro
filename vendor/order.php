<?php
include "authguard.php"; 
include "../shared/connection.php"; 
include "menu.html"; 

$vendor_id = $_SESSION['userid'];

// Query to fetch orders related to the vendor's products
$sql_result = mysqli_query($conn, "SELECT orders.order_id, orders.order_date, product.name, product.price, product.impath, product.detail, 
                                    orders.userid, orders.customer_name, orders.complete_address, orders.payment_option 
                                    FROM orders 
                                    JOIN product ON orders.pid = product.pid 
                                    WHERE product.owner = $vendor_id");

?>

<html>
<head>
    <style>
        .pdt {
            background-color: bisque;
            display: inline-block;
            margin: 10px;
            padding: 10px;
            width: 300px;
            height: fit-content;
        }
        .pdt-img {
            width: 100%;
            height: 80%;
        }
        .name {
            font-size: 24px;
            font-weight: bold;
            color: blueviolet;
        }
        .price {
            font-size: 25px;
            font-weight: bolder;
        }
        .price::after {
            content: " Rs";
            font-size: 12px;
        }
        .customer-info {
            font-weight: bold;
            color: #555;
            margin: 5px 0;
        }
        .order-details {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<h1>Your Received Orders</h1>

<?php
if (mysqli_num_rows($sql_result) > 0) {
    while ($dbrow = mysqli_fetch_assoc($sql_result)) {
        echo "
        <div class='order-details'>
            <div class='pdt'>
                <div class='name'>{$dbrow['name']}</div>
                <div class='price'>{$dbrow['price']}</div>
                <img class='pdt-img' src='{$dbrow['impath']}' alt='Product Image'>
                <div>{$dbrow['detail']}</div>
                <div class='order-date'>Order Date: {$dbrow['order_date']}</div>
            </div>
            <div class='customer-info'>Customer Name: {$dbrow['customer_name']}</div>
            <div class='customer-info'>Complete Address: {$dbrow['complete_address']}</div>
            <div class='customer-info'>Payment Option: {$dbrow['payment_option']}</div>
        </div>";
    }
} else {
    echo "<div class='alert alert-info'>No orders received yet.</div>";
}
?>

</body>
</html>
