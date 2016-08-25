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
 
        </script>
    </head>
    <body>
        <?php
        
        include_once("../header.php");
        
        
        // put your code here
        
        $locid = $_POST['loc_id'];
        
        $locbuild = $_POST['loc_building'];
        $locfloor = $_POST['loc_floor'];
        $locdesc = $_POST['loc_desc'];

      ?>
      
        <div class="marginleft">
        <form method ="post" action="do_modify.php" id="myform" name='myform' onsubmit ="return validateForm('myform');"> 
            
            
        
        <input type='hidden' name = 'loc_id' value = '<?php echo $locid;?>' >
        
       <br> Edificio : <input type='text' name='loc_building' value = '<?php echo $locbuild; ?>'>
      <br> Piso  : <input type='text' name='loc_floor' value = '<?php echo $locfloor; ?>'>
        <br> Descripción : <input type='text' name='loc_desc' value = '<?php echo $locdesc;?>'>
        <br><input type='submit' name='submit' value = 'confirmar'>
       
        </form>
        <button type ="button"  onclick="history.back()"> volver </button>
        </div>
        
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
