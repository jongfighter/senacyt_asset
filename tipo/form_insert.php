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
        <script type = "text/javascript">
               function isNull(text){
                      if(text===null||text===""){
                          return true;
                      }
                      else{
                          return false;
                      }
                  }
              function chk(){

                  var building = document.getElementById("building").value;     
                  var floor = document.getElementById("floor").value;
                  var desc = document.getElementById("desc").value;
                 
                  if(isNull(building)||isNull(floor)||isNull(desc)){
                      alert("invalid input");
                      return false;
                  }
                  return true;
              }  
        </script>
    </head>
    <body>
        <?php include_once("../header.php");?>
  <div class="marginleft">
        <form method ="post" onsubmit='return chk()' action ='do_insert.php' >
             <div>
                 Tipo de activo : <input type ="text" name ="t_name" id = 't_name'>
             </div>

             <div>
                 <input type="submit" name ="submit" value = "insertar">
                 
            </div>
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
