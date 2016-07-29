<?php

session_cache_limiter('nocache, must-revalidate');

    session_start();
    include_once '../udf_php.php';
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
        <script src="../js/jquery-3.1.0.min.js"></script>
        <script src="../js/jquery-ui.js"></script>
        <script type="text/javascript" src="../chk.js"></script>
   <script>
        
  $(function() {
    $( "#datepicker", "#datepicker2", "#datepicker3" ).datepicker({
        changeMonth : true,
        changeYear : true,
        nextText: 'next',
        prevText: 'previous',
        currentText : 'today',
        closeText : 'close',
        dateFormat: 'yy-mm-dd'
    });
  });

       </script>
    
    </head>
    
    <body>
        <?php include_once("../header.php");
         $db_host = "localhost";
            $db_user = "sa";
            $db_pw = "vamosit";
            $db_name = "senacyt_asset";
            $conn = mssql_connect($db_host, $db_user, $db_pw);
            mssql_select_db($db_name, $conn);
            $sql = "select * from tipo;";
            $result =mssql_query($sql, $conn);

        ?>
        <form method ="post" action ="do_insert.php" id = 'insertion' onsubmit = "return validateForm('insertion')">
             
       
             barcode : <input type ="text" name ="asset_barcode" id = "barcode">  <br>
             description : <input type ="text" name ="asset_desc" id = "desc" >  <br>
             brand : <input type ="text" name ="asset_brand" id = "brand" autocomplete="on">  <br>
             model : <input type ="text" name ="asset_model" id = "model" autocomplete="on">  <br>
             serial : <input type ="text" name ="asset_serial" id = "serial">  <br>
             purchase date : <input type ="date" name ="asset_bought_date" id = "datepicker">  <br>
             warranty end : <input type ="date" name ="asset_guarantee_expired" id = "datepicker2">  <br>
             purchase price : <input type ="number" step="0.01" name ="asset_price" id = "purchase_price" >  <br>
             provider : <input type ="text" name ="asset_provider" id = "asset_provider" autocomplete="on">  <br>
             type : <select>
                 <?php
                    while($row = mssql_fetch_array($result)){
                        ?>
              <option value="<?php echo $row['t_id']; ?>" > <?php echo $row['t_name']; ?>  </option>
                            <?php
                 ?>
                <?php
                    }
                 ?>
                 
             </select><br>
           
             <div>
                 <input type="submit" name ="submit" value = "insert">
           
            </div>
             <button type ="button"  onclick="history.back()"> back </button>
        </form>
        
    </body>
</html>
