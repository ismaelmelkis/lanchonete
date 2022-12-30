
<html>
    
<?php
	ini_set('default_charset', 'UTF-8');
	include "valida_user.inc";
	include "header.php";
	include "config.php";
	date_default_timezone_set('America/Sao_Paulo');
	$datatime = date('Y-m-d H:i');

?>
<script language="JavaScript">
	function pedido(tipo){
        window.location = 'pedido_novo.php?tipo='+tipo;
    }
	function pedido_fixo(tipo){
        window.location = 'pedido_fixo.php?tipo='+tipo;
    }
	
	function voltar(){
        window.location = 'window.history.back()';
    }
</script>

      <div class="jumbotron" align="center">
        <b><h3>Escolha o Tipo de Produto <br/> que ira ser feito o Pedido:</h3></b><br/><br/>
	<?php
		if(isset($_GET["fixo"])){
	?>
        <button type="button" onclick="pedido_fixo('Paes')" class="btn btn-lg btn-primary">Paes</button> &nbsp;&nbsp;&nbsp;
        <button type="button" onclick="pedido_fixo('Salgados')"class="btn btn-lg btn-info">Salgados</button>
    <?php
		}else{
	?> 
		<button type="button" onclick="pedido('Paes')" class="btn btn-lg btn-primary">Paes</button> &nbsp;&nbsp;&nbsp;
        <button type="button" onclick="pedido('Salgados')"class="btn btn-lg btn-info">Salgados</button>
	<?php
		}
	?>   
	  </div>

<?php
	include "footer.php";
?>

</html>