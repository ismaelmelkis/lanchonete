
<html>
    
<?php
	//Iniciando . . .
	ini_set('default_charset', 'UTF-8');
	include "valida_user.inc";
	include "header.php";
	include "config.php";
	include "include/mobile.php";
	include "include/mascara_kg.js";
	include "include/change_color.php";  // o script é responsável pela troca das cores na tabela de listagem.
	date_default_timezone_set('America/Sao_Paulo');
	$datatime = date('Y-m-d H:i');
	$data_now = date('Y-m-d');
	
	if(isset($_GET["tipo"])){ $_SESSION["tipo"] = $_GET["tipo"]; }
	
	$connect_new = mysqli_connect($Host, $Usuario, $Senha, $Base);
	
	if(isset($_GET["id"])){
		$id = $_GET["id"];
		
		//Pedidos
		$pQuery = mysqli_query($connect_new, "SELECT * FROM pedidos WHERE ped_id = " . $id);
		$pRow = mysqli_fetch_object($pQuery);
		
		//Itens
		$iQuery = mysqli_query($connect_new, "SELECT *
            FROM pedido_itens
            WHERE pi_ped_id = ". $pRow->ped_id);
		
		$data_entrega = date('d/m/Y', strtotime($pRow->ped_data_entrega));
		$hora_entrega = date('H:i', strtotime($pRow->ped_data_entrega));
		
		$cliente = $pRow->ped_cliente;
		$atendente = $pRow->ped_atendente;		
		$data_hs_entrega = date('d/m/Y - H:i a', strtotime($pRow->ped_data_entrega));
		$telefone = $pRow->ped_cliente_tel;
		$obs = $pRow->ped_obs;
		$status = $pRow->ped_status;
		$tipo = $pRow->ped_tipo;
		$fixo = $pRow->ped_fixo;
		$op = "Alterar";
	}else{
		$op = "Salvar";
		$tipo = $_SESSION["tipo"];
		$cliente = "";
		$atendente = $_SESSION["nom_usuario"];
		$data_entrega = "";
		$hora_entrega = "";
		$telefone = "";
		$obs = "";
		$id="";
		$status = "";
		$fixo = "";
	}
	
//monta string SQL
	if(isset($name)){
		$sql = "SELECT * FROM produto WHERE pr_desc like '" . $name . "%'";
		$result = mysqli_query($connect_new, $sql);
	}

?>
<script language="JavaScript">
	function excluir(id){
		alert("Deseja Realmente Excluir o Pedido? ");
        window.location = 'pedido_fixo_save.php?op=excluir&id='+id;
    }
	function excluir_itens(id){
		alert("Deseja Realmente Excluir o item selecionado?");
        window.location = 'pedido_fixo_save.php?op=excluir_itens&id='+id;
    }
	function mudar(produto){
        window.location = 'pedido_fixo.php?id=<?php echo $id ?>&produto='+produto;
    }
	function voltar(id){
        window.location = 'window.history.back()';
    }

	function teclaEnter (field, event) {
		var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
		if (keyCode == 13) {
			var i;
			for (i = 0; i < field.form.elements.length; i++)
			if (field == field.form.elements[i])
		break;
			i = (i + 1) % field.form.elements.length;
			field.form.elements[i].focus();
			return false;
		}
		else
			return true;
	}
</script>
<!-- MASCARAS PARA CAMPOS -->
<script type="text/javascript" src="include/mascara/js/1.5.2.js"></script>
<script type="text/javascript" src="include/mascara/js/jquery.maskedinput-1.3.min.js"></script>
<script>
		jQuery(function($){
		       $("#cpf").mask("999.999.999-99");
		       $("#rg").mask("99.999.999-9");
		       $("#tel").mask("(99)9 9999-9999");
			   $("#tel2").mask("99:99");
		       $("#dt").mask("99/99/9999");
			   $("#pass").mask("99:99");
			   $("#lt").mask("aaaaaaaaaaaaa");
		});
</script>	   
				<center>
						<?php if (isset($_GET["id"])) {
						//Diferença de Tempo
						
								//Calculando Dias
								$hojez = date("Y-m-d");
								$dataz = date('Y-m-d', strtotime($pRow->ped_data_entrega));;
								$dif = strtotime($dataz) - strtotime($hojez);
								$dias = ($dif / 86400);
								
								//Calculando Minutos
								$agoraz = date("H:i:s");
								$minutosz = date('H:i:s', strtotime($pRow->ped_data_entrega));;
								$dif = strtotime($minutosz) - strtotime($agoraz);
								$min = ($dif / 60);
								$hs = ($dif / 3600);
								$minutos = round($min, 0); //Arredondando
								$horas = round($hs, 0);
								
								if (($dias>0) || ($minutos >= 60)){
									$msg = "Pedido: " . $id . " - Entrega: " . $data_hs_entrega . "  <strong> Tempo: Aproximadamente " . $dias . " dias e " . $horas . "hs</strong>";
									$class = "alert alert-success";
								}
								if (($minutos <= 59) && ($dias == 0)){
									$msg = "Pedido: " . $id . " - Entrega: " . $data_hs_entrega . "  <strong> Tempo Restante: " . $minutos . " min - Menos de 1 hora </strong>";
									$class = "alert alert-warning";
								}
								if (($minutos <= 30) && ($dias == 0)){
									$msg = "Pedido: " . $id . " - Entrega: " . $data_hs_entrega . "  <strong> Tempo Restante: " . $minutos . " min - Menos de meia hora </strong>";
									$class = "alert alert-danger";
								}
								if (($dias < 0) || ($dias == 0) && ($minutos <= 0) ){
									$msg = "Pedido: " . $id . " - Entrega: " . $data_hs_entrega . "  <strong> O TEMPO PARA ENTREGA ACABOU</strong> " . $minutos . " Minutos";
									$class = "alert alert-danger";
								}
								if ($status == "Entregue"){
									$msg = "Pedido: " . $id . " - Entrega: " . $data_hs_entrega . "  <strong>A ENCOMENDA FOI ENTREGUE</strong>";
									$class = "alert alert-info";
								}
								if ($status == "Cancelada"){
									$msg = "Pedido: " . $id . " - Entrega: " . $data_hs_entrega . "  <strong> ..PEDIDO CANCELADO ..</strong>";
									$class = "alert alert-default";
								}
								
								
						?>
						<div class="<?php echo $class ?>" role="alert" style="font-size:17">
							<?php echo $msg ?>
						</div>
						<?php }else{  ?>
							<p class="lead"><b>Pedido Fixo de <?php echo $tipo ?></b></p>
						<?php } ?>
				</center>
   <div id="panel" class="panel panel-default no-padding" >
			<div class="panel-body no-padding">
				<form name="form1" role="form" class="form-horizontal" action="<?php echo 'pedido_fixo_save.php?op=' . $op . '&id=' . $id ?>" method="post" enctype="multipart/form-data" onSubmit="return validaForm1()">
					<div class="row-fluid">						
						<div id="colImg" class="col-md-2 col-sm-2 col-xs-12 col-img">
							<!-- Background image -->
						</div>
						<div class="col-md-5 col-sm-5 col-xs-12  padding border-right">
							<label label-default="" for="">Cliente</label>
							<div class="row">
								<div class="col-md-12">
									<input type="text" name="cliente" value="<?php echo $cliente; ?>" placeholder="* Nome do Cliente que esta fazendo o Pedido" class="form-control" tabindex="0" onkeypress="return teclaEnter(this, event)">
								</div>
							</div>
							<br/>
							<label label-default="" for="">Atendente</label>
							<div class="row">
								<div class="col-md-12">
									<input type="text" name="atendente" value="<?php echo $atendente; ?>" placeholder="* Nome do Funcionario que gerou o Pedido" class="form-control" tabindex="1" onkeypress="return teclaEnter(this, event)">
								</div>
							</div>
							<br/>						
							<div class="row">
							<?php if($fixo != "") { ?>
								<div class="col-md-12">
									<label label-default="" for="">Escolha o(s) dia(s) da Semana para Entrega: </label><br/>
										<input type="checkbox" <?php if(strpos($fixo,"0") !== false) echo "checked"; ?> name="dia_semana[]" value="0,"> Domingo &nbsp;
										<input type="checkbox" <?php if(strpos($fixo,"1") !== false) echo "checked"; ?> name="dia_semana[]" value="1,"> Segunda &nbsp;
										<input type="checkbox" <?php if(strpos($fixo,"2") !== false) echo "checked"; ?> name="dia_semana[]" value="2,">
										Terça &nbsp;
										<?php if($mobile == 1) echo "<br/>" ?>
										<input type="checkbox" <?php if(strpos($fixo,"3") !== false) echo "checked"; ?> name="dia_semana[]" value="3,"> Quarta &nbsp;
										<input type="checkbox" <?php if(strpos($fixo,"4") !== false) echo "checked"; ?> name="dia_semana[]" value="4,"> Quinta &nbsp;
										<input type="checkbox" <?php if(strpos($fixo,"5") !== false) echo "checked"; ?> name="dia_semana[]" value="5," > Sexta &nbsp;
										<input type="checkbox" <?php if(strpos($fixo,"6") !== false) echo "checked"; ?> name="dia_semana[]" value="6,"> Sábado &nbsp;&nbsp;
								<br/>
								</div>
							<?php }else{ ?>
								<div class="col-md-12">
									<label label-default="" for="">Escolha o(s) dia(s) da Semana para Entrega: </label><br/>
										<input type="checkbox" name="dia_semana[]" value="0,"  class="form-check-input"> Domingo &nbsp;
										<input type="checkbox" name="dia_semana[]" value="1," class="form-check-input"> Segunda &nbsp;
										<input type="checkbox" name="dia_semana[]" value="2," class="form-check-input"> Terça &nbsp;&nbsp;
										<?php if($mobile == 1) echo "<br/>" ?>
										<input type="checkbox" name="dia_semana[]" value="3," class="form-check-input"> Quarta &nbsp;&nbsp;
										<input type="checkbox" name="dia_semana[]" value="4," class="form-check-input"> Quinta &nbsp;&nbsp;
										<input type="checkbox" name="dia_semana[]" value="5," class="form-check-input"> Sexta &nbsp;&nbsp;
										<input type="checkbox" name="dia_semana[]" value="6," class="form-check-input"> Sábado &nbsp;&nbsp;
								<br/>
								</div>
							<?php } ?>
								<br/><br/>
								<div class="col-md-4">
									<label label-default="" for="">HS da Entrega </label>
									<input type="text" name="hora_entrega" alt="Usar formato 24 hs, HH:mm" value="<?php echo $hora_entrega; ?>" placeholder="hh:mm" maxlength="5" class="form-control" tabindex="3">
							<?php if($op == "Salvar") { ?>
									 <div class="alert alert-danger" role="alert">
										<strong>Atenção!</strong><br/> Utilizar o formato 24 hs, Ex: 20:30, <br/>
										Utilizar <strong> " : "</strong> para separar horas de minutos
									</div>
							<?php } ?>
								</div>
								<?php if($status != "") { ?>
								<div class="col-md-4">
									<label label-default="" for="">Status</label>
									<select id="" name="status" class="form-control">
										<option value="Producao" <?php if($status == "Producao") echo "selected" ?>>Na Producao</option>
										<option value="Produzindo" <?php if($status == "Produzindo") echo "selected" ?> >Produzindo</option>
										<option value="Pronto" <?php if($status == "Pronto") echo "selected" ?>>Pronto para Entrega</option>
										<option value="Entregue" <?php if($status == "Entregue") echo "selected" ?>>Entregue</option>
										<option value="Cancelada" <?php if($status == "Cancelada") echo "selected" ?>>Cancelado</option>
									</select>
								</div>
								<?php } ?>
							</div>					
							<!-- label label-default="" for="">Itens do Pedido</label>
							<div class="row">
								<div class="col-md-12">
									
								</div -->
						</div>
					</div>

					<div class="col-md-5 col-sm-5 col-xs-12  padding">
							
							<label label-default="" for="">Telefone do Cliente</label>
							<div class="row">
								<div class="col-md-10">
									<input type="text" <?php if($mobile == 0) echo "id=\"tel\";" ?> name="telefone" value="<?php echo $telefone; ?>" placeholder="* Informar o Telefone de contato do Cliente" class="form-control" tabindex="4" autocomplete="off">
								</div>
							</div>
							<br/>
							<label label-default="" for="">Observações sobre o Pedido (se houver)</label>
							<div class="row">
								<div class="col-md-12">
									<textarea class="form-control" name="obs" id="exampleFormControlTextarea1" placeholder=" Digitar alguma Observação ou algo a mais que o cliente pedir..." rows="2"> <?php echo $obs ?></textarea>
								</div>
							</div>
							<br/>
							<div class="col-md-14">
								<input type="submit" value="<?php echo $op ?>" class="btn btn-success enviar">
								<input type="button" value="Excluir" class="btn btn-danger excluir" onclick="excluir('<?php echo $id ?>')">
								<a href="JavaScript: window.history.back();" class="btn btn-default limpar">Voltar</a>
						
						<?php if ( ($op == "Alterar") && (!isset($_GET['produto'])) ){  
								 ?>
								<input type="button" alt="Alterar Tipo de Produto" value="Alterar Tipo" class="btn btn-sm btn-warning" onclick="mudar('produto')">
						<?php }
							  if (isset($_GET['produto'])){
								  $label_tipo = "Tipo de Produto";
								  $style_tipo = "display:block";
							  }else{
								  $style_tipo = "display:none";
							  }							  
						?>
									<b>
										<?php if(isset($label_tipo)){ 
												if($mobile == 1) echo "<br/><br/>";
												echo $label_tipo;
											}
										?>
									</b>						
									<label label-default="" for="">
										<select id="" name="tipo" class="form-control" style="<?php echo $style_tipo ?>">
											<option value="Paes" <?php if($tipo == "Paes") echo "selected" ?>>Paes</option>
											<option value="Salgados" <?php if($tipo == "Salgados") echo "selected" ?> >Salgados</option>
										</select>
									</label>		
							</div>
							<br/>							
					</div>						
				</div>
			</form>
		</div>
	</div>
		<!-- AutoComplete -->




<?php
	include "footer.php";
	
	if($op == "Alterar"){
?>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">	
	
	<link type="text/css" href="include/autocomplete/css/jquery-ui-1.8.5.custom.css" rel="Stylesheet" />
	
	<script src="include/autocomplete/js/jquery-1.4.2.min.js" type="text/javascript"></script>
	<script src="include/autocomplete/js/jquery-ui-1.8.5.custom.min.js" type="text/javascript"></script>
	
	<script type="text/javascript">
		$(document).ready(function()
		{
			$('#auto').autocomplete(
			{
				source: "search.php",
				minLength: 2
			});
		});
	</script>

	
<center>
	<div class="row-fluid">
		<form name="form2" autocomplete="off" role="form" class="form-horizontal" action="<?php echo 'pedido_save.php?op=incluir_itens&id=' . $id ?>" method="post" enctype="multipart/form-data" onSubmit="return validaForm()">
			<label label-default="" for="">Buscar Produto: </label>
				<input type="text" name="txtProduto" title="Entre com a Descricao do Produto" id="auto" style="width:300px;" id="txtProduto" class="typeahead" maxlength="70"  tabindex="0" onkeypress="return teclaEnter(this, event)">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<label label-default="" for="">Quantidade: </label>
				<input type="text" title="Entre com a Quantidade" size="5" name="quantidade" value="" tabindex="1" onkeydown="FormataMoeda(this,10,event)"  >
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php if($mobile == 1) echo "<br/><br/>"; ?>
				<input type="submit" value="Incluir Item no Pedido" class="btn btn-primary incluir">
		</form>
	</div>
</center>
	<div class="col-sm-2">
	</div>
	<div class="col-sm-8">
		<div class="panel panel-primary">
            <div class="panel-body">
              <table class="table">
            <thead>
              <tr style="font-size: 12;">
                <th>Descricao do Produto</th>
                <th>Quantidade</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
             
    <?php
       while ($iRow = mysqli_fetch_object($iQuery)) {
	?>	
			          
			<tr ONMOUSEOVER="move_i(this)" ONMOUSEOUT="move_o(this)" style="font-size: 12; color: blue;">
				<th><?php echo $iRow->pi_pr_desc ?></th>
				<th><?php echo $iRow->pi_pr_quant ?></th>
				<th>
					<?php echo "<a href=\"#\" onClick=\"excluir_itens('". $iRow->pi_id . "')\"><img src=\"img/excluir.jpg\" alt=\"Excluir\" width=\"15\" height=\"16\" border=\"0\"></a>" ?>
				
				</th>
			</tr>
	<?php
		}
    ?>            
            </tbody>
          </table>
            </div>
        </div>
	</div>

	<?php } ?>
</html>