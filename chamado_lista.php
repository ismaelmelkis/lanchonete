
<html>
<?php
	include "header.php";
	include "config.php";
	include "valida_user.inc";
	include "include/change_color.php";  // o script do lado é responsável pela troca das cores na tabela de listagem.
	date_default_timezone_set('America/Sao_Paulo');
	$datatime = date('Y-m-d H:i');
	
	$connect_new = mysqli_connect($Host, $Usuario, $Senha, $Base);
	
	if ($_SESSION["nivel_usuario"]!= "tecnico"){
		$cQuery = "SELECT *
                FROM  chamados
                WHERE setor_id = '" . $_SESSION["setor_id"] . "' ORDER BY data_abertura DESC"; 
	}else{
		$cQuery = "SELECT *
                FROM  chamados
                ORDER BY data_abertura DESC"; 
	}
    $oUsers = mysqli_query($connect_new, $cQuery);
    $num_registros = mysqli_num_rows($oUsers);
	
	function diferenca($inicio , $fim , $saidaFormatada = '%a' ){
		$data1 = date_create($inicio);
		$data2 = date_create($fim);
		$interval = date_diff($data1, $data2);
		
		return $interval->format($saidaFormatada);
	}
?>
<script language="JavaScript">
	function visualizar(id){
        window.location = 'chamado_novo.php?id='+id;
    }
	function avaliar(id){
        window.location = 'avaliacao.php?id='+id;
    }
</script>
     
		<div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">Meus Chamados</h3>
            </div>
            <div class="panel-body">
              <table class="table">
            <thead>
              <tr style="font-size: 14;">
				<th>ID</th>
                <th>Aberto em </th>
                <th>Setor</th>
				<th>Titulo</th>
				<th>Status</th>
				<th>Tempo</th>
              </tr>
            </thead>
            <tbody>
             
    <?php
       while ($oRow = mysqli_fetch_object($oUsers)) {
		
		//Diferença de Tempo
		if (isset($oRow->data_fecha)) {
			$tempo = diferenca($oRow->data_abertura, $oRow->data_fecha, $saidaFormatada = '%h:%i');
		}else{
			$tempo = diferenca($oRow->data_abertura, $datatime, $saidaFormatada = '%h:%i');
		}
		
		$sQuery = mysqli_query($connect_new, "SELECT *
            FROM setor
            WHERE setor_id = ". $oRow->setor_id);
		$sRow = mysqli_fetch_object($sQuery);
			if(isset($sRow->setor_desc)){
				$setor_desc = $sRow->setor_desc;
			}else{
				$setor_desc = "Setor Excluido";
			}
			
			if($oRow->status == "Aberto"){ 
				$cor_chamado = "red";
				$status = "Aberto";
			}
			if($oRow->status == "Finalizado"){ 
				$cor_chamado = "#00BB27";
				$status = "Finalizado";				
			}
			if($oRow->status == "Em Andamento"){ 
				$cor_chamado = "#0A60D4";
				$status = "Em Andamento";
			}
			if(($oRow->status == "Aguardando Finalizacao") && ($_SESSION["nivel_usuario"]!= "tecnico")){
				$status = "<button type=\"button\" onClick=\"avaliar('" . $oRow->codigo . "')\" class=\"btn btn-sm btn-danger\">Favor Finalizar</button>";
				$cor_chamado = "black";
			}
			if(($oRow->status == "Aguardando Finalizacao") && ($_SESSION["nivel_usuario"]== "tecnico")){
				$status = "<h5><span class=\"label label-default\">Aguardando Finalizar</span></h5>";
				$cor_chamado = "black";
			}
			if(($oRow->status == "Aguardando Finalizacao") && ($_SESSION["nivel_usuario"]!= "tecnico")){
	?>
              <tr style="font-size: 12; color: <?php echo $cor_chamado ?>;">
	<?php
			}else{
	?>
	              <tr ONMOUSEOVER="move_i(this)" ONMOUSEOUT="move_o(this)" onClick="visualizar('<?php echo $oRow->codigo ?>')" style="font-size: 12; color: <?php echo $cor_chamado ?>;">
	<?php
			}
	?>
				<th><?php echo $oRow->codigo ?></th>
                <th><?php echo date('d/m/Y - H:i:s', strtotime($oRow->data_abertura)); ?></th>
                <th><?php echo $setor_desc ?></th>
				<th><?php echo $oRow->titulo ?></th>
				<th>
					<?php
						echo $status;
					?>
				</th>
				<th><?php echo $tempo ?></th>
			  </tr>
	<?php
		}
    ?>            
            </tbody>
          </table>
            </div>
        </div>

<?php
	include "footer.php";
?>

</html>