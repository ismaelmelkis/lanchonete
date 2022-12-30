<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/css/tether.min.css">
  
  <!-- Bootstrap core CSS -->
    <link href="include/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="include/bootstrap/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <link href="offcanvas.css" rel="stylesheet">
    <script src="include/bootstrap/assets/js/ie-emulation-modes-warning.js"></script>

<?php
	//Controle GET
	ini_set('default_charset', 'UTF-8');
	date_default_timezone_set('America/Sao_Paulo');
	$data_atual = date("Y-m-d");	
	include "config.php";
    include "valida_user.inc";
	//$id_usuario = $_GET['user'];
	
	
	$connect_new = mysqli_connect($Host, $Usuario, $Senha, $Base);
?>

    <title>SiPED - Sistema de Gerenciamento de Pedidos </title>    
</head>

<body>  
  <nav class="navbar navbar-fixed-top navbar-inverse">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">SiPED</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="index.php">Trocar Usuario</a></li>
            <li class="active"><a href="index.php">Sair</a></li>
          </ul>
        </div>
      </div>
    <!-- /.container --><!-- /.nav-collapse --><!-- /.navbar -->

			<style type="text/css">
				#file {
    				opacity: 0;
    				-moz-opacity: 0;
    				filter: alpha(opacity=0);
    				position: absolute;
    				z-index: -1;
				}
			</style>
		</nav>
			<div align="center" class="alert alert-success" role="alert" id="imgpos2">
				<h1>
						<b>Logout do Sistema</b><br/>
				</h1>
				<h3>
				O logout foi realizado com sucesso. <br/>
				<a href="index.php">Clique aqui</a>, para realizar o Login novamente.<br/>
				Para se Informar sobre o Sistema envie um e-mail para <b>ismaelmelkis@gmail.com <br/><br/>
				Empresa: Padaria Sabor Caseiro </b>
				</h3>	
			</div>
<?php 
			mysqli_close($connect_new);
			session_destroy();
?>
<!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
</body>
</html>