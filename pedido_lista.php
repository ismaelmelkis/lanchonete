
<html>
<?php
ini_set('default_charset', 'UTF-8');
	include "valida_user.inc";
	include "header.php";
	include "config.php";
	include "include/mobile.php";
	//include "include/mascara_kg.js";
	include "include/change_color.php";  // o script do lado é responsável pela troca das cores na tabela de listagem.
	date_default_timezone_set('America/Sao_Paulo');
	$datatime = date('Y-m-d H:i');
	$data_now = date('Y-m-d');
	$x=0;
	
	$connect_new = mysqli_connect($Host, $Usuario, $Senha, $Base);
		
		//Pedidos
		$pQuery = mysqli_query($connect_new, "SELECT * FROM pedidos WHERE ped_status != 'Cancelada' ORDER BY ped_id DESC LIMIT 50");
	
?>
<script language="JavaScript">
	function visualizar(id){
        window.location = 'pedido_novo.php?id='+id;
    }
	function avaliar(id){
        window.location = 'avaliacao.php?id='+id;
    }
</script>
     
		<div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">Encomendas . . .</h3>
            </div>
            <div class="panel-body">
              <table class="table">
            <thead>
              <tr style="font-size: 14;" id="exemplo">
				<th>
                </th>
				<?php if($mobile == 0) echo "<th>Pedido</th>"; ?>
				<th>Cliente</th>
				<?php if($mobile == 0) echo "<th>Telefone</th>"; ?>
				<th>Tempo </th>
				<th>Status</th>
              </tr>
            </thead>
            
             
    <?php
       while ($pRow = mysqli_fetch_object($pQuery)) {
		   $x=$x+1;			
			
			$cliente = $pRow->ped_cliente;	
			$data_hs_entrega = date('d/m/Y - H:i a', strtotime($pRow->ped_data_entrega));
			$status = $pRow->ped_status;
		//Diferença de Tempo
		if (isset($pRow->data_fecha)) {
			$dt_fecha = date('Y-m-d', strtotime($pRow->ped_data_entrega));;
			$hs_fecha = date('H:i:s', strtotime($pRow->ped_data_entrega));;
		}else{
			$dt_fecha = date("Y-m-d");
			$hs_fecha = date("H:i:s");
		}
			//Calculando Dias
			$dt_abri = date('Y-m-d', strtotime($pRow->ped_data));; 
			$dif1 = strtotime($dt_fecha) - strtotime($dt_abri);
			$dias1 = ($dif1 / 86400);
			$dias = round($dias1, 0);//Arredondando
			//echo $dt_abri;
				
			//Calculando Minutos
			$hs_abri = date('H:i:s', strtotime($pRow->ped_data));;
			$dif = strtotime($hs_fecha) - strtotime($hs_abri);
			$min = ($dif / 60%60);
			$hs = ($dif / 3600%3600);
			$minutos = round($min, 0); //Arredondando
			$horas = round($hs, 0); 
			$horas = abs($horas); //Passando para Positivo
			$minutos = abs($minutos); //Passando para Positivo
		
		if ($dias>=1){
			if (($min<0) || ($hs<0) ){
				$dias = $dias - 1;
				$horas = 23 - $horas;
				$minutos = 59 - $minutos;
			}
		}
			$horas = abs($horas); //Passando para Positivo
			$minutos = abs($minutos); //Passando para Positivo
			
			$cor_chamado = "blue";
			
			if ($dias>=1){
				$msg = $dias . " dias e " . $horas . "hs";
			}
			if ($dias==1){
				$msg = $dias . " dia e " . $horas . " hs";
			}
			if (($dias<=0) && ($horas>0) ){
				$msg = "Aprox. " . $horas . "hs";
			}
			if (($dias<=0) && ($horas>0) && ($minutos<=60) ){
				$msg = $horas . "hs e " . $minutos . " min";
			}
			if (($dias<=0) && ($horas<=0)){
				$msg = $minutos . " min";
			}
			
			if($status == "Aberto"){ 
				$cor_chamado = "blue";
				$status = "Aberto";
			}
			if($status == "Pronto"){ 
				$cor_chamado = "red";
				$status = "Pronto para Entrega";
			}
			if($status == "Entregue"){ 
				$cor_chamado = "#00BB27";
				$status = "Entregue";				
			}
			if($status == "Produzindo"){ 
				$cor_chamado = "#EB9A05";
				$status = "Produzindo";
			}
			if($status == "Enviado"){ 
				$cor_chamado = "#CB0156";
				$status = "A Caminho";
			}

	?>
		<tbody onload="document.getElementById('itens<?php echo $x ?>').style.display='none'">
	         <tr ONMOUSEOVER="move_i(this)" ONMOUSEOUT="move_o(this)" style="font-size: 12; color: <?php echo $cor_chamado ?>;">
				<th width="50" height="50">
					<button type="button" alt="Editar Registro" onClick="visualizar('<?php echo  $pRow->ped_id ?>')" class="btn btn-xs btn-warning">E</button>
				
					<button type="button" id="btnmais<?php echo $x ?>" class="btn btn-xs btn-primary" 
					onClick="document.getElementById('itens<?php echo $x ?>').style.display=''; document.getElementById('btnmais<?php echo $x ?>').style.display='none'; document.getElementById('btnmenos<?php echo $x ?>').style.display='block';" >
						+
					</button>
					<button style="display:none" id="btnmenos<?php echo $x ?>" type="button" class="btn btn-xs btn-primary" 
					onClick="document.getElementById('itens<?php echo $x ?>').style.display='none'; document.getElementById('btnmenos<?php echo $x ?>').style.display='none'; document.getElementById('btnmais<?php echo $x ?>').style.display='block';" >
						-
					</button>
				</th>
				<?php if ($mobile == 0) echo "<th>" . $pRow->ped_id . "</th>" ?>
				<th><?php echo $pRow->ped_cliente ?></th>
                <?php if ($mobile == 0) echo "<th>" . $pRow->ped_cliente_tel . "</th>"; ?>
				<th>
					<?php
						echo $msg;
					?>
				</th>
				<th><?php echo $status ?></th>
			  </tr>
			<tbody id="itens<?php echo $x ?>" style="font-size:12; display:none; color: <?php echo $cor_chamado ?>;">
			  <!--   Itens    style="font-size: 12; color: <?php //echo $cor_chamado ?>; background: #DBDBDB;" -->
			  
	<?php 
		//Itens
		$iSelect =  "SELECT *
				FROM pedido_itens
				WHERE pi_ped_id = ". $pRow->ped_id;
		if($iQuery = mysqli_query($connect_new, $iSelect) ){
			
			while ($iRow = mysqli_fetch_object($iQuery) ){
					$desc = $iRow->pi_pr_desc;
					$quant = $iRow->pi_pr_quant;
					$valor = $iRow->pi_pr_valor;
					$total = $iRow->pi_pr_total;
		?>			
			  <tr>
				<th></th>
				<?php if ($mobile == 0) echo "<th></th>" ?>
				<th><?php echo "<u>* " . $desc . "</u>"?></th>
				<th><?php echo "<u> Qt: " . $quant  . "</u>" ?></th>
				<th><?php echo "<u> Total: R$ " . $total  . "</u>" ?></th>
				<?php if ($mobile == 0) echo "<th></th>" ?>
				<th></th>
			  </tr>
	<?php
			} //Fecha If 
		} //de Itens
	?>
		</tbody>
	</tbody>
	<?php
	}
    ?>            
            
          </table>
            </div>
        </div>

<?php
	include "footer.php";
?>

</html>