<?php
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
