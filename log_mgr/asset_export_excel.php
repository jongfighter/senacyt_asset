<?php
header( "Content-type: application/vnd.ms-excel; charset=utf-8" );
header( "Expires: 0" );
header( "Cache-Control: must-revalidate, post-check=0, pre-check=0" );
header( "Pragma: public" );
header( "Content-Disposition: attachment; filename=asset_log.xls" );
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        
    </head>
    
    <body>
        
<?php
            
            require_once '../setting.php';
            $conn = mssql_connect($db_host, $db_user, $db_pw);
            mssql_select_db($db_name, $conn);
            $sql = "";
            if(isset($_POST['keyword'])){
                $p_name = $_POST['keyword'];
                
                $sql = $sql."select 
                log_id,
                log_name logname,
                log_date logdate,
                asset_id, 
                asset_barcode barcode, 
                asset_desc _description,
                asset_brand brand,
                asset_model model,
                asset_serial serialnumber,
                asset_bought_date purchase_date,
                asset_last_touch last_handled,
                asset_guarantee_expired guarantee_expired,
                asset_out out_date,
                asset_in in_date,
                asset_price price,
                asset_provider _provider,
		p_name person, 
                dept_name department,
                loc_building as building, loc_floor as _floor, loc_desc location_description,
                pos as available
		 from log_Asset A inner join Person P on A.p_id = P.p_id inner join Loc L on L.loc_id= A.loc_id inner join Department D on D.dept_id = P.dept_id where log_date like '%".$p_name."%' or log_name like '%".$p_name."%' or asset_brand like '%".$p_name."%' or asset_desc like '%".$p_name."%'"
                        . " or asset_barcode like '%".$p_name."%'";
            }
            else{
                
                $sql = $sql."select 
                log_id,
                log_name logname,
                log_date logdate,
                asset_id, 
                asset_barcode barcode, 
                asset_desc _description,
                asset_brand brand,
                asset_model model,
                asset_serial serialnumber,
                asset_bought_date purchase_date,
                asset_last_touch last_handled,
                asset_guarantee_expired guarantee_expired,
                asset_out out_date,
                asset_in in_date,
                asset_price price,
                asset_provider _provider,
		p_name person, dept_name department,
                loc_building as building, 
                loc_floor as _floor, 
                loc_desc location_description,
                pos as available
		from log_Asset A inner join Person P on A.p_id = P.p_id inner join Loc L on L.loc_id= A.loc_id inner join Department D on D.dept_id = P.dept_id ;";
            }
            $result = mssql_query($sql,$conn);
            ?>
                
        <table border ='1'>
            <th>log_name</th>
            <th>log_date</th>
            <th>barcode</th>
            <th>description</th>
            <th>brand</th>
            <th>model</th>
            <th>ssn</th>
            <th>purchase date</th>
            <th>expired date </th>
            <th>asset out</th>
            <th>asset in</th>
            <th>price</th>
            <th>service provider</th>
            <th>person</th>
            <th>department</th>
            <th>building</th>
            <th>floor</th>
            <th>location description</th>
            <th> possible </th>
            
            
            <!--th 는 19개-->
            
            
        
                
                
                <?php
$unhandled = 2; //define checking period;
while($row = mssql_fetch_array($result)) {
?>
            <tr>
                <td><?php echo $row['logname'];?></td>
                <td><?php echo $row['logdate'];?></td>
                <td><?php echo $row['barcode'];?></td>
                <td><?php echo $row['_description'];?></td>
                <td><?php echo $row['brand'];?></td>
                <td><?php echo $row['model'];?></td>
                <td><?php echo $row['serialnumber'];?></td>
                <td><?php echo $row['purchase_date'];?></td>
                <td><?php echo $row['guarantee_expired'];?></td>
                <td><?php echo $row['out_date'];?></td>
                <td><?php echo $row['in_date'];?></td>
                <td><?php echo $row['price'];?></td>
                <td><?php echo $row['_provider'];?></td>
                <td><?php echo $row['person'];?></td>
                <td><?php echo $row['department'];?></td>
                <td><?php echo $row['building'];?></td>
                <td><?php echo $row['_floor'];?></td>
                <td><?php echo $row['location_description'];?></td>
                <td><?php 
                if($row['available']==1){
                    echo "O";
                }
                else{
                    echo "X";
                }
                ?></td>
                 
            </tr> 
<?php }?>
            </table>
    </body>
</html>