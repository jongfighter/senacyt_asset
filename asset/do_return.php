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
            
            
            $today = date("Y-m-d");
            $in = $today;
            $db_host = "localhost";
            $db_user = "sa";
            $db_pw = "vamosit";
            $db_name = "senacyt_asset";
            $conn = mssql_connect($db_host, $db_user, $db_pw);
            mssql_select_db($db_name, $conn);
            $sql_ret = "select asset_respon, loc_id_bf from dbo.Asset where asset_id={$asset_id}";
            echo $sql_ret;
            $result = mssql_query($sql_ret,$conn);
          
            $row = mssql_fetch_array($result);
            $loc_id = $row['loc_id_bf'];
            $p_id  = $row['asset_respon'];
            $z =1;
            $sql = "update Asset set asset_in = '{$in}',  loc_id ={$loc_id}, p_id = {$p_id}, pos={$z}, asset_last_touch = '{$today}' "
            
            . "where asset_id = {$asset_id}; ";
            echo $sql;
            $resres = mssql_query($sql,$conn);
            if($resres){
                ?>
                    <script>alert("return success");</script>
                    
                    <?php
            }
            else{
                ?>
                    <script>alert("return failed");</script>
                    
                    <?php
            }

?>
<meta http-equiv="refresh" content="0;url=form_list.php">

