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

            $db_host = "localhost";
            $db_user = "sa";
            $db_pw = "vamosit";
            $db_name = "senacyt_asset";
            $conn = mssql_connect($db_host, $db_user, $db_pw);
            mssql_select_db($db_name, $conn);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>

    </head>
    <body>
        <form method ="post"  action ='do_insert.php' onsubmit='return chk()'>
            <div>
                 Apellido : <input type ="text" name ="p_lastname" id = 'p_lastname'>
            </div>
            <div>
                 Nombre : <input type ="text" name ="p_name" id = 'p_name'>
            </div>
            <div>
                 autoridad : <input type ="text" name ="login_authority" id = 'login_authority'>
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
        <?php include_once '../footer.php';?>
    </body>
</html>
