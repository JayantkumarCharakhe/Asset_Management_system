<?php
    session_start();
    if (empty(isset($_SESSION['email']))) {
      header("Location:login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="  https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Dashboard</title>
</head>
<body>
 <ol class="breadcrumb mt-3" style="background-color:#80DDEF;">
    <li class="breadcrumb-item"><a class="fa fa-dashboard icons fa-lg"><b> Dashboard</b></a> <div class="pull-right mb-1 mr--4 fa fa-user icons fa-lg text-danger" style="margin-left: 39.3em;"><?php echo " : ".$_SESSION["name"] ;?> <a href="logout.php"  class="btn btn-info mb-2">Logout</a></div><br> </li>
  </ol>
<!-- addAssetbutton -->
  <button type="button" class="float-right mr-5 btn btn-primary classAdd" data-toggle="modal" data-target="#myModal">
     Add Assets</button>  
     <br><br>
<nav>

<div class="container mb-2">
<!-- <div class="pull-right mb-1 mr--4 fa fa-user icons fa-lg text-danger"><?php echo " : ".$_SESSION["name"] ;?> <a href="logout.php"  class="btn btn-info mb-2">Logout</a></div><br> -->
  </div>    
  
</nav>
 

     <div id="records_contant mt-5 ">
     <table class="table hover small-text-container compact b3-data-table dataTable" id="idTableListing" >
         <thead style="width: 206px;/* color: blue; */background-color: gray;">
         <tr>
           <th width="10%">Sr.No.</th>
           <th width="20%">Asset Type</th>
           <th width="20%">Asset Name</th>
           <th width="20%">Issue Date</th>
           <th width="20%">Asset Cost</th>
           <th width="10%">Action</th>
           </tr>
           </thead>
           <tbody id="idTableListingBody"></tbody>
                                    </table>
     </div>
  <!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title text-right classTital"></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <div class="form-group">
        <lable>Asset Type</lable>
        <input type="hidden" id="idHiddenId">
        <input type="hidden" id="idAssetId">
        <input type="text" name="type" id="idType" class="form-control" placeholder="Enter Asset type">
        </div>
        <div class="form-group">
        <lable>Asset Name</lable>
        <input type="text" name="name" id="idName" class="form-control" placeholder="Enter Asset name">
        </div>
        <div class="form-group">
        <lable>Asset Issue Date</lable>
        <input type="date" name="date" id="idDate" class="form-control" placeholder="Enter Asset issue date">
        </div>
        <div class="form-group">
        <lable>Asset Price</lable>
        <input type="text" name="price" id="idPrice" class="form-control" placeholder="Enter Asset price">
        </div>
      </div>
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="addrecord()">Save</button>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
 </div>
</div>  

<!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
<script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<!-- new -->
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


<script type="text/javascript">


// $("#myModal").show();

$(document).ready(function() {
    $('#idTableListing').DataTable( {
        "bLengthChange": false,
      "columnDefs":[{"targets": [5], "orderable": false}],  
        "ajax": 'backend1.php?sFlag=getAllData'
    } );
} );
function readrecord(){
    var record = "record";
    $.ajax({
        url: "backend1.php",
        type:"post",
        data : {record:record},
        success:function(data,status){
              $('#records_contant').html(data);
        }
    });
}
//add data
function addrecord(){
    //$('#type').val('');
    var iRecordId = $('#idHiddenId').val();
    //console.log(iRecordId);
    alert(iRecordId);
    var iAssetId = $('#idAssetid').val();
    console.write(iAssetId);
    alert(iAssetId);
    var type = $('#idType').val();
    var name = $('#idName').val();
    var date = $('#idDate').val();
    var price = $('#idPrice').val();
    $.ajax({
        url: "backend1.php",
        type:"post",
        data: { sType :type,
                sName :name,
                dDate :date,
                iPrice :price,
                sFlag : 'addData',
                iRecordId : iRecordId,
                iAssetId : iAssetId
                },
            success:function(data,status){
                alert ('Data added successfully');
                //readrecord();
                $('#idTableListing').DataTable().ajax.reload();
            }
    });
}
// delete
$(document).on('click','.classDelete',function(){
    var deleteid = $(this).attr('data-row-id');
    DeleteAssetData(deleteid);
})
// delete
function DeleteAssetData(deleteid){
    var conf = confirm("Are you sure to delete Asset");
    if(conf==true){
        $.ajax({
            url: "backend1.php",
        type:"post",
        data: {deleteid:deleteid},
        success:function(data,status){
            alert("record deleted");
             $('#idTableListing').DataTable().ajax.reload();
        }
        });
    }
}
// updete
function EditeAssetData(id){
    $('#hidden_asset_id').val(id);
    $.post("backend1.php",{
        id:id
    }, function(data,status){
        var user = JSON.parse(data);
        $('#uptype').val(user.type);
        $('#upname').val(user.name);
        $('#update').val(user.date);
        $('#upprice').val(user.price);
       }
    );
    $('#updateModal').model("show");
}
$(document).on('click','.classAdd',function(){
  $('.classTital').text('Add Asset'); 
         $('#idType').val('');
         $('#idName').val('');
         $('#idDate').val('');
         $('#idPrice').val('');
         $("#myModal").show();
})  

$(document).on('click','.classClose',function(){
$("#myModal").hide();
})  
$(document).on('click','.classEdit',function(){
var iRowid = $(this).attr('data-row-id');
 $('.classTital').text('Update Asset'); 
$('#idHiddenId').val(iRowid);
$.get("backend1.php",{
        id:iRowid,
        sFlag :'editData'
    }, function(data,status){
       console.log(data);
         $('#idAssetid').val(data.assetmasterid);
         $('#idType').val(data.type);
         $('#idName').val(data.name);
         $('#idDate').val(data.date);
         $('#idPrice').val(data.price);
         $("#myModal").show();
       }
    );
});
</script>
</body>
</html>