<?php
    session_start();
    echo "account : ";
    echo $_SESSION['user_id'];
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php 
  
    
        
        if(isset($_SESSION['user_id'])){
          
        }
       
        include_once("header2.php");
       
        ?>
            
        </form>
    </body>
</html>






