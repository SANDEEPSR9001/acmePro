<!DOCTYPE html>
<html lang="en">
<head>
    

</head>
<body>
    <h1>Customer Home Welcomes You</h1>
</body>
</html>
<html>
    <head>
        <style>
            .pdt{
                background-color: bisque;
                display:inline-block;
                margin:10px;
                padding:10px;
            }
            .pdt-img{
                width: 100%;
                height: 80%;
            }
            .name{
                font-size: 24px;
                font-weight: bold;
                color: blueviolet;
            }
            .price{
                font-size: 25px;
                font-weight: bolder;

            }
            .price::after{
                content:" Rs";
                font-size: 12px;

            }
        </style>
    </head>
</html>    
<?php

include "authguard.php";
include "menu.html";
include "../shared/connection.php";

$sql_result=mysqli_query($conn,"select * from cart join product on cart.pid=product.pid where userid=$_SESSION[userid]");

while($dbrow=mysqli_fetch_assoc($sql_result)){
    echo "<div class='pdt'>
                 <div class='name'>$dbrow[name]</div>
                 <div class='price'>$dbrow[price]</div>
                 <img class='pdt-img' src='$dbrow[impath]'>
                 <div>$dbrow[detail]</div>
                 <div>
                     <div>
                     <a href='removecart.php?pid=$dbrow[pid]'>
                          <button class='btn btn-warning'> Remove from Cart </button>
                     </div>
                 </div>            
        </div>";
}

?>