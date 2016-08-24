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

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script type="text/javascript" src="../chk.js"></script>
    </head>
    <body>
        <?php
        include_once("../header.php"); ?>
        
          <div class="marginleft">
   
        <?php
        // put your code here
        $dept_id = $_POST['dept_id'];
        $dept_name = $_POST['dept_name'];
        ?>
     
    
        <br><form method = "post" name ='myform' id='myform' action='do_modify.php' onsubmit ="return validateForm('myform');">
       
        <input type='hidden' name='dept_id' value = '<?php echo $dept_id; ?>'>
        <br>Departmento <input type='text' name='dept_name' value = '<?php echo $dept_name?>'>
        <br><input type='submit' name='submit' value = 'confirmar'  formaction = 'do_modify.php'>
    
        </form></tr>
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
