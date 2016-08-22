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

<?php
            include_once("../header.php");
            include_once ("../form_search.html");

?>
        <form method ='post' action="../do_export_excel.php">
            <input type ='hidden' name ='searchtext' value ='<?php echo $_POST['keyword'];?>'>
            <input type ='hidden' name ='checkvalue' value =<?php echo $_POST['check'];?>>
            <input type ='submit' name ='imprimir' value = 'excel'>
        </from>
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
               
                $sql = $sql."select p_lastname, p_name, login_identity, login_authority  from Login inner join Person on Person.p_id=Login.p_id where login_identity like '%{$p_name}%' or person.p_lastname like '%{$p_name}%' or person.p_name like '%{$p_name}%';";
               
            }
            else{
                $sql = $sql."select p_lastname, p_name, login_identity, login_authority  from Login inner join Person on Person.p_id=Login.p_id;";
            }
            $result = mssql_query($sql,$conn);
            echo "<table border='1'><tr>";
            
        ?>
                <table border='1'> <tr class="tablecolor">
                        <th>Apellido</th>
                        <th>Nombre</th>
                        <th>autoridad</th>
                        <th>ID</th>
                        <th>Admin</th>
            
                        
            
                    </tr>
            <?php
        

// Print the data
    while($row = mssql_fetch_row($result)) {
        $num = 0;
        $arraypass[3];
        echo "<tr>";
        foreach($row as $_column) {
            echo '<td>'.$_column.'</td>';
            $arraypass[$num]=$_column;
            $num = $num+1;
        }
        echo '<td>';
        echo '<form method="post"> ';
        echo '<input type ="hidden" name = "p_lastname" value = "'.$arraypass[0].'">';
        echo '<input type ="hidden" name = "p_name" value = "'.$arraypass[1].'">';
        echo'<input type ="hidden" name = "login_identity" value = "'.$arraypass[2].'">';
        echo'<input type ="hidden" name = "login_autoridad" value = "'.$arraypass[3].'">';
        echo '<input type="submit" name ="submit" value = "modificar" formaction="form_modify.php" > ';
        echo '<input type="submit" name ="submit" value = "borrar" formaction="do_delete.php"> ';
        ?>
        
       <?php
        echo '</form> </td>';
        echo "</tr>";
    }

echo "</table>";
 ?>
        
            
        </form>
    
    <?php include_once '../footer.php';?>
    </body>
</html>
