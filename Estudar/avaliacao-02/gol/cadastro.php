<?php
	if ( !isset($_REQUEST['entidade']) ) {
		header('Location: /erro.php');
		exit;
	}
	$conexao = new pdo ('sqlite:database');
	/*$sql = "select name from sqlite_master; ";
	$resultado = $conexao->query($sql)->fetchAll(2);
	$tabelas = [];
	foreach ( $resultado as $tupla ) {
		$tabelas[] = $tupla['name'];
	}*/
	$tabelas = [ 'destino', 'aviao', 'cliente' ];
	$visualizacoes = [ 'voo' => 'vvoo', 'origem' => 'destino' ];
	$sql = " select * from ".$_REQUEST['entidade']." limit 1; ";
	$meta = $conexao->query( $sql );
	$c = $meta->columnCount();
?>
<html>
	<head>
		<meta charset="utf-8" />
		<style>
			form, div { display: inline-block; }
			button { float: right; }
		</style>
	</head>
	<body>
		<p>
			<a href="lista.php?entidade=aviao&rotulo=Avião">Avião</a>
			<a href="lista.php?entidade=destino&rotulo=Destino">Destino</a>
			<a href="lista.php?entidade=voo&rotulo=Voo&view">Voo</a>
			<a href="lista.php?entidade=cliente&rotulo=Cliente">Cliente</a>
			<a href="lista.php?entidade=passageiro&rotulo=Passageiro&view">Passageiro</a>
		</p>
		<h1>Gol</h1>
		<h2>Cadastro de <?= $_REQUEST['rotulo'] ?></h2>
		<form>
<?php 
	for ( $i = 0 ; $i < $c ; $i++ ) { 
		$column = $meta->getColumnMeta($i);
		if ( in_array ( $meta->getColumnMeta($i)['name'], ['id'] ) ) {
			continue;
		}
		if ( in_array ( $meta->getColumnMeta($i)['name'], array_merge($tabelas, array_keys($visualizacoes)) ) ) {
			if ( in_array ( $meta->getColumnMeta($i)['name'], $tabelas ) ) {
				$select = " select * from ".$meta->getColumnMeta($i)['name']."; ";
			} else {
				$select = " select * from ".$visualizacoes[$meta->getColumnMeta($i)['name']]."; ";
			}
			$opcoes = $conexao->query($select)->fetchAll(2);
?>
			<p>
				<select name= "<?= $column['name'] ?>">
					<option hidden><?= $column['name'] ?></option>
<?php
				foreach ( $opcoes as $opcao ) {
?>
					<option value="<?= $opcao['id'] ?>"><?= join(' ', $opcao) ?></option>
<?php
				}
?>
				</select>
			</p>
<?php
		} else {
?>
			<p><input type="<?= ($column['native_type'] == 'string') ? 'text' : 'number' ?>" name="<?= $column['name'] ?>" autocomplete="off" placeholder="<?= $column['name'] ?>" /></p>
<?php 
		}
	} 
?>
			<p><button type="submit" formmethod="post" formaction="insert.php?entidade=<?= $_REQUEST['entidade'] ?>&rotulo=<?= $_REQUEST['rotulo'] ?><?= (isset($_REQUEST['view']) ? '&view' : '') ?>">OK</button></p>
		</form>
	</body>
</html>