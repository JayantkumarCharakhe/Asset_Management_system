<?php
error_reporting(0);
require 'connection.php';
require 'class.Assets.php';
extract($_POST);

if(isset($_POST['sFlag']) && $_POST['sFlag']=='editData') {
   $iRecordId = $_POST['id'];
   
   
   $aAssetsData = array();
    $oAssets = new Assets();

    $aAssetsData = $oAssets->getAssetData($iRecordId);
    
    header("Content-Type: application/json");
	echo(json_encode($aAssetsData));
}
if(isset($_POST['sFlag']) && $_POST['sFlag']=='saveData') {
    $iRecordId = $_POST['id'];
    
    
    $aAssetsData = array();
     $oAssets = new Assets();
 
     $aAssetsData = $oAssets->getAssetData($iRecordId);
     
     header("Content-Type: application/json");
     echo(json_encode($aAssetsData));
 }

if(isset($_POST['record'])){
     $data = '<table class="table table-bordered table-striped">
                  <tr>
                       <th>No.</th>
                       <th>Type of asset</th>
                       <th>Name of asset</th>
                       <th>Date of issue</th>
                       <th>Price</th>
                       <th>Edit</th>
                       <th>Delete</th>
                  </tr>';
    $displayquery = "select * from `asset_data` where `deleted` = 0";
    $result = mysqli_query($conn,$displayquery);

     if(mysqli_num_rows($result) > 0){
         $inumber = 1;
         while ($row =mysqli_fetch_array($result)) {
             $data .= '<tr>
                      <td>'.$inumber.'</td>
                      <td>'.$row['type'].'</td>
                      <td>'.$row['name'].'</td>
                      <td>'.$row['date'].'</td>
                      <td>'.$row['price'].'</td>
                
                     <td><div class= "d-flex justify-content-end" > <button type="button" data-row-id='.$row['id'].' class="btn btn-primary classEdit"  data-toggle="modal" data-target="#myModal">
                     Edit</button>
                   </div></td>
                      <td> <button onclick="DeleteAssetData('.$row['id'].')" 
                      class="btn btn-denger fas fa-delete">Delete</button> </td>
                      
                 </tr>';
                 $inumber++;
         }
     }
     $data .='</table>';
     echo $data;
}


if(isset($_POST['sType']) && isset($_POST['sName']) && 
   isset($_POST['dDate']) && isset($_POST['iPrice']) && isset($_POST['sFlag'])
    && $_POST['sFlag']=='addData' ) {
    
    $iRecordId =$_POST['iRecordId'];
    $type =$_POST['sType'];
    $name =$_POST['sName'];
    $date =$_POST['dDate']; 
    $price =$_POST['iPrice'];
   
       $dToday = date('Y-m-d');
       if($iRecordId>0){ 
           $squery = "UPDATE `asset_data` 
           SET `deleted` = 1 WHERE `id` = {$iRecordId}";
            mysqli_query($conn,$squery);
       }
       $query= "INSERT INTO `asset_data`(`type`,`name`,`date`,`price`,`deleted`,`addedby`) 
       VALUES ('$type', '$name', '$date', '$price',0,'$dToday')";
    
       mysqli_query($conn,$query);
   }


   if(isset($_POST['deleteid'])){
       $assetid= $_POST['deleteid'];
       $squery = "UPDATE `asset_data` 
           SET `deleted` = 1 WHERE `id` = {$assetid}";
            mysqli_query($conn,$squery);
      
   }

?>