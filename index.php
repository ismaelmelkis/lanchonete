<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
	
	<!-- Icones para Mobile e Desktop -->
	<link rel="apple-touch-icon" sizes="180x180" href="img/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
	<link rel="manifest" href="img/site.webmanifest">
	<link rel="mask-icon" href="img/safari-pinned-tab.svg" color="#5bbad5">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="theme-color" content="#ffffff">
	
    <title>SiPED - Sistema de Gerenciamento de Pedidos</title>

    <!-- Bootstrap core CSS -->
    <link href="include/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="include/bootstrap/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="include/bootstrap/assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="include/bootstrap/assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">

      <form class="form-signin" method="POST" action="login.php">
        <h1 class="form-signin-heading" align="center" >
		<span class="label label-default">SiPED </span></h1></br>
		<h3 class="form-signin-heading" align="center" >
		Sistema de Gerenciamento de Pedidos</h3>
        <label for="inputText" class="sr-only">Usu&aacute;rio:</label>
        <input type="text" id="inputEmail" name="username" class="form-control" placeholder="Usuario" autofocus>
        <label for="inputPassword" class="sr-only">Senha:</label>
        <input type="password" name="senha" id="inputPassword" class="form-control" placeholder="Senha" required>
        <!-- div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Lembrar-me
          </label>
        </div -->
        <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
        <br/>
		<div class="alert alert-info" role="alert" align="center">
			Entre com o nome de usu&aacute;rio e senha para efetuar o login no <strong>SiPED</strong><br/>
			<strong>Vers&atilde;o 1.0.0</strong>
		</div>
      </form>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="include/bootstrap/assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>