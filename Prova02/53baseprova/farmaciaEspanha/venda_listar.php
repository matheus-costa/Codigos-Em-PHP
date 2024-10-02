<?php
$txt = file_get_contents('php://input');//ABRINDO A REQUISIÇÃO
//ESPERA-SE RECEBER UM JSON COM ÍNDICE LOCAL E UMA DESCRICAO(QUE VAI TER UM TEXTO)
$obj = json_decode($txt);//objeto válido
$cpf = $obj -> cpf;//objeto vindo de quem consome o servico
$anvisa = $obj -> anvisa;//objeto vindo de quem consome o servico
$conexao = new pdo ('sqlite:banco.sqlite');
$sql = " SELECT v.cliente vc
 	FROM Venda v
 	JOIN Cliente c
     	ON c.id = vc
 	WHERE c.cpf = '$cpf' AND (SELECT v.produto vp
   	                                             FROM Venda v
   	                                             JOIN Produto p
   	                                             ON p.id = vp
   	                                             WHERE p.anvisa = '$anvisa'
                                                 LIMIT 3);";
$resultado = $conexao->query($sql)->fetchAll();
$valorProduto = "(select valor from produto where id = '" . $_REQUEST['produto']. "');";
$resultadoValProd = $conexao->query($valorProduto)->fetchAll();

if($resultado > 0){
	$desconto = $resultadoValProd * 0.20;
}										 

$busca = '';
	if ( isset( $_REQUEST['busca'] ) ) {
		$busca = $_REQUEST['busca'];
	}
	$sql = " select v.id, p.anvisa, p.nome pnome, p.valor pvalor, c.cpf, c.nome cnome,".$desconto." from venda v join cliente c on c.id = v.cliente join produto p on p.id = v.produto where p.nome || c.nome like '%" . $busca . "%' ";
	$conexao = new pdo ('sqlite:banco.sqlite');
	$resultado = $conexao->query($sql)->fetchAll();
	unset($conexao);
?>
<html>
	<head>
		<meta charset="utf-8" />
	</head>
	<body>
<?php
		require 'menu.php';
?>
		<form id="busca">
			<p>
				<input type="text" name="busca" autocomplete="off" />
				<button type="submit" formmethod="post" formaction="venda_listar.php">Buscar</button>
			</p>
		</form>
		<table border="1">
			<tr>
				<td>#</td>
				<td>Produto</td>
				<td>Valor Produto</td>
				<td>Cliente</td>
				<td>Valor Venda</td>
				<td>Remover</td>
			</tr>
<?php
	foreach ( $resultado as $tupla ) {
?>
			<tr>
				<td><?php print $tupla['id']; ?></td>
				<td><?php print $tupla['pnome']; ?></td>
				<td><?php print $tupla['pvalor']; ?></td>
				<td><?php print $tupla['cnome']; ?></td>
				<td><?php print $tupla['vvalor']; ?></td>
				<td><a href="venda_delete.php?id=<?php print $tupla['id']; ?>"> X </a></td>
			</tr>
<?php
	}
?>
		</table>
	</body>
</html>
