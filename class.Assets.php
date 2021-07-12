<?php
//error_reporting(0);
//require 'connection.php';
class Assets{
    function getAssetData($iRecordId){
        $aAssetsData = array();
         $conn = mysqli_connect("localhost", "root", "plus91", "dbasset");
        if (!$conn) {
            die('Could not Connect My Sql:' . mysqli_connect_error());
        }
        $sDisplayquery = "select * from `asset_data` where id='{$iRecordId}' ";
        $result = mysqli_query($conn,$sDisplayquery);
        if($result!==FALSE){
		     while($aRow = $result->fetch_assoc()){
		     $aAssetsData = $aRow;
		    }
		}
        return $aAssetsData;
    }
    function getListData(){
        $aAssetsData = array();
           $conn = mysqli_connect("localhost", "root", "plus91", "dbasset");
            if (!$conn) {
                die('Could not Connect My Sql:' . mysqli_connect_error());
            }
            $displayquery = "select * from `asset_data` where `deleted` = 0";
            $result = mysqli_query($conn,$displayquery);
            $aAssetsData= array();
            while($aRow = $result->fetch_assoc()){
                $aAssetsData[] = $aRow;
            }
        return $aAssetsData;
    }
}

