<?php
	$delete = "delete from aluno where id = '".$_REQUEST['id']."' ";
	$conexao = new pdo ('sqlite:banco.sqlite');
	$resultado = $conexao->exec($delete);
	unset($conexao);
	if ( $resultado ) {
		print "<script>alert('Removido com sucesso.');</script>";
		header('Location: aluno_lista.php');
		exit();
	} else {
		print "<script>alert('Erro.');</script>";
		print "<script>history.back();</script>";
		exit();
	}
?>