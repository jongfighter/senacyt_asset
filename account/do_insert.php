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
        $p_id = $_POST['p_id'];
        $login_identity = $_POST['login_identity'];
        $login_authority = $_POST['login_authority'];
      
        $pw = $_POST['pwd'];

        require_once '../setting.php';
        $conn = mssql_connect($db_host, $db_user, $db_pw);
        mssql_select_db($db_name, $conn);
  
        $sql = "IF NOT EXISTS(SELECT * FROM Login where p_id = {$p_id} or login_identity = '{$login_identity}') "
                . "INSERT INTO Login (login_identity, login_password, p_id, login_authority) VALUES('{$login_identity}',pwdencrypt('{$pw}'),{$p_id}, '{$login_authority}')";
        
        
         mssql_query($sql,$conn);
         $sql2= "SELECT count(p_id) as cnt FROM Login where p_id = {$p_id} or login_identity = '{$login_identity}'";
         $res = mssql_query($sql2,$conn);
         
         
         if($res){
             $row=mssql_fetch_array($res);
             if($row['cnt']==0){
                 ?> <script>alert("success"); </script><?php
           
             }
             else{
                 ?> <script>alert("duplicated username or ID"); </script><?php
             }
             
         }
         else{
            ?> <script>alert("failed"); </script><?php
         }
         ?>
    <meta http-equiv="refresh" content="0;url=form_list.php">
      
        
       
       

