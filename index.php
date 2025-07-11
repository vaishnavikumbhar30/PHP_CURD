<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> PHP - CURD</title>

    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Launch demo modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="completeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ADD NEW PRODUCT</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <!--  form input -->
      <div class="mb-3">
          <label for="completename" class="form-label"> Product Name</label>
          <input type="text" class="form-control" id="completename" placeholder="Product name" autocomplete="off"> 
      </div>
      <div class="mb-3">
          <label for="completeprice" class="form-label">Price</label>
          <input type="text" class="form-control" id="completeprice" placeholder="Enter Product Price" autocomplete="off">  
      </div>
      <div class="mb-3">
          <label for="completeCategory" class="form-label">Category</label>
          <input type="text" class="form-control" id="completeCategory" placeholder="Enter Product Category" autocomplete="off"> 
      </div>
  <!-- form input end -->
      </div>

      <div class="modal-footer">
          <button type="button" class="btn btn-dark" onclick="addproduct()">Submit</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- update  modal -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <!--  form input -->
      <div class="mb-3">
          <label for="completename" class="form-label"> Product Name</label>
          <input type="text" class="form-control" id="updatename" placeholder="Product name" > 
      </div>
      <div class="mb-3">
          <label for="completeprice" class="form-label">Price</label>
          <input type="text" class="form-control" id="updateprice" placeholder="Enter Product Price" >  
      </div>
      <div class="mb-3">
          <label for="completeCategory" class="form-label">Category</label>
          <input type="text" class="form-control" id="updateCategory" placeholder="Enter Product Category"> 
      </div>
  <!-- form input end -->
      </div>

      <div class="modal-footer">
          <button type="button" class="btn btn-dark" onclick="updateDetails()">Update</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        <input type="hidden" id="hiddendata">
      </div>
    </div>
  </div>
</div>


<!--  add button -->
    <div class="container my-3">
        <h1 class="text-center">PHP CURD </h1>
        <!-- <button class="btn btn-dark my-4"> Add New Product</button> -->
        <button type="button" class="btn btn-dark my-3" data-bs-toggle="modal" data-bs-target="#completeModal">
        Add New Product
       </button>

       <div id="displayDataTable"></div>
    </div>
    


<!-- bootstra javascript  -->

<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>

<!-- accessing the value and store inside the variable, we can accessing that value using id, and that i can store inside my  nameAdd, priceadd variable and Categoryadd variable  -->

<script>

$(document).ready(function(){
    displayData();
});


// display function
 function displayData(){
    var displayData="true";
    $.ajax({
        url:"display.php",
        type:'post',
        data:{
            displaySend:displayData
        },

        // this is to access div id using jquery html method this is for the display data inside the html  
        // inside the function i have written the 2 parameter data and ststus..inside this i passed id for table which is given "displaydatatable"(using javascript)
        success:function(data,status){
          $('#displayDataTable').html(data);     
     }

    });

 }



// add product

    function addproduct(){
     var nameAdd=$('#completename').val();
     var priceAdd=$('#completeprice').val();
     var categoryAdd=$('#completeCategory').val();


    //  using AJAX ...without reload we can get the data from server..it is not going to refresh or distrub prev function
    // ajax take 4 parameter 
    
    $.ajax({
     url:"insert.php",
     type:'post', 
     data:{
       nameSend:nameAdd,
       priceSend:priceAdd,
       categorySend:categoryAdd
     },
     success:function(data,status){
        // function to display data
        // console.log(status);
        $('#completeModal').modal('hide');
        displayData();
        
     }
    });
    }


      //  for delete record
    
    function DeleteUser (deleteid){
      $.ajax({
        url:"delete.php",
        type:'post',
        data:{
          deletesend:deleteid
        },
        success:function(data,status){
          displayData();
        }

      });

    }

// update function
function GetDetails(updateid){
    $('#hiddendata').val(updateid);

    $.post("update.php",{updateid:updateid},function(data,status){
      var userid=JSON.parse(data);
      $('#updatename').val(userid.name);
      $('#updateprice').val(userid.price);
      $('#updateCategory').val(userid.category);
   
    })
     
    $('#updateModal').modal("show");
}


// onclick update event function 
function updateDetails(){
  var updatename=$('#updatename').val();
  var updateprice=$('#updateprice').val();
  var updateCategory=$('#updateCategory').val();
  var hiddendata=$('#hiddendata').val();

  $.post("update.php",{
    updatename:updatename,
    updateprice:updateprice,
    updateCategory:updateCategory,
    hiddendata:hiddendata
  },function(data,status){
    $('#updateModal').modal('hide');
    displayData();  
  });
}


</script>

</body>
</html>
