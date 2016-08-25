<?php

session_cache_limiter('nocache, must-revalidate');

    session_start();

    if($_SESSION['user_id']!='admin'){    
        ?>
<script>alert("no access right");</script>
<meta http-equiv="refresh" content="0;url=../main.php">
<?php
    }
        
?>

<?php
            $asset_id = $_POST['asset_id'];
            
            $barcode = $_POST['asset_barcode'];
            $desc = $_POST['asset_desc'];
            $model = $_POST['asset_model'];
            $brand = $_POST['asset_brand'];
            $serial = $_POST['asset_serial'];
            $asset_respon = $_POST['asset_respon'];
            echo $asset_respon;
            $details = $_POST['asset_details'];
            $purchase = $_POST['asset_bought_date'];
            $guarantee = $_POST['asset_guarantee_expired'];
            $price = $_POST['asset_price'];
            $provider = $_POST['asset_provider'];        
            $loc_id = $_POST['loc_id'];
            $avail = $_POST['available'];
            echo $avail;
            $today = date("Y-m-d");
            require_once '../setting.php';
            $conn = mssql_connect($db_host, $db_user, $db_pw);
            mssql_select_db($db_name, $conn);
   
            $sql= "";
            if($avail==1){
                                 $sql = "update dbo.Asset set asset_barcode = '{$barcode}', asset_desc = '{$desc}',"
                 . " loc_id_bf = {$loc_id}, loc_id = {$loc_id}, p_id = {$asset_respon}, asset_respon = {$asset_respon}, asset_model = '{$model}', asset_brand = '{$brand}',"
                 . "asset_serial = '{$serial}', asset_details = '{$details}',  asset_bought_date = '{$purchase}', asset_guarantee_expired = '{$guarantee}',"
                 . "asset_price =  {$price}, asset_provider = '{$provider}' "
                 . "where asset_id = {$asset_id} ;";
                
            }
            else{
                    $sql = "update dbo.Asset set asset_barcode = '{$barcode}', asset_desc = '{$desc}',"
                 . " loc_id_bf = {$loc_id},asset_model = '{$model}', asset_brand = '{$brand}',"
                 . "asset_serial = '{$serial}', asset_details = '{$details}',  asset_bought_date = '{$purchase}', asset_guarantee_expired = '{$guarantee}',"
                 . "asset_price =  {$price}, asset_provider = '{$provider}', asset_respon={$asset_respon} "
                 . "where asset_id = {$asset_id} ;";
             
            }
 echo $sql;
                 
   
            
            mssql_query($sql,$conn);
            mssql_close();
?>


<!--<meta http-equiv="refresh" content="0;url=form_list.php">
