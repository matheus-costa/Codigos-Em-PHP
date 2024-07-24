<?php
	$insert = "insert into aluno values (null, '".$_REQUEST['nome']."', '".$_REQUEST['cpf']."')";
	$conexao = new pdo ('sqlite:banco.sqlite');
	$resultado = $conexao->exec($insert);
	unset($conexao);
	if ( $resultado ) {
		print "<script>alert('Inserido com sucesso.');</script>";
		header('Location: aluno_lista.php');
		exit();
	} else {
		print "<script>alert('Erro.');</script>";
		print "<script>history.back();</script>";
		exit();
	}
?>