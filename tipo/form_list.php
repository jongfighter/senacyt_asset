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
            include_once("../header.php"); ?>
              <div class="marginleft">
                  <?php
            include_once ("../form_search.html");

            
require_once '../setting.php';
            $conn = mssql_connect($db_host, $db_user, $db_pw);
            mssql_select_db($db_name, $conn);
            $sql = "";
            if(isset($_POST['keyword'])){
                $loc_name = $_POST['keyword'];
                
                $sql = $sql."select t_id, t_name from tipo where t_name like '%{$loc_name}%';";
         
            }   
            else{
                $sql = $sql."select t_id, t_name from tipo";
            }
            $result = mssql_query($sql,$conn);
            ?>
            
        
        <table border ="1">
            <tr class="tablecolor"> 
            
                <th>Tipo</th>
                <th>Admin</th>
            </tr> 
        <?php
            while($row=  mssql_fetch_array($result)){
            ?>
            <tr>
       
 
                <td>
                    <form method ='post' >
                        <input type="hidden" name ="t_id" value ='<?php echo $row['t_id'];?>' >
                        <?php echo $row['t_name'];?><input type="hidden" name ="t_name" value ='<?php echo $row['t_name'];?>' >
                        </td>
                        <td>
                        <input type='submit' name ='submit' value ='modificar' formaction = "form_modify.php">
                        <input type='submit' name ='submit' value ='borrar' formaction="do_delete.php" onclick="return confirm('Are you sure you want to delete this item?');">
                    </form>
                </td>
        
                
            </tr>
               
            
    <?php
            }
?>
            </table>
            </div>
        <?php include_once '../footer.php';?>
    </body>
    
    <!--  Scripts-->
  <script src="js/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>

  
  <!-- CSS  -->
  <link href="fonts/material_icons.woff" rel="stylesheet">
  <link href="fonts/montserrat.woff" rel="stylesheet" type="text/css">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</html>


