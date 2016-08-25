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
            include_once("../header.php"); ?>
              <div class="marginleft">
                  <?php
            include_once ("../form_search.html"); 

            
            $db_host = "localhost";
            $db_user = "sa";
            $db_pw = "vamosit";
            $db_name = "senacyt_asset";
            $conn = mssql_connect($db_host, $db_user, $db_pw);
            mssql_select_db($db_name, $conn);
            $sql = "";
            if(isset($_POST['keyword'])){
                $p_name = $_POST['keyword'];
              
                $sql = $sql."select dept_id, dept_name from Department where dept_name = '%{$p_name}%'";
            }
            else{
                $sql = $sql."select dept_id, dept_name from Department";
            }
            $result = mssql_query($sql,$conn);
?>
        <table border='1'>
            <tr class="tablecolor">
                <th>Departamento</th>
                <th>Admin</th>   
            </tr>
    <?php

// Print the data
    while($row = mssql_fetch_row($result)) {
        $num = 0;
        $arraypass[2];
        echo "<tr>";
        foreach($row as $_column) {
            if($num==0){
               
            }
            else{
                echo '<td > '.$_column.'</td>';
            }
            $arraypass[$num]=$_column;
            $num = $num+1;
        }
        echo '<td>';
        echo '<form method="post" action="form_modify.php"> ';
        echo '<input type ="hidden" name = "dept_id" value = "'.$arraypass[0].'">';
        echo '<input type ="hidden" name = "dept_name" value = "'.$arraypass[1].'">';
        echo '<input type="submit" name ="submit" value = "modificar" > ';
        echo '</form> ';
        ?>
        <form method="post" action ="do_delete.php">
            <input type ='hidden' name ='dept_id' value= '<?php echo $arraypass[0]?>'>
            <input type="submit" name ="delete" value = "borrar" >
        </form>
        </td>
        <?php
        
        echo "</tr>";
    }

echo "</table>";
 ?>
        
            
        </form>
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
