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
        $dename = $_POST['dept_name'];
        require_once '../setting.php';
        $conn = MSSQL_CONNECT($db_host, $db_user, $db_pw) or DIE("DATABASE FAILED TO RESPOND."); ;
        mssql_select_db($db_name, $conn) or DIE("Table unavailable");
        $sql = "select dept_id from department where dept_name='".$dename."'";
        $res = mssql_query($sql, $conn);
        $rearray = mssql_fetch_array($res);
        if($rearray[0] == NULL){
            $sql = "insert into department (dept_name) values ('".$dename."');";
            mssql_query($sql, $conn);
             ?><script>alert("success");</script>';<?php
        }
        else{
            ?><script>alert("there is already registered");</script>';<?php
        }
        ?>
        <meta http-equiv="refresh" content="0;url=form_list.php">
    </body>
</html>
