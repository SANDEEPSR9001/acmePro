<?php

$cartid=$_GET['cartid'];
echo "REceived pid=$pid";

include "../shared/connection.php";

mysqli_query($conn,"delete from cart where cartid=$cartid");

header("location:viewcart.php");

?>