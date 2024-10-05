<?php

session_start();
$_SESSION["login_status"]=false;

$conn=new mysqli("localhost","root","","acmeproject",3306);
$query="select * from user where username='$_POST[username]' and password='$_POST[password1]'";
echo $query;
$sql_result=mysqli_query($conn,$query);


echo"<br>";
print_r($sql_result);
echo"<br>";
if($sql_result->num_rows>0){
    echo "Login Success";
    
    $dbrow=mysqli_fetch_assoc($sql_result);
   
    $_SESSION["login_status"]=true;
    $_SESSION["usertype"]=$dbrow['usertype'];
    $_SESSION["userid"]=$dbrow['userid'];
    $_SESSION["username"]=$dbrow['username'];
   
    echo"<br>";
    print_r($dbrow);
    
    if($dbrow['usertype']=='Vendor'){

        header("location:../vendor/home.php");

    }else if($dbrow['usertype']=='Customer'){

        header("location:../customer/home.php");

    }

}else{
    echo "Login Failed";
}

?>