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
    <title>
        lista de cuenta
    </title>
<?php
            include_once("../header.php");
            ?> 
            <div class="marginleft"> 
            <?php  
            include_once ("../form_search.html");

?>
        <form method ='post' action="../do_export_excel.php">
            <input type ='hidden' name ='searchtext' value ='<?php echo $_POST['keyword'];?>'>
            <input type ='hidden' name ='checkvalue' value =<?php echo $_POST['check'];?>>
            <input type ='submit' name ='imprimir' value = 'excel'>
        </from>
<?php
            
         require_once '../setting.php';
            $conn = mssql_connect($db_host, $db_user, $db_pw);
            mssql_select_db($db_name, $conn);
            $sql = "";
            if(isset($_POST['keyword'])){
                $p_name = $_POST['keyword'];
               
                $sql = $sql."select p_lastname, p_name, login_identity, login_authority  from Login inner join Person on Person.p_id=Login.p_id where login_identity like '%{$p_name}%' or person.p_lastname like '%{$p_name}%' or person.p_name like '%{$p_name}%';";
               
            }
            else{
                $sql = $sql."select p_lastname, p_name, login_identity, login_authority  from Login inner join Person on Person.p_id=Login.p_id;";
            }
            $result = mssql_query($sql,$conn);
         
            
        ?>
                <table border='1'> <tr class="tablecolor">
                        <th>Apellido</th>
                        <th>Nombre</th>
                        <th>ID</th>
                        <th>autoridad</th>
                        <th>Admin</th>
            
                        
            
                    </tr>
            <?php
        

// Print the data
    while($row = mssql_fetch_array($result)) {
       ?>
                    
                    
        <tr>

        <td>
            <?php echo $row['p_lastname'];?>
        </td>
        <td><?php echo $row['p_name'];?>
        </td>
        <td><?php echo $row['login_identity'];?>
        </td>
        <td> <?php echo $row['login_authority'];?>
        </td>
        <td>
        <form method="post"> 
        <input type ="hidden" name = "p_lastname" value = "<?php echo $row['p_lastname'];?>">
        <input type ="hidden" name = "p_name" value = "<?php echo $row['p_name'];?>">
        <input type ="hidden" name = "login_identity" value = "<?php echo $row['login_identity'];?>" >
        <input type ="hidden" name = "login_authority" value = "<?php echo $row['login_authority'];?>" >
        <input type="submit" name ="submit" value = "modificar" formaction="form_modify.php" > 
        <input type="submit" name ="submit" value = "borrar" formaction="do_delete.php"> 
        </td>
        
       <?php
        echo '</form> </td>';
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
