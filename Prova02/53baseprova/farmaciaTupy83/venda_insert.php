<?php
//espanha
$conexao = new pdo ('sqlite:banco.sqlite');
$obj = [ 'desconto' => $obj ];
$txt = json_encode($obj);
$curl = curl_init('http://localhost:8081/servico_publica.php');
curl_setopt($curl, CURLSETOPT_POSTFIELDS,$txt);
curl_setopt($curl, CURLSETOPT_HTTPHEADER, ['Content-type:application/json']);
curl_setopt($curl, CURLSETOPT_RETURNTRANSFER, true);
$txt = curl_exec($curl);
$obj = json_decode($txt, true);
if($obj['desconto'] == true){
	$desconto = 0.8;
	$valor = "( select valor from produto where id = '" . $_REQUEST['produto'] . "')";//VALOR  NO BD
	$valorSD = $conexao->query($valor);
	$valorFinal = $valorSD * $desconto;
	$sql = " insert into venda values (null, '" . $_REQUEST['produto'] . "', '" . $_REQUEST['cliente'] . "', datetime('now'), ( select '$valorFinal'  from produto where id = '" . $_REQUEST['produto'] . "') ); ";
	$resultado = $conexao->exec($sql);
}
//osorio
$obj = [ 'desconto' => $obj ];
$txt = json_encode($obj);
$curl = curl_init('localhost:8082/servico_publica.php');
curl_setopt($curl, CURLSETOPT_POSTFIELDS,$txt);
curl_setopt($curl, CURLSETOPT_HTTPHEADER, ['Content-type:application/json']);
curl_setopt($curl, CURLSETOPT_RETURNTRANSFER, true);
$txt = curl_exec($curl);
$obj = json_decode($txt, true);

if($obj['desconto'] == true){
	$desconto = 0.8;
	$valor = "(select valor from produto where id = '" . $_REQUEST['produto'] . "')";//VALOR  NO BD
	$valorSD = $conexao->query($valor);
	$valorFinal = $valorSD * $desconto;
	$sql = " insert into venda values (null, '" . $_REQUEST['produto'] . "', '" . $_REQUEST['cliente'] . "', datetime('now'), ( select '$valorFinal'  from produto where id = '" . $_REQUEST['produto'] . "') ); ";
	$resultado = $conexao->exec($sql);
}

	$sql = " insert into venda values (null, '" . $_REQUEST['produto'] . "', '" . $_REQUEST['cliente'] . "', datetime('now'), ( select valor from produto where id = '" . $_REQUEST['produto'] . "') ); ";
	$conexao = new pdo ('sqlite:banco.sqlite');
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$resultado = $conexao->exec($sql);
	unset($conexao);
	if ( $resultado ) {
?>
		<p>Inserido com sucesso.</p>
		<script> setTimeout( function() { window.location.assign('venda_listar.php'); }, 2000); </script>
<?php
	} else {
?>
		<p>Erro ao inserir.</p>
		<script> setTimeout( function() { window.history.back(); }, 2000); </script>
<?php
	}