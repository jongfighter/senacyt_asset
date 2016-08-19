<?php
session_cache_limiter('nocache, must-revalidate');
    session_start();
    echo "account : ".$_SESSION['user_id'];
    if($_SESSION['user_id']!='admin'){
        ?>
<script>alert("sign in with admin account"); </script>
<meta http-equiv="refresh" content="0;url=../main.php">
            <?php
    }
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
        <link rel="stylesheet" href="../mystyle.css">
        
    </head>
    
    <body>
        
<?php
        
            include_once("../header.php");
            include_once ("../form_search.html");
            
            $db_host = "localhost";
            $db_user = "sa";
            $db_pw = "vamosit";
            $db_name = "senacyt_asset";
            $conn = mssql_connect($db_host, $db_user, $db_pw);
            mssql_select_db($db_name, $conn);
            $sql = "";              
            $p_id="";
             if(isset($_POST['p_id']))
             {
                 $p_id= $_POST['p_id'];
                             $sql = $sql."select * from (select asset_id, asset_barcode barcode, asset_desc _description,  asset_brand brand,
  asset_model model,   asset_serial serialnumber,    asset_bought_date purchase_date, asset_last_touch last_handled,
	  asset_guarantee_expired guarantee_expired,	   asset_out out_date,	    asset_in in_date,	   asset_price price,
           	    asset_provider _provider,	 p_name person, dept_name department,    loc_building as building, loc_floor as _floor, loc_desc location_description,
            pos as available, A.p_id pid
                 from Asset A inner join Person P on A.p_id = P.p_id inner join Loc L on L.loc_id= A.loc_id inner join Department D on D.dept_id = P.dept_id) as T where pid = {$p_id};";
              
             }
             else{
                 ?>
                     <script>alert("invalid access"):</script>
                         <meta http-equiv="refresh" content="0;url=form_list.php">
                     <?php
             }
             
     
            $result = mssql_query($sql,$conn);
            ?>
                
          <table>
           <tr class="tablecolor">
            <th>placa</th>
            <th>tipo </th>
            <th>descripción</th>
            <th>marca</th>
            <th>modelo</th>
            <th>serial</th>
            <th>detalles</th>
            <th>día de compra</th>
            <th>final de garantía </th>
            <th>salir activo</th>
            <th>entrar activo</th>
            <th>precio de compra</th>
            <th>proveedor</th>
            <th>funcionario</th>
            <th>departamento</th>
            <th>ubicación</th>
            <th> posible </th>
            
           
            <?php
            if($_SESSION['user_id']=='admin'){
            ?>
            <th>última modificación</th>
            
            <?php }?>
            
            
            
        
                
                
                <?php
$unhandled = 3; //define checking period;
while($row = mssql_fetch_array($result)) {
?>
	</tr>
            <tr>
                <td id="centro"><?php echo $row['barcode'];?></td>
                <td id="centro"><?php echo $row['tipo'];?></td>
                <td id="centro"><?php echo $row['_description'];?></td>
                <td id="centro"><?php echo $row['brand'];?></td>
                <td id="centro"><?php echo $row['model'];?></td>
                <td id="centro"><?php echo $row['serialnumber'];?></td>
                <td id="centro"><?php echo $row['details'];?></td>
                <td id="centro"><?php echo date('d-m-Y',strtotime($row['purchase_date']));?></td>
                <td id="centro"><?php echo date('d-m-Y',strtotime($row['guarantee_expired']));?></td>
                <td id="centro"><?php echo date('d-m-Y',strtotime($row['out_date']));?></td>
                <td id="centro"><?php echo date('d-m-Y',strtotime($row['in_date']));?></td>
                <td id="centro"><?php echo $row['price'];?></td>
                <td id="centro"><?php echo $row['_provider'];?></td>
                <td id="centro"><?php echo $row['person'];?></td>
                <td id="centro"><?php echo $row['department'];?></td>
                <td id="centro"><?php echo $row['building']." ".$row['_floor']." ".$row['location_description'];?></td>
                <td id="centro"><?php 
                if($row['available']==1){
                    echo "O";
                }
                else{
                    echo "X";
                }
                 if($_SESSION['user_id']=='admin'){
                ?></td>
                <td        id='centro'         <?php
                $strlast = $row['last_handled'];
                $end = new DateTime($strlast);
                $start = new DateTime();
                $interval = (int) ($start->format('U')-$end->format('U'))/(60*60*24);
                if($interval>$unhandled){
                    echo "bgcolor='#FF0000'";
                } 
                 
                ?>><?php echo date('d-m-Y',strtotime($row['last_handled']));?></td>

                <?php
                
               
                ?>

                <?php
                
                        } ?>    
                
            </tr> 
<?php }?>
            </table>
        
        <?php include_once '../footer.php';?>
    </body>
</html>