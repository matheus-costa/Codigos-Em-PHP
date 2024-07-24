<?php
	$insert = "insert into aluno values (null, '".$_REQUEST['nome']."', '".$_REQUEST['cpf']."')";
	$conexao = new pdo ('sqlite:banco.sqlite');
	$resultado = $conexao->exec($insert);
	$idAluno = $conexao->lastInsertId();
	unset($conexao);
	echo($resultado);
	 
	if ( $resultado ) {
	$curl = curl_init('http://localhost:8082/servico.php');
	
	$obj = ['cpf' => $_REQUEST['cpf']];

	$txt = json_encode($obj);	
	curl_setopt($curl,CURLOPT_POSTFIELDS,$txt);
	curl_setopt($curl,CURLOPT_HTTPHEADER, ['Content-type:application/json']);
	curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
	 
	$txt = curl_exec($curl);
	$obj = json_decode($txt, true);

	if( count($obj)>0){
		foreach ($obj as $tupla){
			//error_log(print_r($tupla['anome'] , TRUE));
			// todo: laço para inserir diciplina,nota e professor

			//insert professor 
			$insert = "insert into professor values (null, '".$tupla['pnome']." TRANSF EXT.')";
			$conexao = new pdo ('sqlite:banco.sqlite');
			$resultado = $conexao->exec($insert);

			$idProfessor = $conexao->lastInsertId();

			//insert disciplina
			$insert = "insert into disciplina values (null, '".$tupla['dnome']." TRANSF EXT.', '".$idProfessor."')";
			$conexao = new pdo ('sqlite:banco.sqlite');
			$resultado = $conexao->exec($insert);

			$idDisciplina = $conexao->lastInsertId();

			//insert matricula
			$insert = "insert into matricula values (null, '".$idAluno."', '".$idDisciplina."','".$tupla['conceito']."')";
			$conexao = new pdo ('sqlite:banco.sqlite');
			$resultado = $conexao->exec($insert);
			unset($conexao);
	
		}
		 
		print "<script> alert('Transferido com sucesso.'); </script>";
		header('Location: aluno_lista.php');
		exit();
	}else{
		print "<script>alert('Inserido com sucesso.');</script>";
		header('Location: aluno_lista.php');
		exit();
	}
	} else {
		print "<script>alert('Erro.');</script>";
		print "<script>history.back();</script>";
		exit();
	}
?>
