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
        
        $t_id = $_POST['t_id'];
        
        $t_name = $_POST['t_name'];


      ?>
        <div class="marginleft">
        <form method ="post" action="do_modify.php" id="myform" name='myform' onsubmit ="return validateForm('myform');"> 
        <input type='hidden' name = 't_id' value = '<?php echo $t_id;?>' >
        <br> Tipo: <input type='text' name='t_name' value = '<?php echo $t_name; ?>'>
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
