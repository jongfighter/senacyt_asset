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
    </head>
    <body>
        <?php

        // put your code here
        $p_lastname = $_POST['person_lastname'];
        $p_name = $_POST['person_name'];
        $login_identity = $_POST['login_identity'];
        $pwd = $_POST['pwd'];
        $db_host = "localhost";
        $db_user = "sa";
        $db_pw = "vamosit";
        $db_name = "senacyt_asset";
        $conn = mssql_connect($db_host, $db_user, $db_pw);
        mssql_select_db($db_name, $conn);

        
        $sql = "SELECT p_id from Person where p_lastname = '{$p_lastname}' and p_name = '{$p_name}';";
        $res = mssql_query($sql, $conn);
        
        $rearray  = mssql_fetch_array($res);
        $p_id = $rearray[0];
        if($p_id == NULL){
            echo '<br><a href="form_list.php">invalid name</a>';
        }
        else if($pwd==NULL){
            $sql = "UPDATE Login SET  login_identity='{$login_identity}' WHERE p_id = {$p_id};";
            mssql_query($sql,$conn);
         
        }
        else{
            $sql = "UPDATE Login SET  login_identity='{$login_identity}', login_password = pwdencrypt('{$pwd}') WHERE p_id = {$p_id};";
            mssql_query($sql,$conn);
        }
        ?>
        <script>alert("done"); </script>
        <meta http-equiv="refresh" content="0;url=form_list.php">
    </body>
</html>
