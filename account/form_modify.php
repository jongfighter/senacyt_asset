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
        include_once ("../form_search.html");
        
        // put your code here
        $plastname = $_POST['p_lastname'];
        $pname = $_POST['p_name'];
        $login_identity = $_POST['log_identity'];
        ?>
        <?php
        ?>
        
        <form method ="post" action="do_modify.php" id="myform" onsubmit ="return validateForm('myform');"> 
             <div>
                 lastname : <input type ="text" value = '<?php echo $plastname ?>' disabled=true>
                 <input type ="hidden" name ="person_lastname" id = 'p_lastname' value = '<?php echo $plastname ?>'>
                 name : <input type ="text" value = '<?php echo $pname ?>' disabled=true>
                 <input type ="hidden" name ="person_name" id = 'p_name' value = '<?php echo $pname ?>'>
                 ID : <input type ="text" name ="login_identity" id = 'login_identiity' value = '<?php echo $login_identity ?>'>
                 PW : <input type ="password" name ="pwd" id = 'pwd'>
                 
                 
             </div>
             <div>
                 <input type="submit" name ="submit" value = "modify" onclick="return chk()">
                 
            </div>
            
        </form>
        <button type ="button"  onclick="history.back()"> back </button>
        <?php include_once '../footer.php';?>
    </body>
</html>
