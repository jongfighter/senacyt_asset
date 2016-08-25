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
<script type="text/javascript" src="../chk.js"></script>
    </head>
    <body>
        <?php
        include_once("../header.php");

        
        // put your code here
require_once '../setting.php';
        ?>
        <?php
        ?>
          <div class="marginleft">
        <form method ="post" action="do_modify.php" id="myform" onsubmit ="return validateForm('myform');"> 
             <div>
                 <input type ='hidden' name ='person_id' value = '<?php echo $pid?>'>
                 Apellido: <input type ="text" name ="person_lastname" id = 'p_lastname' value = '<?php echo $plastname ?>'>
                 </div>
            <div>
                 Nombre : <input type ="text" name ="person_name" id = 'p_name' value = '<?php echo $pname ?>'>
            </div>
             <div>
                      Departamento : <select name ='dept_name' id = 'dept_name' selected = '<?php echo $deptname; ?>'>
                 <?php
                 while($row =  mssql_fetch_array($result)){
                     ?>
                 <option value='<?php echo $row['dept_name']?>' <?php if($row['dept_name']==$deptname){ echo "selected";}?>> <?php echo $row['dept_name']?></option>
                 <?php
                 }
                 
                 ?>
             </select>
                 
             </div>
             <div>
                 <input type="submit" name ="submit" value = "modificar" onclick="return chk()">
                 
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
