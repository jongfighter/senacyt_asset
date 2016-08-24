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
<?php

    echo $_SESSION['user_id'];
    include_once("../header.php");
            
?>
<?php

            $asset_id = $_POST['asset_id'];
            $db_host = "localhost";
            $db_user = "sa";
            $db_pw = "vamosit";
            $db_name = "senacyt_asset";
            $conn = mssql_connect($db_host, $db_user, $db_pw);
            mssql_select_db($db_name, $conn);
            $sql = "select dept_id, dept_name from dbo.Department";
            $result = mssql_query($sql,$conn);


?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>

    </head>
    <body>
        <div class="marginleft">
        <form method ="post"  action ='do_insert.php' onsubmit='return chk()'>
             <div>
                 Apellido : <input type ="text" name ="p_lastname" id = 'p_lastname'>
             </div>
             <div>
                Nombre : <input type ="text" name ="p_name" id = 'p_name'>
             </div>
             <div>
                      Departamento :       <select name ='dept_name' id = 'dept_name'>
                 <?php
                 while($row =  mssql_fetch_array($result)){
                     ?>
                 <option value='<?php echo $row['dept_name']?>'> <?php echo $row['dept_name']?></option>
                 <?php
                 }
                 
                 ?>
             </select>
                 
             </div>
             <div>
                 <input type="submit" name ="submit" value = "insertar">
                 
            </div>
            
        </form>
        <button type ="button"  onclick="history.back()"> volver </button>
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
