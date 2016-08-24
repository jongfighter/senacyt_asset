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
            include_once("../header.php");
            include_once ("../form_search.html");

            
            $db_host = "localhost";
            $db_user = "sa";
            $db_pw = "vamosit";
            $db_name = "senacyt_asset";
            $conn = mssql_connect($db_host, $db_user, $db_pw);
            mssql_select_db($db_name, $conn);
            $sql = "";
            if(isset($_POST['keyword'])){
                $loc_name = $_POST['keyword'];
                
                $sql = $sql."select loc_id, loc_building, loc_floor, loc_desc from Loc where loc_building like '%{$loc_name}%' or loc_floor like '%{$loc_name}%' or loc_desc like '%{$loc_name}%';";
         
            }   
            else{
                $sql = $sql."select loc_id, loc_building, loc_floor, loc_desc from Loc";
            }
            $result = mssql_query($sql,$conn);
            
            ?>
        <table border='1'>
            <tr class="tablecolor">
            <th>Edificio</th>
            <th>Piso</th>
            <th>Descripción</th>
            
    <th> Admin </th>
            </tr>
        <?php
        

// Print the data
    while($row = mssql_fetch_row($result)) {
        $num = 0;
        $arraypass[4];
        echo "<tr>";
        foreach($row as $_column) {
            if($num==0){
               
            }
            else{
                echo '<td >'.$_column.'</td>';
            }
            $arraypass[$num]=$_column;
            $num = $num+1;
        }
        echo '<td>';
        echo '<form method="post" action="form_modify.php"> ';
        echo '<input type ="hidden" name = "loc_id" value = "'.$arraypass[0].'">';
        echo '<input type ="hidden" name = "loc_building" value = "'.$arraypass[1].'">';
        echo'<input type ="hidden" name = "loc_floor" value = "'.$arraypass[2].'">';
        echo'<input type ="hidden" name = "loc_desc" value = "'.$arraypass[3].'">';
        echo '<input type="submit" name ="submit" value = "modificar" > ';
        echo '</form>';
        echo '<form method="post" action="do_delete.php"> ';
        echo '<input type ="hidden" name = "loc_id" value = "'.$arraypass[0].'">';
        echo '<input type="submit" name ="delete" value = "borrar" > ';
        echo '</form> </td>';
        echo "</tr>";
    }

echo "</table>";
 ?>
        
               <?php include_once '../footer.php';?>   
        </form>
    </body>
</html>
