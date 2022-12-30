<?php
    //include "valida_user.inc";
	include "config.php";
	date_default_timezone_set('America/Sao_Paulo');
    $date = date("d/m/y");
    $hora = date("H:i");
	
    @session_start(); // Inicializa a sessão
	$connect_new = mysqli_connect($Host, $Usuario, $Senha, $Base);
    
    if (!$connect_new) {
        echo mysqli_error();
     //   exit();
    }
    //mysqli_select_db($Base);

    $user = $_POST["username"];
	$pwd  = md5(md5($_POST["senha"]));
//	$pwd  = $_POST["senha"];
	
    $sQuery = "select cod_usuario, nom_usuario, login, pwd_usuario, nivel
               from   usuarios
               where  login = '" . $user . "'";
    $oUser = mysqli_query($connect_new, $sQuery)
             or die("Query invalida: " . mysqli_error());             
    $row = mysqli_fetch_object($oUser);
	
    if ($num_rows = mysqli_num_rows($oUser) == 1) {
        if ($row->pwd_usuario == $pwd) {
         //   if ($row->nivel == $Nivel) {
               $_SESSION["log_usuario"] = $user;
               $_SESSION["pwd_usuario"] = $pwd;
			   $_SESSION["nivel_usuario"] = $row->nivel;
			   $_SESSION["nom_usuario"] = $row->nom_usuario;
               $_SESSION["cod_usuario"] = $row->cod_usuario;
///////////////////////grava o acesso ao sistema na tabela acesso.
               $sQuery1 = "insert into acesso (cod_user, nome_user, data, hora)
                 values ('" . $row->cod_usuario . "',
                         '" . $user . "',
                         '" . $date . "',
                         '" . $hora  . "')";
               mysqli_query($connect_new, $sQuery1);
            
			/*
			if ($row->nivel == $Niveladm) {					
			   echo "<script>window.location='chamado_lista.php'</script>";
            } elseif ($row->nivel == $Niveluser) {
               echo "<script>window.location='index_c.php'</script>";  
             } else {
			 echo "<script>window.location='index_t.php'</script>";
				}
			*/
				echo "<script>window.location='pedido_lista.php'</script>";
        } else {
            ?>
                <script language="JavaScript">
                <!--
                alert("Senha incorreta!");
                window.location = 'index.php';
                //-->
                </script>
            <?php
        }
    } else {
        ?>
            <script language="JavaScript">
            <!--
            alert("Usuário não encontrado!");
            window.location = 'index.php';
            //-->
            </script>
        <?php
    }
?>
