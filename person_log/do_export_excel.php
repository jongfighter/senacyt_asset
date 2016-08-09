<?php
header( "Content-type: application/vnd.ms-excel; charset=euc-kr" );
header( "Expires: 0" );
header( "Cache-Control: must-revalidate, post-check=0, pre-check=0" );
header( "Pragma: public" );
header( "Content-Disposition: attachment; filename=export.xls" );
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        
<?php
            
            $db_host = "localhost";
            $db_user = "sa";
            $db_pw = "vamosit";
            $db_name = "senacyt_asset";
            $conn = mssql_connect($db_host, $db_user, $db_pw);
            mssql_select_db($db_name, $conn);
            $sql = "";
            if(isset($_POST['keyword'])){
                $p_name = $_POST['keyword'];
                
                $sql = $sql."select p_id, log_name, log_date, p_lastname, p_name, dept_name, dept_location, Department.dept_id as dept_id from log_Person inner join Department on Department.dept_id=log_Person.dept_id where 
log_name like '%{$p_name}%' or log_date like '%{$p_name}%' or p_name like '%{$p_name}%' or dept_name like '%{$p_name}%';";
            }
            else{
                $sql = $sql."select p_id, log_name, log_date, p_lastname, p_name, dept_name, dept_location from log_Person, Department where log_Person.dept_id = Department.dept_id";
            }
            $result = mssql_query($sql,$conn);
            echo "<table border='1'><tr>";
            for($i = 1; $i < mssql_num_fields($result); $i++) {
            $field_info = mssql_fetch_field($result, $i);
            echo "<th>{$field_info->name}</th>";
        }
        echo "</tr>";

// Print the data
    while($row = mssql_fetch_row($result)) {
        $num = 0;
        $arraypass[5];
        echo "<tr>";
        foreach($row as $_column) {
            if($num==0){
               
            }
            else{
                echo '<td ><input type ="text" value = "'.$_column.'" disabled = true ></td>';
            }
            $num = $num+1;
        }
    }

echo "</table>";
 ?>
        
            
        </form>
    </body>
</html>
