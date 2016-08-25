<?php
if(!isset($_POST['user_id']) || !isset($_POST['user_pw'])) exit;
$user_id = $_POST['user_id'];
$user_pw = $_POST['user_pw'];

require_once 'setting.php';
$conn = mssql_connect($db_host, $db_user, $db_pw);
mssql_select_db($db_name, $conn);
$sql = "select login_identity, login_authority from Login WHERE PWDCOMPARE('".$user_pw."', login_password ) =1 and login_identity = '".$user_id."'";
$result = mssql_query($sql, $conn);
$row = mssql_fetch_array($result);
if($row[0] != NULL){
    session_start();
    $_SESSION['user_id'] = $row['login_authority'];

  
    ?>
    <meta http-equiv='refresh' content='0;url=main.php'>
    <?php
}
else{
    ?>
    <script> alert("invalid id or password");</script>
    <meta http-equiv='refresh' content='0;url=index.html'>
    <?php
}
?>
