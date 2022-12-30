<?php
$mysqli = new mysqli('localhost', 'root', 'root' , 'pedidos2');
$text = $mysqli->real_escape_string($_GET['term']);

$query = "SELECT pr_desc FROM produto WHERE pr_desc LIKE '%$text%' ORDER BY pr_desc ASC";
$result = $mysqli->query($query);
$json = '[';
$first = true;
while($row = $result->fetch_assoc())
{
    if (!$first) { $json .=  ','; } else { $first = false; }
    $json .= '{"value":"'.$row['pr_desc'].'"}';
}
$json .= ']';
echo $json;
?>