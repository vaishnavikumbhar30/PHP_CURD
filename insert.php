<?php

include 'connect.php';


extract($_POST);


if(isset($_POST['nameSend']) && isset($_POST['priceSend']) 
   && isset($_POST['categorySend'])){


 $sql = "insert into `crud` (name, price ,category)
   values ('$nameSend', '$priceSend', '$categorySend')";

 
   $result = mysqli_query($con, $sql);
}

?>