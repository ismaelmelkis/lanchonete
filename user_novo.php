
<html>

<?php
	include "header.php";
	include "config.php";
	//include "include/change_color.php";  // o script do lado é responsável pela troca das cores na tabela de listagem.
	date_default_timezone_set('America/Sao_Paulo');
	
	$connect_new = mysqli_connect($Host, $Usuario, $Senha, $Base);
	
	if(isset($_GET["id"]))
		$id = $_GET["id"];
	else
		$id = "";
	
	if($id != ""){
		$userQuery = mysqli_query($connect_new, "SELECT *
                FROM   usuarios
				WHERE cod_usuario = " . $id);
	
		$userRow = mysqli_fetch_object($userQuery);
		
		/*$setorRow = mysqli_fetch_object($setorQuery);
		
		$setor_desc = $setorRow->setor_desc;
		$setor_responsav = $setorRow->setor_responsav;
		$setor_email = $setorRow->setor_email;
		$nivel = $userRow->nivel;
		$login = $userRow->login;*/
		
		$op = "alterar";
	}else{
		$op = "salvar";
		
		$setor_desc = "";
		$setor_responsav = "";
		$setor_email = "";
		$nivel = "";
		$login = "";
	}
	
?>
<script language="JavaScript">
	function alterar_senha(id){
        window.location = 'setor_muda_senha.php?id='+id;
    }
	function excluir(id){
        window.location = 'setor_save.php?op=excluir&id='+id;
    }
	
	//Validação de Senhas . . .
	function validarSenha(formExemplo){
		tipoUsuario = document.getElementById('tipo_user').value;
    	senha =  document.getElementById('password').value;
    	senhaRepetida = document.getElementById('confirm_password').value;
		if (senha != senhaRepetida){
        	alert("Repita a senha corretamente");
        	document.formExemplo.confirm_password.focus();  
    	}
		if (tipoUsuario == ""){
        	alert("Voce Deve escolher qual o tipo de usario!");
        	document.formExemplo.tipo_user.focus();  
    	}
		if (senha.length < 6){
        	alert("A Senha deve Conter no Minimo 6 Caracteres");
        	document.formExemplo.confirm_password.focus();  
    	}
	}

</script>
   
   <div id="panel" class="panel panel-default no-padding" >
			<div class="panel-body no-padding">
				<form role="form" class="form-horizontal" action="<?php echo 'setor_save.php?op=' . $op . '&id=' . $id ?>" method="post">
					<div class="row-fluid">
						<div id="colImg" class="col-md-2 col-sm-2 col-xs-12 col-img">
							<!-- Background image -->
						</div>
						<div class="col-md-5 col-sm-5 col-xs-12  padding border-right">
							
							<p class="lead"><b>Cadastrar Novo Setor</b></p>
						<?php if ($id!= "") { ?><label label-default="" for="">Nome</label><?php } ?>
							<div class="row">
								<div class="col-md-12">
									<input type="text" name="nome" value="<?php echo $setor_desc ?>" placeholder="* Nome do Usuario" class="form-control" required>
								</div>
							</div>
							<br/>
						<?php 
							if ($op == "alterar"){
								if ($nivel == "tecnico") { 
									$selected2 = "selected"; 
								}else{
									$selected1 = "selected";
								}		
							}else{
								$selected0 = "selected";
							}
						?>
						<?php if ($id!= "") { ?><label label-default="" for="">Tipo de Usuario</label><?php } ?>
							<div class="row">
								<div class="col-md-12">
									<select id="tipo_user" name="tipo_user" class="form-control" required>
										<option name="" <?php echo $selected0 ?> value="">* Tipo de Usuario</option>
										<option name="tipo_user" <?php if (isset($selected1)) echo $selected1 ?> value="usuario">Usu&aacute;rio</option>
										<option name="tipo_user" <?php if (isset($selected2)) echo $selected2 ?> value="tecnico">T&eacute;cnico</option>
									</select>
								</div>
							</div>
							<br/>
						<?php if ($id!= "") { ?><label label-default="" for="">Login</label><?php } ?>
							<div class="row">
								<div class="col-md-12">
									<input type="text" name="login" value="<?php echo $login ?>" placeholder="* Login" class="form-control" required>
								</div>
							</div>
							<br/>
						<?php if ($op == "salvar"){ ?>
						<?php if ($id!= "") { ?><label label-default="" for="">Senha:</label><?php } ?>
							<div class="row">
								<div class="col-md-12">
									<input type="password" name="senha" id="password" placeholder="* Senha, no m&iacute;nimo 6 d&iacute;gitos" class="form-control" data-minlength="6" required>
								</div>
							</div>
							<br/>
						<?php if ($id!= "") { ?><label label-default="" for="">Repetir Senha:</label><?php } ?>
							<div class="row">
								<div class="col-md-12">
									<input type="password" name="confirm_password" id="confirm_password" placeholder="* Confirme sua Senha" class="form-control" onMouseOut="validarSenha(this)" required>
								</div>
							</div>
							<br/>
							<div class="row-fluid">
								<input type="submit" value="Salvar" class="btn btn-success salvar">
								<button class="btn btn-default limpar">Limpar</button>
								<a href="JavaScript: window.history.back();" class="btn btn-default limpar">Voltar</a>
							</div>
							
						<?php }else{ ?>
							<div class="row-fluid">
								<input type="submit" value="Salvar Alteracoes" class="btn btn-primary alterar" >
								<input type="button" value="Alterar Senha" class="btn btn-info alterar" onclick="alterar_senha('<?php echo $id ?>')">
								<input type="button" value="Excluir" class="btn btn-danger excluir" onclick="excluir('<?php echo $id ?>')">	
								<a href="JavaScript: window.history.back();" class="btn btn-default limpar">Voltar</a>
							</div>
						<?php } ?>
						
						</div>
					</div>
				</form>
			</div>
		</div>




<?php
	include "footer.php";
?>

</html>