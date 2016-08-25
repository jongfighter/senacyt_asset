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
        $dept_id = $_POST['dept_id'];
        $dept_name = $_POST['dept_name'];
        require_once '../setting.php';
        $conn = mssql_connect($db_host, $db_user, $db_pw);
        mssql_select_db($db_name, $conn);
        

        
        $sql = "UPDATE dbo.Department SET dept_name ='{$dept_name}' WHERE dept_id = {$dept_id};";
        mssql_query($sql,$conn);
        
        $sql = "select dept_id, dept_name from dbo.Department where dept_id = ".$dept_id.";";
        $res = mssql_query($sql, $conn);
        
        $rearray = mssql_fetch_array($res);
        if($res){
            ?>
         <script>alert("éxito"); </script>
                <meta http-equiv="refresh" content="0;url=form_list.php">
                <?php
        }
        else{
            ?>
                <script>alert("fracaso");</script>
                <meta http-equiv="refresh" content="0;url=form_list.php">
                <?php
        }
        
       
        ?>
    </body>
</html>
