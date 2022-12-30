
<html>

<?php
	include "header.php";
	include "config.php";
	//include "include/change_color.php";  // o script do lado é responsável pela troca das cores na tabela de listagem.
	date_default_timezone_set('America/Sao_Paulo');
	
?>
<script language="JavaScript">

	function excluir(id){
        window.location = 'tipochamado_save.php?op=excluir&id='+id;
    }

</script>
   
   <div class="page-header">
        <h2>A WM sistemas, Agradece pela sua prefer&ecirc;ncia em utilizar nossos sistemas.</h2>
      </div>
      <div class="alert alert-warning" role="alert">
	  <h3>
        <strong>Aten&ccedil;&atilde;o!</strong> <br/><br/>
												Constatamos que ainda não foi adiquirido a Licen&ccedil;a <br/>
												de Utilliza&ccedil;&atilde;o Total do SiPED.<br/>
												N&atilde;o perca esta Chance, Adiquire j&aacute;<br/>
												e obtenha o melhor serviço de gest&atilde;o de Pedidos para o seu Negócio! <br/><br/>
												Entre em contato com o nosso setor de vendas: <br/>
												<img src="img/zap.png" width="25" height="25">
												(38) 9 8425-1921, 
												<img src="img/gmail.jpg" width="25" height="25">
												ismaelmelkis@gmail.com
      </h3>
	  </div>





<?php
	include "footer.php";
?>

</html>