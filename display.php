<?php

include 'connect.php';


// this is for display data in table format 

if(isset($_POST['displaySend'])){
    // this is table header
    $table=
    '<table class="table">
    <thead class="table-dark">
    <tr>
    <th scope="col">SL NO</th>
    <th scope="col">Name</th>
    <th scope="col">Price</th>
    <th scope="col">category</th>
    <th scope="col">operations</th>
    </tr>
    </thead>';


// query for selecting all the data from database
    $sql= "select * from `crud`";
    // executing the query
    $result=mysqli_query($con,$sql);
    $number=1;

    // using while loop using fetch assoc method accessing the data from database and that data storing in variable
    while($row =mysqli_fetch_assoc($result)){
        $id=$row['id'];
        $name=$row['name'];
        $price=$row['price'];
        $category=$row['category'];

        $table.=
        '<tr>
        <td scope="row">'.$number.'</td>
        <td scope="row">'.$name.'</td>
        <td scope="row">'.$price.'</td>
        <td scope="row">'.$category.'</td>
        <td>
        <button class="btn btn-dark"
            onclick="GetDetails ('.$id.')">Update</button>
        <button class="btn btn-danger" 
            onclick="DeleteUser('.$id.')">Delete</button>
        </td>
        </tr>';
        $number++;
}

$table.='</table>';
echo $table;
}


?>




