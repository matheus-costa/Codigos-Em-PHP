<?php
	$insert = "insert into matricula values (null, '".$_REQUEST['aluno']."', '".$_REQUEST['disciplina']."', 'I')";
	$conexao = new pdo ('sqlite:banco.sqlite');
	$resultado = $conexao->exec($insert);
	unset($conexao);
	if ( $resultado ) {
		print "<script>alert('Inserido com sucesso.');</script>";
		header('Location: matricula_lista.php');
		exit();
	} else {
		print "<script>alert('Erro.');</script>";
		print "<script>history.back();</script>";
		exit();
	}
?>