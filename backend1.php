
<?php

error_reporting(0);
require 'connection.php';
require 'class.Assets.php';
extract($_POST);

if(isset($_POST['deleteid'])){
    $conn = mysqli_connect("localhost", "root", "plus91", "dbasset");
            if (!$conn) {
                die('Could not Connect My Sql:' . mysqli_connect_error());
            }
       $assetid= $_POST['deleteid'];
       $squery = "UPDATE `asset_data` 
           SET `deleted` = 1 WHERE `id` = {$assetid}";
            mysqli_query($conn,$squery);
   }


if(isset($_GET['sFlag']) && $_GET['sFlag']=='editData') {
    $iRecordeId = $_GET['id'];
       $oAssets = new Assets();
       $aAssetsData = $oAssets->getAssetData($iRecordeId);
    header("Content-Type: application/json");
    // print_r(json_encode($aResponse));
    echo(json_encode($aAssetsData));
}



if(isset($_GET['sFlag']) && $_GET['sFlag']=='getAllData') {
    $oAssets = new Assets();
    $aAssetsData = $oAssets->getListData();
    $iCount = count($aAssetsData);
    for ($iii=0; $iii < count($aAssetsData); $iii++) { 
        $iSrNo=  $iii+1;
         $sAction ='';
         $sAction .= '<button type="button" data-row-id='.$aAssetsData[$iii]['id'].' 
                  class="classEdit"  data-toggle="modal" data-target="#myModal" style="color:blue;">
                  <i class="fa fa-pencil"></i></button>';
         $sAction .= '      <button type="button" data-row-id='.$aAssetsData[$iii]['id'].' 
                  class="classDelete" style="color:red;">
                  <i class="fa fa-trash"></i></button>';
         $aData =array(
            'iSrno'              =>$iSrNo,
             'sType'		     => $aAssetsData[$iii]['type'],
             'sNmae'             => $aAssetsData[$iii]['name'],
             'sDate'             => $aAssetsData[$iii]['date'],
             'sPrice'            => $aAssetsData[$iii]['price'],
             'sAction'           => $sAction
         );
          $aQcData[] = $aData;
    }
    $aResponse = array('data' => array(), 'draw'=>$_GET['draw'], "recordsTotal"=>$iCount,"recordsFiltered"=>$iCount);
 foreach ($aQcData as $colData) {
     $aResponse['data'][]  = array_values($colData);
 }
 header("Content-Type: application/json");
 // print_r(json_encode($aResponse));
 echo(json_encode($aResponse));
}


if(isset($_POST['sFlag']) && $_POST['sFlag']=='') {
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
      $data = //'<table id="table_id" class="table table-bordered table-striped table-hover">
    //               <tr>
    //                    <th>Sr.No.</th>
    //                    <th>Type of Asset</th>
    //                    <th>Name of Asset</th>
    //                    <th>Date of issue</th>
    //                    <th>Price</th>
    //                    <th>Actions</th>
                       
    //               </tr>';
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
                
                     <td><div class= "d-flex justify-content-end" > <button type="button" data-row-id='.$row['id'].' 
                     class="classEdit"  data-toggle="modal" data-target="#myModal">
                     <i class="fa fa-edit" style="font-size:24px; color:blue;"></i></button>    &nbsp;  &nbsp;
                     &nbsp;
                     &nbsp;
                     &nbsp;
                    
                      <button onclick="DeleteAssetData('.$row['id'].')" 
                      class=""><i class="fa fa-trash" style="font-size:24px; color:red;"></i></button></td>
                      </div>
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
    $iAssetId =$_POST['iAssetId'];
    $type =$_POST['sType'];
    $name =$_POST['sName'];
    $date =$_POST['dDate']; 
    $price =$_POST['iPrice'];
   
       $dDate = date('Y-m-d');
       if($iRecordId>0){ 
           $iAssetMid = $iAssetId;
           $squery = "UPDATE `asset_data` 
           SET `deleted` = 1 WHERE `id` = {$iRecordId}";
            mysqli_query($conn,$squery);
       }
       ?>
    //   master query
    <script>console.log($iAssetMid);</script>
    <?php
    var_dump($iAssetMid);
    exit;

    if($iAssetMid==null || $iAssetMid==""){ 

        $sMasterQuery ="INSERT INTO `master_id_asset`(`mid`,`added_by`,`added_on`,`deleted`) 
        VALUES (null, 0, '$dDate', 0)";
        
        echo $sMasterQuery;
        var_dump($sMasterQuery);
        exit;

        mysqli_query($conn,$sMasterQuery);
          
          $iAssetMid= mysqli_insert_id();
    }
     //asset data query
       $query= "INSERT INTO `asset_data`(`assetmasterid`,`type`,`name`,`date`,`price`,`deleted`,`addedby`) 
       VALUES ('$iAssetMid','$type', '$name', '$date', '$price',0,'$dDate')";
    
       mysqli_query($conn,$query);

   }


   if(isset($_POST['deleteid'])){
       $assetid= $_POST['deleteid'];
       $squery = "UPDATE `asset_data` 
           SET `deleted` = 1 WHERE `id` = {$assetid}";
            mysqli_query($conn,$squery);
      
   }
?>








