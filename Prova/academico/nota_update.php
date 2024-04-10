<?php
	$update = "update matricula set conceito = '".$_REQUEST['nota']."' where id = '".$_REQUEST['id']."' ";
	$conexao = new pdo ('sqlite:banco.sqlite');
	$resultado = $conexao->exec($update);
	unset($conexao);
	if ( $resultado ) {
		header('Location: nota_lista.php');
		exit();
	} else {
		print "<script>alert('Erro.');</script>";
		print "<script>history.back();</script>";
		exit();
	}
?>