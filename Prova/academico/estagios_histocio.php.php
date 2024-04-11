<?php
    $txt = file_get_contents('php://input');
    // captura o conteúdo da requisição.
    $obj = json_decode( $txt, true );
    // tenta decodificar o conteúdo da requisição como um objeto da linguagem PHP.
    $cpf = $obj['cpf'];
    $cnpj = $obj['cnpj'];
    $estnome = $obj['esnome'];
    $empnome = $obj['empnome'];
    $sql = "
    select es.nome , es.cpf, emp.nome , emp.cnpj  from estudante es
    join aluno a on a.estudante = es.id
    join estagio esta  on esta.empresa = emp.id
    where es.cpf = '$cpf' and emp.cnpj = '$cnpj'
    and emp.nome = '$empnome ' and es.nome = '$estnome'
    order by emp.nome desc; 
    ";
    $conexao = new pdo('sqlite:banco.sqlite');
    //conecta no banco de dados.
    $resultado = $conexao->query($sql)->fetchAll(2);
    //é executada uma consulta no banco, que retorna valores e esses valores são colados no array
    $txt = json_encode( $obj );
    // código ás informações
    print $txt;  // "envio" o conteúdo em TXT para que ele possa ser reutilzado
    ?>

<html>
	<head>
		<meta charset="utf-8" />
	</head>
	<body>
		<?php include 'menu.php'; ?>
		<h1>lista de Estágios</h1>
        <table border="1">
<?php
$consulta = " select es.nome nomeestudante , es.cpf cpfestudante, 
              emp.nome nomemepresa , emp.cnpj cnpjempresa  from estudante es";

	$conexao = new pdo ('sqlite:banco.sqlite');
	$resultado = $conexao->query($consulta)->fetchAll();
	unset($conexao);
	foreach ( $resultado as $tupla ) {
?>
			<tr>
				<td><?php print $tupla['nomeestudante']; ?></td>
				<td><?php print $tupla['cpfestudante']; ?></td>
				<td><?php print $tupla['nomemepresa']; ?></td>
                <td><?php print $tupla['cnpjempresa']; ?></td>
			</tr>
<?php
	}
?>
		</table>

	</body>
</html>