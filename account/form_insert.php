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

    include_once("../header.php");
           
?>
<?php

         require_once '../setting.php';
            $conn = mssql_connect($db_host, $db_user, $db_pw);
            mssql_select_db($db_name, $conn);
?>
<html>
    <head>
        <meta charset="UTF-8">
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
        <title>insertar cuenta</title>

    </head>
    <body>
          <div class="marginleft">
        <form method ="post"  action ='do_insert.php' id='myform' onsubmit="return validateForm('myform')">
            <div>
                <?php
                    $sql = "select p_id, p_name, p_lastname from dbo.Person order by p_name, p_lastname";
                     $result = mssql_query($sql,$conn);
                

                ?>
                Nombre : 
                <select name ='p_id'><?php
                    while($row = mssql_fetch_array($result)){
                        ?>
                    <option value ='<?php echo $row['p_id'];?>'> <?php echo $row['p_name']." ".$row['p_lastname'];?></option>
                            <?php
                    }
                    ?>
                </select>
                
            </div>
            <div>
                 autoridad : 
                 <select name ="login_authority" id = 'login_authority'>
                     <option value='admin'> admin</option>
                     <option value='otros'> otros</option>
                 </select>
            </div>
            <div>
                 ID : <input type ="text" name ="login_identity" id = 'login_identity'>
            </div>
            <div>
                Contraseña : <input type ="password" name ="pwd" id = 'pwd'>
            </div>
            <div>
                 <input type="submit" name ="submit" value = "insertar">
                 
            </div>
            
        </form>
        <button type ="button"  onclick="history.back()"> volver </button>
        </div>
        <?php include_once '../footer.php';?>
    </body>
</html>
