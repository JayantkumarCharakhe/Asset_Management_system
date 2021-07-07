<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  
    <title>Dashboard</title>
</head>
<body>

<div class="container">
<h1 class="text-primary text-center">Asset Manegement System</h1>

   <div class= "d-flex justify-content-end" > <button type="button" 
   class="btn btn-primary classAdd"  data-toggle="modal" data-target="#myModal">
     Add Assets</button>
   </div>
     <h2 class="text-denger">All Assets</h2>

     <div id="records_contant">

     </div>

  <!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Asset Manegement System</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="form-group">
        <lable>Asset Type</lable>
        <input type="hidden" id="idHiddenId">
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
        <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="addrecord()">Save</button>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
 </div>
 
</div>  
  



  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script type="text/javascript">

$(document).ready(function(){
    readrecord();
});


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


function addrecord(){
    //$('#type').val('');
    var iRecordId = $('#idHiddenId').val();
    var type = $('#idType').val();
    var name = $('#idName').val();
    var date = $('#idDate').val();
    var price = $('#idPrice').val();
  alert (name);
  alert (date);
  alert (price);
    $.ajax({
        url: "backend1.php",
        type:"post",
        data: { sType :type,
                sName :name,
                dDate :date,
                iPrice :price,
                sFlag : 'addData',
                iRecordId : iRecordId

                },
            success:function(data,status){
                alert ('Data added successfully');
                readrecord();
            }
    });
}


// delete

function DeleteAssetData(deleteid){
    var conf = confirm("Are you sure to delete Asset");
    if(conf==true){
        $.ajax({
            url: "backend1.php",
        type:"post",
        data: {deleteid:deleteid},
        success:function(data,status){
            readrecord();
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
   
         $('#idType').val('');
         $('#idName').val('');
         $('#idDate').val('');
         $('#idPrice').val('');

})  
$(document).on('click','.classEdit',function(){
var iRowid = $(this).attr('data-row-id');
$('#idHiddenId').val(iRowid);

$.post("backend1.php",{
        id:iRowid,
        sFlag :'editData'
    }, function(data,status){
       console.log(data);
        
        // alert (user.type);
         $('#idType').val(data.type);
         $('#idName').val(data.name);
         $('#idDate').val(data.date);
         $('#idPrice').val(data.price);


        // $('#upname').val(user.name);
        // $('#update').val(user.date);
        // $('#upprice').val(user.price);
       }
    );
});
</script>
</body>
</html>