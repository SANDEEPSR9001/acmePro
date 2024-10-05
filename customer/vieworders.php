<?php
include "authguard.php";  
include "../shared/connection.php";  
include "menu.html";  

// Query to fetch orders along with product details
$sql_result = mysqli_query($conn, "SELECT orders.order_id, orders.order_date, product.name, product.price, product.impath, product.detail 
                                    FROM orders 
                                    JOIN product ON orders.pid = product.pid 
                                    WHERE orders.userid = {$_SESSION['userid']}");

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
        .order-date {
            font-size: 14px;
            color: gray;
        }
        .cancel-button {
            margin-top: 10px;
        }
    </style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

<h1>Your Orders</h1>

<?php
if (mysqli_num_rows($sql_result) > 0) {
    while ($dbrow = mysqli_fetch_assoc($sql_result)) {
        echo "
        <div class='pdt'>
            <div class='name'>{$dbrow['name']}</div>
            <div class='price'>{$dbrow['price']}</div>
            <img class='pdt-img' src='{$dbrow['impath']}' alt='Product Image'>
            <div>{$dbrow['detail']}</div>
            <div class='order-date'>Order Date: {$dbrow['order_date']}</div>
            <div class='text-center'>
                <a href='cancelorder.php?order_id={$dbrow['order_id']}' class='cancel-button'>
                    <button class='btn btn-danger'>Cancel Order</button>
                </a>
            </div>
        </div>";
    }
} else {
    echo "<div class='alert alert-info'>No orders placed yet.</div>";
}
?>

</body>
</html>
