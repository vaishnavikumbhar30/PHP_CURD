<?php

include 'connect.php';

if(isset($_POST['updateid'])){
    $user_id=$_POST['updateid'];

    $sql="select * from `crud` where id=$user_id ";
    $result=mysqli_query($con,$sql);
    $response=array();
    while($row=mysqli_fetch_assoc($result)){
        $response=$row;
    }
    echo json_encode($response);
}else{
    $response['status']=200;
    $response['message']="invalid data not found";
}




// update query 

if (isset($_POST['hiddendata'])){
    $uniqueid=$_POST['hiddendata'];
    $name=$_POST['updatename'];
    $price=$_POST['updateprice'];
    $category=$_POST['updateCategory'];


 $sql="update `crud` set name='$name', price='$name', category='$category' where id=$uniqueid";

 $result=mysqli_query($con, $sql);

}


?>