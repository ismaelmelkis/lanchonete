<?
mysql_connect('host','user','senha');
mysql_select_db('banco_de_dados');

$rate = explode('#',$_POST['rating']);
$r = $rate[1];

$SQL = " UPDATE registro 
			SET votos = votos + 1, 
				pontos = pontos + ".$r." 
		  WHERE id = ".$_POST['id'];
		  
mysql_query($SQL);
?>