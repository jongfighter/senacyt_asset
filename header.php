<?php
session_start();
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
<header>

	<nav>
		<ul>
                <button onclick="window.location.href='../main.php'"> Home</button>
		<button onclick="window.location.href='../asset/form_list.php'"> Asset </button>
                <?php 
                if($_SESSION['user_id']=='admin'){
                ?>
                <button onclick="window.location.href='../person/form_list.php'"> Person </button>
                <button onclick="window.location.href='../dept/form_list.php'"> Department </button>
                <button onclick="window.location.href='../loc/form_list.php'"> Location </button>
                <button onclick="window.location.href='../tipo/form_list.php'"> type </button>
                <button onclick="window.location.href='../account/form_list.php'"> account </button>
                <button onclick="window.location.href='../log_mgr/asset_log.php'"> log </button>
                
  
                
                <?php 
                }
                ?>        
                <button onclick="window.location.href='../do_logout.php'"> logout </button>
                </ul>
	</nav>
	<hr>
</header>



