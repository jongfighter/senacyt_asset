
    <head>
        <meta http-equiv="Content-Type" content="text/html" charset="UTF-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
	
	<!--  Scripts-->
        <script src= "../js/jquery-2.1.1.min.js"></script>
	<script src="../js/materialize.js"></script>
	<script src="../js/init.js"></script>
	
	<!-- CSS -->
	<link href="../fonts/montserrat.woff" rel="stylesheet" type="text/css">
	<link href="../css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
	<link href="../css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
        <title></title>
    </head>
    <body>
<header>
<nav class="function">
            <div class="collapse navbar-collapse" id="myNavbar">
				<div class="container">
					<ul class="nav navbar-nav navbar-right">
						<li><a href='../main.php'>Página Inicial</a></li>
						<li><a href='../asset/form_list.php'>Activo</a></li>
							<?php 
							if($_SESSION['user_id']=='admin'){
							?>
						<li><a href="../person/form_list.php">Funcionario</a></li>
						<li><a href="../dept/form_list.php">Departamento</a></li>
						<li><a href="../loc/form_list.php">Lugar</a></li>
						<li><a href="../tipo/form_list.php">Tipo</a></li>
						<li><a href="../log_mgr/asset_log.php">Reportes</a></li>
                                                                
                                                    <?php 
                                                    }
                                                    ?>  
						<li><a href="../do_logout.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cerrar la Sesión</a></li>
					</ul>
				</div>
			</div>
</nav>
</header>
        




