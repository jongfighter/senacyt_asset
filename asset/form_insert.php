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
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>

  <!--  Scripts-->
  <script src="../js/jquery-2.1.1.min.js"></script>
  <script src="../js/materialize.js"></script>
  <script src="../js/init.js"></script>

  
  <!-- CSS  -->
  <link href="../fonts/material_icons.woff" rel="stylesheet">
  <link href="../fonts/montserrat.woff" rel="stylesheet" type="text/css">
  <link href="../css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="../css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
   <script type="text/javascript" src="../chk.js"></script>

                
            
            
       
                  
    </head>
    
    <body>
        <?php include_once("../header.php");?>
        <form method ="post" action ="do_insert.php" id='myform' onsubmit="return validateForm('myform')">
             
       
<!-- table -->
<!-- 내비 desktp&mobile -->
<body data-spy="scroll" data-target=".navbar" data-offset="50">
    <div class="marginleft">
   <div class="container2">
        Placa &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<input type ="text" name ="asset_barcode" id = "barcode"> <br>
        Descripción &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<input type ="text" name ="asset_desc" id = "desc" > <br>
        Marca &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<input type ="text" name ="asset_brand" id = "brand"> <br>
        Modelo &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<input type ="text" name ="asset_model" id = "model"> <br>
        Serial &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<input type ="text" name ="asset_serial" id = "serial">  <br>
        Detalles &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<input type ="text" name ="asset_details" id = "details"> <br>
        Fecha de compra &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<input type ="date" class="datepicker" name ="asset_bought_date" id = "purchase_date"> <br>
        Final de garantía &nbsp;&nbsp;&nbsp;:&nbsp;<input type ="date" class="datepicker" name ="asset_guarantee_expired" id = "guarantee_end"> <br>
        Precio de compra &nbsp;:&nbsp;<input type ="number" step="0.01" name ="asset_price" id = "purchase_price"> <br>
        Proveedor &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<input type ="text" name ="asset_provider" id = "asset_provider">
	
        <br>Tipo  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<select name='type'>
            <?php
            
        require_once '../setting.php';
            $conn = mssql_connect($db_host, $db_user, $db_pw);
            mssql_select_db($db_name, $conn);
            $sql = "select t_id, t_name from dbo.tipo order by t_name;";
            $result = mssql_query($sql,$conn);
             while($row =  mssql_fetch_array($result)){
                     ?>
                 <option value='<?php echo $row['t_id']?>'> <?php echo $row['t_name']?></option>
                   <?php
                 }
                 
                 ?>
             </select>
             <div>
               Ubicación &nbsp; &nbsp; &nbsp;&nbsp;  &nbsp; &nbsp;&nbsp;&nbsp;   &nbsp;&nbsp;  :       <select name ='loc_id' id = 'location_name'>
                 <?php
                 $sql = "select loc_id, loc_building, loc_floor, loc_desc from dbo.Loc order by loc_building, loc_floor, loc_desc;";
                $result = mssql_query($sql,$conn);
                 while($row =  mssql_fetch_array($result)){
                     ?>
                 <option value='<?php echo $row['loc_id']?>'> <?php echo "Edificio. ".$row['loc_building'].' Nivel '.$row['loc_floor'].' '. $row['loc_desc'] ?></option>
                 <?php
                 }
                 
                 ?>
             </select>
             </div>
             <div>
                Funcionario &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; :      <select name ='Person' id = 'Person'>
                 <?php
                 $sql = "select p_id, p_lastname, p_name from dbo.Person order by p_name, p_lastname;";
                $result = mssql_query($sql,$conn);
                 while($row =  mssql_fetch_array($result)){
                     ?>
                 <option value='<?php echo $row['p_id']?>'> <?php echo $row['p_name']." ".$row['p_lastname'] ?></option>
                 <?php
                 }
                 
                 ?>
             </select>
             </div>
       <div> 
            <input type="submit" name ="submit" value = "insertar"> &nbsp;&nbsp;
         <button type ="button"  onclick="history.back()"> volver </button> 
        </div> 
      <br>
   </div>
    </div>
</body>
<!-- end -->
        <?php include_once '../footer.php';?>
 <script>
  
    $('.datepicker').pickadate({
		selectMonths: true, // Creates a dropdown to control month
		selectYears: 24 // Creates a dropdown of 15 years to control year
	});
  
	$(document)
	.ready(function(){
        // Add smooth scrolling to all links in navbar + footer link
        $(".navbar a, footer a[href='#myPage']").on('click', function(event) {
            // Make sure this.hash has a value before overriding default behavior
            if (this.hash !== "") {
                // Prevent default anchor click behavior
                event.preventDefault();

                // Store hash
                var hash = this.hash;

                // Using jQuery's animate() method to add smooth page scroll
                // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
                $('html, body').animate({
                    scrollTop: $(hash).offset().top
                }, 900, function(){

                    // Add hash (#) to URL when done scrolling (default click behavior)
                    window.location.hash = hash;
                });
            } // End if
        });

        $(window).scroll(function() {
            $(".slideanim").each(function(){
                var pos = $(this).offset().top;

                var winTop = $(window).scrollTop();
                if (pos < winTop + 600) {
                    $(this).addClass("slide");
                }
            });
        });
    })
	</script>
    </body>
</html>
