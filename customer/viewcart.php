<?php
include "authguard.php"; // Ensure the user is authenticated
include "../shared/connection.php"; // Database connection
include "menu.html"; // Include the navigation menu

// Fetch items in the cart
$sql_result = mysqli_query($conn, "SELECT * FROM cart JOIN product ON cart.pid=product.pid WHERE userid=$_SESSION[userid]");

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
        .alert {
            color: green;
            font-weight: bold;
            margin: 10px;
        }
        .customer-details {
            margin: 20px 0;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .customer-details h3 {
            margin-bottom: 10px;
        }
        .customer-details div {
            margin-bottom: 10px;
        }
        .customer-details label {
            font-weight: bold;
        }
    </style>
</head>
<body>

<h1>Your Cart</h1>

<?php if (isset($_GET['message'])): ?>
    <div class="alert"><?php echo htmlspecialchars($_GET['message']); ?></div>
<?php endif; ?>

<form action="placeorder.php" method="POST">
    <?php
    while ($dbrow = mysqli_fetch_assoc($sql_result)) {
        echo "
        <div class='pdt'>
            <div class='name'>{$dbrow['name']}</div>
            <div class='price'>{$dbrow['price']}</div>
            <img class='pdt-img' src='{$dbrow['impath']}' alt='Product Image'>
            <div>{$dbrow['detail']}</div>
            <input type='hidden' name='pids[]' value='{$dbrow['pid']}'>
            <div class='text-center'>
                <a href='removecart.php?pid={$dbrow['pid']}'>
                    <button type='button' class='btn btn-danger'> Remove from Cart </button>
                </a>
            </div>
        </div>";
    }
    ?>
    
    <div class="customer-details">
        <h3>Customer Details</h3>
        <div>
            <label for="customer_name">Customer Name:</label>
            <input type="text" id="customer_name" name="customer_name" required>
        </div>
        
        <div>
            <label for="complete_address">Complete Address:</label>
            <textarea id="complete_address" name="complete_address" rows="3" required></textarea>
        </div>

        <div>
            <label for="payment_option">Payment Option:</label>
            <select id="payment_option" name="payment_option" required>
                <option value="Credit Card">Credit Card</option>
                <option value="Debit Card">Debit Card</option>
                <option value="Cash on Delivery">Cash on Delivery</option>
                <option value="Net Banking">Net Banking</option>
            </select>
        </div>
    </div>

    <button type="submit" class="btn btn-success">Place Order</button>
</form>

</body>
</html>


