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

             
             $bar = $_POST['asset_barcode'];
             $desc = $_POST['asset_desc'];
             $brand = $_POST['asset_brand'];
             $model = $_POST['asset_model'];
             $serial = $_POST['asset_serial'];
             $bought_date = $_POST['asset_bought_date'];
             $expired = $_POST['asset_guarantee_expired'];
             $price = $_POST['asset_price'];
             $provider = $_POST['asset_provider'];
             $today = date("Y-m-d");
            $db_host = "localhost";
            $db_user = "sa";
            $db_pw = "vamosit";
            $db_name = "senacyt_asset";
            $conn = mssql_connect($db_host, $db_user, $db_pw);
            mssql_select_db($db_name, $conn);
             $sql = "INSERT into dbo.Asset"
                    . " (t_id, asset_barcode, asset_desc, asset_brand, asset_model, asset_serial, asset_bought_date, asset_last_touch "
                    . ", asset_in,asset_guarantee_expired ,  asset_price, loc_id, p_id, asset_provider)"
                    . " values(2, '{$bar}', '{$desc}', '{$brand}', '{$model}', '{$serial}', '{$bought_date}', '{$today}', '{$today}', '{$expired}', '{$price}', 1,1,'{$provider}');";
            mssql_query($sql,$conn);
           
            ?>
<meta http-equiv="refresh" content="0;url=form_list.php">
            
            
            