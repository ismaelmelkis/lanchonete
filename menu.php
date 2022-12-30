<?php include "valida_user.inc"; ?>
<nav class="navbar navbar-fixed-top navbar-inverse">	
	<div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
		  <!--span class="label label-default" style="font-size: 18">ServiceDesk</span-->
          <a class="navbar-brand" href="#">SiPED  :. Gestão de Pedidos</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pedidos <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="pedido_novo.php?tipo=Lanchonete">Novo Pedido</a></li>
						<li><a href="pedido_lista.php">Listar Todos Pedidos</a></li>												
						<li><a href="acesso_negado.php">Pedidos Diarios</a></li>
						<li><a href="acesso_negado.php">Relat&oacute;rio</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
					Usuarios <span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
					<?php if ($_SESSION["nivel_usuario"]!= "user") {  ?>
						<li><a href="acesso_negado.php">Cadastrar</a></li>
						<li><a href="acesso_negado.php">Listar</a></li>
					<?php }else{  ?>
						<li><a href="acesso_negado.php?id=<?php echo $_SESSION["user_id"] ?>">Muda Senha</a></li>
					<?php } ?>
					</ul>
				</li>
				<li><a href="acesso_negado.php">Estat&iacute;stica</a></li>	
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Ferramentas <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="acesso_negado.php">Atualiza&ccedil;&atilde;o</a></li>
						<li><a href="acesso_negado.php">Backup</a></li>
						<li><a href="acesso_negado.php">Acessos</a></li>
					</ul>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-user"></span> <?php echo $nome_usuario ?></a></li>
      <li><a href="<?php echo "logout.php" ?>"><span class="glyphicon glyphicon-log-in"></span> Sair</a></li>
    </ul>
        </div>
      </div>
</nav><!-- /.container --><!-- /.nav-collapse --><!-- /.navbar -->