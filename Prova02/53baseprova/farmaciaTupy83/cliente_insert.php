<?php
	$sql = " insert into cliente values (null, '" . $_REQUEST['cpf'] . "', '" . $_REQUEST['nome'] . "' ); ";
	$conexao = new pdo ('sqlite:banco.sqlite');
	$resultado = $conexao->exec($sql);
	unset($conexao);
	if ( $resultado ) {
?>
		<p>Inserido com sucesso.</p>
		<script> setTimeout( function() { window.location.assign('cliente_listar.php'); }, 2000); </script>
<?php
	} else {
?>
		<p>Erro ao inserir.</p>
		<script> setTimeout( function() { window.history.back(); }, 2000); </script>
<?php
	}
