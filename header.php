<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
<head>
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  
  	<!-- Icones para Mobile e Desktop -->
	<link rel="apple-touch-icon" sizes="180x180" href="img/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
	<link rel="manifest" href="img/site.webmanifest">
	<link rel="mask-icon" href="img/safari-pinned-tab.svg" color="#5bbad5">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="theme-color" content="#ffffff">
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/css/tether.min.css">
  
  <!-- Bootstrap core CSS -->
    <link href="include/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="include/bootstrap/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <link href="offcanvas.css" rel="stylesheet">
    <script src="include/bootstrap/assets/js/ie-emulation-modes-warning.js"></script>

<?php
	//Controle GET
	date_default_timezone_set('America/Sao_Paulo');
	ini_set('default_charset', 'UTF-8');
	$data_atual = date("Y-m-d");
	$time = date("H:i:s");
	
    include "valida_user.inc";
	//$id_usuario = $_GET['user'];
     
?>

    <title>SiPED - Sistema de Gerenciamento de Pedidos </title>    
</head>

<body>  
      <?php include "menu.php"; ?>
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