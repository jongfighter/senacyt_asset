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

    if(!isset($_POST['asset_id'])){
        header("Location : ../main.php");
    }
            $asset_id = $_POST['asset_id'];
            $curr_p_id = $_POST['p_id'];
            $fullname = $_POST['p_fullname'];
            $db_host = "localhost";
            $db_user = "sa";
            $db_pw = "vamosit";
            $db_name = "senacyt_asset";
            $conn = mssql_connect($db_host, $db_user, $db_pw);
            mssql_select_db($db_name, $conn);
            $sql = "select * from dbo.Asset where asset_id =".$asset_id;
            $sql2 = "select * from dbo.Person;";
            $sql3 = "select * from dbo.Loc;";
            $sql4 = "SELECT * FROM dbo.Department;";
            $result_asset = mssql_query($sql,$conn);
            $result_person = mssql_query($sql2, $conn);
            $result_loc = mssql_query($sql3,$conn);
            $result_dept = mssql_query($sql4, $conn);
            $row_dept = mssql_fetch_array($result_dept);
            $row1 = mssql_fetch_array($result_asset);
            
            
            
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

        <title></title>
        
        <script type="text/javascript" src="../chk.js"></script>
    </head>
    <body>
             <?php include_once("../header.php");
              $_SESSION['location_before'] = $row1['loc_id'];
             
             ?>
        <form method ="post"  id="myform" onsubmit="return validateForm('myform')" > 
             
            <input type='hidden' name ='curr_p_id' value ="<?php echo  $curr_p_id;?>"> 
             <input type ="hidden" name ="asset_id" value = "<?php echo $row1['asset_id']?>">   <br> 
             
         <table class="marginleft">
		 <tr>      
            <td class="tablecolor">Placa : </td> <td class="tableinput"> <input type ="hidden" name ="asset_barcode" value = "<?php echo $row1['asset_barcode']?>" > <?php echo $row1['asset_barcode']?>  </td> 
         </tr><tr>		 
			<td class="tablecolor">Descripción : </td> <td class="tableinput"> <input type ="hidden" name ="asset_desc" value = "<?php echo $row1['asset_desc']?>" > <?php echo $row1['asset_desc']?> </td> 
         </tr><tr>   
			<td class="tablecolor">Marca : </td> <td class="tableinput">  <input type ="hidden" name ="asset_brand" value = "<?php echo $row1['asset_brand']?>" > <?php echo $row1['asset_brand']?> </td> 
         </tr><tr>    
			<td class="tablecolor">Modelo : </td> <td class="tableinput">   <input type ="hidden" name ="asset_model" value = "<?php echo $row1['asset_model']?>"   > <?php echo $row1['asset_model']?>  </td> 
         </tr><tr>   
			<td class="tablecolor">Serial : </td> <td class="tableinput">  <input type ="hidden" name ="asset_serial" value = "<?php echo $row1['asset_serial']?>" > <?php echo $row1['asset_serial']?>  </td> 
         </tr><tr>   
			<td class="tablecolor">Detalls : </td> <td class="tableinput">  <input type ="hidden" name ="asset_details" value = "<?php echo $row1['asset_details']?>" > <?php echo $row1['asset_details']?> </td> 
         </tr><tr>    
			<td class="tablecolor">Día de compras : </td> <td class="tableinput">  <input type ="hidden" name ="asset_bought_date" value = "<?php echo $row1['asset_bought_date']?>" > <?php echo $row1['asset_bought_date']?> </td> 
         </tr><tr>  
			<td class="tablecolor">Final de garantía : </td> <td class="tableinput">  <input type ="hidden" name ="asset_guarantee_expired" value = "<?php echo $row1['asset_guarantee_expired']?>" > <?php echo $row1['asset_guarantee_expired']?></td> 
         </tr><tr>   
			<td class="tablecolor">Precio de compras : </td> <td class="tableinput">  <input type ="hidden" step="0.01" name ="asset_price" value = "<?php echo $row1['asset_price']?>"><?php echo $row1['asset_price']?></td> 
         </tr><tr>    
			<td class="tablecolor">Proveedor : </td> <td class="tableinput">  <input type ="hidden" name ="asset_provider" value = "<?php echo $row1['asset_provider']?>"  > <?php echo $row1['asset_provider']?>  </td> 
         </tr>
		 
		 </table> 
		 
		 <br>
                        Quien alquila : <?php echo $fullname;?>
		
                 <br>
			A quien alquila : <select name ='p_id'> <?php
              
                 while($row2 =  mssql_fetch_array($result_person)){
                     ?>
                 <option value='<?php echo $row2['p_id']?>'> <?php echo $row2['p_name']." ".$row2['p_lastname'];?></option>
                 <?php
                 }
                 ?>
             </select>
		
		<br>
		
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
            
            <br>
            
            <div>Día de alquilar <input type='date' name ='asset_out' class="datepicker" value = '<?php echo date("Y-m-d");?>'required > </div>
      
            
             <div>
                 
                 <input type="submit" name ="optype" value = "confirmar" formaction="do_rent.php">
                 <input type="submit" name ="excel" value = "excel" formaction="print_excel2.php">
            </div>
        </form>
        <?php include_once '../footer.php';?>
    </body>
</html>

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
