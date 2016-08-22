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

        // put your code here
        $p_lastname = $_POST['p_lastname'];
        $p_name = $_POST['p_name'];
        $login_identity = $_POST['login_identity'];
        $login_authority = $_POST['login_authority'];
        $pw = $_POST['pwd'];

        $db_host = "localhost";
        $db_user = "sa";
        $db_pw = "vamosit";
        $db_name = "senacyt_asset";
        $conn = mssql_connect($db_host, $db_user, $db_pw);
        mssql_select_db($db_name, $conn);
        
        $sql = "select p_id from Person where p_lastname = '{$p_lastname}'and p_name = '{$p_name}'";
        $res = mssql_query($sql, $conn);
        $rearray = mssql_fetch_array($res);
        $p_id = $rearray[0];
        $sql = "select login_id from Login where login_identity = '{$login_identity}'";
        $res = mssql_query($sql, $conn);
        $rearray = mssql_fetch_array($res);
        $rep = $rearray[0];
        if($p_id != NULL && $rep == NULL){
            $sql = "INSERT INTO Login (login_identity, login_password, p_id, login_authority) VALUES('".$login_identity."',"."pwdencrypt('".$pw."'),".$p_id.",'".$login_authority."');";
            
            mssql_query($sql,$conn);
            echo "<script> alert('success');"
            . "window.location.href = 'form_list.php';</script>";
        }
        else if($rep != NULL){
            echo "<script> alert('That ID is Already used');"
            . "window.location.href = 'form_insert.php';</script>";
        }
        else{
            echo "<script> alert('invalid name');"
            . "window.location.href = 'form_insert.php';</script>";
        }
        
      
        
       
       

