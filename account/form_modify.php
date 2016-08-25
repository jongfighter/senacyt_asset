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
      require_once '../setting.php';
            $conn = mssql_connect($db_host, $db_user, $db_pw);
            mssql_select_db($db_name, $conn);


?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>modificar cuenta</title>
<script type="text/javascript" src="../chk.js"></script>
    </head>
    <body>
        <?php
        include_once("../header.php");
        
        ?>
        
        <?php
        
        
        // put your code here
        $plastname = $_POST['p_lastname'];
        $pname = $_POST['p_name'];
     
        $login_identity = $_POST['login_identity'];
    
        $login_authority = $_POST['login_authority'];
    
        ?>
        <?php
        ?>
        
        <div class="marginleft">
        
        <form method ="post" action="do_modify.php" id="myform" onsubmit ="return validateForm('myform');"> 
             <div>
                 Apellido : <?php echo $plastname ?> <br>
                 <input type ="hidden" name ="person_lastname" id = 'p_lastname' value = '<?php echo $plastname ?>'><br>
                 Nombre: <?php echo $pname;?><br>
                 
                 <input type ="hidden" name ="person_name" id = 'p_name' value = '<?php echo $pname ?>'>
                 autoridad:                  <select name ='login_authority'>
                     <option value="admin"> admin</option>
                     <option value="otros"> otros</option>
                     
                 </select>
                 <br>
                 ID : <?php echo $login_identity; ?><input type ="hidden" name ="login_identity" id = 'login_identiity' value = '<?php echo $login_identity; ?>'><br>
                 Contraseña : <input type ="password" name ="pwd" id = 'pwd'>
                 
                 
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
  <script src="../chk.js"></script>
  
  <!-- CSS  -->
  <link href="fonts/material_icons.woff" rel="stylesheet">
  <link href="fonts/montserrat.woff" rel="stylesheet" type="text/css">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
   
</html>
