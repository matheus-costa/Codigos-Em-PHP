<?php
	$insert = "insert into disciplina values (null, '".$_REQUEST['nome']."', '".$_REQUEST['professor']."')";
	$conexao = new pdo ('sqlite:banco.sqlite');
	$resultado = $conexao->exec($insert);
	unset($conexao);
	if ( $resultado ) {
		print "<script>alert('Inserido com sucesso.');</script>";
		header('Location: disciplina_lista.php');
		exit();
	} else {
		print "<script>alert('Erro.');</script>";
		print "<script>history.back();</script>";
		exit();
	}
?>