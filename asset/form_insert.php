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

<html>
    <head>
        
        
        <meta charset="UTF-8">
        <title></title>
        <script src="../js/jquery-3.1.0.min.js"></script>
        <script src="../js/jquery-ui.min.js"></script>
        <link rel="stylesheet" type='text/css' href='../js/jquery-ui.min.css'>
        
                
        <script>
            
$(function() {
  $( "#guarantee_end" ).datepicker({
    dateFormat: 'yy-mm-dd',

    
  });
});
</script>
        <script type = "text/javascript">
               function isNull(text){
                      if(text==null||text==""){
                          return true;
                      }
                      else{
                          return false;
                      }
                  }
              function chk(){

                  var barcode = document.getElementById("barcode").value;     
                  var desc = document.getElementById("desc").value;
                  var brand = document.getElementById("brand").value;
                  var model = document.getElementById("model").value;
                  var serial = document.getElementById("serial").value;
                  var purchase = document.getElementById("purchase_date").value;
                  var guarantee = document.getElementById("guarantee_end").value;
                  var price = document.getElementById("purchase_price").value;
                  var provider = document.getElementById("asset_provider").value;
                  
                  if(isNull(barcode)){
                      alert("invalid barcode");
                      
                      
                      return false;
                  }
                  if(isNull(desc)){
                      alert("invalid description");
                      return false;
                  }
                  if(isNull(brand)){
                      alert("invalid brand");                      
                      return false;
                  }
                  if(isNull(model)){
                      alert("invalid model");   
                      return false;
                  }
                  if(isNull(serial)){
                      
                      alert("invalid serial");   
                      return false;
                  }
                  if(isNull(purchase)){
                      alert("invalid purchase date");  
                      return false;
                  }
                  if(isNull(guarantee)){
                      alert("invalid guarantee date");  
                      return false;
                  }
                  if(isNull(price)){
                      alert("invalid price");  
                      return false;
                  }
                  if(isNull(provider)){
                      alert("invalid provider name");  
                      return false;
                  }
                  return true;
                  
                  
                  
              }
                
            
            
       
        </script>
            
    </head>
    
    <body>
        <?php include_once("../header.php");?>
        <form method ="post" action ="do_insert.php" onsubmit = "return chk()">
             
       
<!-- table -->
<!-- 내비 desktp&mobile -->
<body data-spy="scroll" data-target=".navbar" data-offset="50">
   <div class="container2">
        Placa &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<input type ="text" name ="asset_barcode" id = "barcode"> <br>
        Descripción &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<input type ="text" name ="asset_desc" id = "desc" > <br>
        Marca &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<input type ="text" name ="asset_brand" id = "brand"> <br>
        Modelo &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<input type ="text" name ="asset_model" id = "model"> <br>
        Serie &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<input type ="text" name ="asset_serial" id = "serial">  <br>
        Detalles &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<input type ="text" name ="asset_details" id = "details"> <br>
        Día de compra &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<input type ="date" name ="asset_bought_date" id = "purchase_date"> <br>
        Final de garantía &nbsp;&nbsp;&nbsp;:&nbsp;<input type ="date" name ="asset_guarantee_expired" id = "guarantee_end"> <br>
        Precio de compra &nbsp;:&nbsp;<input type ="number" step="0.01" name ="asset_price" id = "purchase_price"> <br>
        Proveedor &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<input type ="text" name ="asset_provider" id = "asset_provider">
        <br>tipo  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<select name='type'>
            <?php
            
            $db_host = "localhost";
            $db_user = "sa";
            $db_pw = "vamosit";
            $db_name = "senacyt_asset";
            $conn = mssql_connect($db_host, $db_user, $db_pw);
            mssql_select_db($db_name, $conn);
            $sql = "select t_id, t_name from dbo.tipo;";
            $result = mssql_query($sql,$conn);
             while($row =  mssql_fetch_array($result)){
                     ?>
                 <option value='<?php echo $row['t_id']?>'> <?php echo $row['t_name']?></option>
                   <?php
                 }
                 
                 ?>
             </select>
       <div> 
            <input type="submit" name ="submit" value = "insert"> &nbsp;&nbsp;
         <button type ="button"  onclick="history.back()"> back </button> 
        </div> 
      <br>
   </div>
</body>
<!-- end -->
        <?php include_once '../footer.php';?>
    </body>
</html>
