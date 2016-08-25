<?php

session_cache_limiter('nocache, must-revalidate');

    session_start();
   echo "account : ".$_SESSION['user_id'];
    if($_SESSION['user_id']!='admin'){    
        ?>
<script>alert("no access right");</script>
<meta http-equiv="refresh" content="0;url=../main.php">
<?php
    }
        
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        
<?php
            include_once("log_header.php");
            include_once("../form_loc_log_search.html");

?>
        <form method ='post' action="loc_export_excel.php">
            <input type ='hidden' name ='searchtext' value ='<?php echo $_POST['keyword'];?>'>
            <input type ='hidden' name ='checkvalue' value =<?php echo $_POST['check'];?>>
            <input type ='submit' name ='print' value = 'excel'>
        </from>
<?php
            
            require_once '../setting.php';
            $conn = mssql_connect($db_host, $db_user, $db_pw);
            mssql_select_db($db_name, $conn);
            $sql = "";
            if(isset($_POST['keyword'])){
                $loc_name = $_POST['keyword'];
                
                $sql = $sql."select loc_id, log_name, log_date, loc_building, loc_floor, loc_desc from log_Loc where loc_building = '%{$loc_name}%' or loc_floor = '%{$loc_name}%' loc_desc = '%{$loc_name}%'";
            }
            else{
                $sql = $sql."select loc_id, log_name, log_date, loc_building, loc_floor, loc_desc from log_Loc";
            }
            $result = mssql_query($sql,$conn);?>
        <table border='1'>
            <tr class='tablecolor'>
                <th>Tipo de reportes</th>
                <th>Día de reportes</th>
                <th>Edificio</th>
                <th>Piso</th>
                <th>Descripción</th>
                
            </tr>
                
<?php
// Print the data
    while($row = mssql_fetch_row($result)) {
        $num = 0;
        $arraypass[6];
        echo "<tr>";
        foreach($row as $_column) {
            if($num==0){
               
            }
            else{
                echo '<td >'.$_column.'</td>';
            }
            $num = $num+1;
        }
    }

echo "</table>";
 ?>
        
            
        </form>
         <?php include_once '../footer.php';?>
    </body>
    
</html>
