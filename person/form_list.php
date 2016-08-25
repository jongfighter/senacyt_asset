<?php
session_cache_limiter('nocache, must-revalidate');
    session_start();
  
    if($_SESSION['user_id']!='admin'){
        ?>
<script>alert("sign in with admin account"); </script>
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
            ?><div class='marginleft'><?php
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
               
                $sql = $sql."select p_id , Department.dept_id as dept_id, p_lastname as lastname, p_name as name, dept_name as department from Person inner join Department on Department.dept_id=Person.dept_id where 
p_name like '%{$p_name}%' or dept_name like '%{$p_name}%';";
               
            }
            else{
                $sql = $sql."select p_id, Department.dept_id as dept_id, p_lastname as lastname, p_name as name, dept_name as department from Person inner join Department on Department.dept_id=Person.dept_id;";
            }
            $result = mssql_query($sql,$conn);
     ?><table border='1'>
          <tr class="tablecolor">
              <th>Apellido</th>
              <th>Nombre</th>
              <th>Departamento</th>
            
              <th>Admin</th>
         </tr>
<?php
// Print the data
    while($row = mssql_fetch_array($result)) {
        ?>
         <td><?php echo $row['lastname'];?></td>
         <td><?php echo $row['name'];?></td>
         <td><?php echo $row['department'];?></td>
         
            
            <?php
        
        ?>
        <td>
            <form method="post">
                <input type ="hidden" name = "p_id" value = "<?php echo $row['p_id'];?>">
                <input type ="hidden" name = "p_lastname" value = "<?php echo $row['lastname'];?>">
                <input type ="hidden" name = "p_name" value = "<?php echo $row['name'];?>">
                <input type ="hidden" name = "dept_name" value = "<?php echo $row['department'];?>">
                
                <input type="submit" name ="submit" value = "modificar" formaction="form_modify.php" > 
                <input type="submit" name ="submit" value = "borrar" formaction="do_delete.php"> 
                <input type="submit" name ="submit" value = "ver información" formaction="form_person_view.php">

            </form> 
        </td>
        </tr>
<?php    } ?>

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
