<?php
	$conexao = new pdo('sqlite:bancodedados.data');//realiza conexão com o banco
	$insert = "insert into paciente values (null, '".$_REQUEST['documento']."', '".$_REQUEST['nome']."', '".$_REQUEST['sexo']."', '".$_REQUEST['nascimento']."', '".$_REQUEST['email']."', '".$_REQUEST['fone']."', '".$_REQUEST['moradia']."', '', datetime('now') );";
	$resultado1 = $conexao->exec($insert);
	$pid = "select max(id) pid from paciente;";
	$pid = $conexao->query($pid)->fetchAll();
	$pid = $pid[0]['pid'];
	$insert = "insert into triagem values (null, '".$pid."', null, null, null, null, null, null, null);";
	$resultado2 = $conexao->exec($insert);
	unset($conexao);

	$doc = $_REQUEST['documento'];//PEGO UM DOCUMENTO VINDO DA WEB E ADICIONA A VARIÁVEL DOC
	$obj = [ 'doc' => $doc ];
	$txt = json_encode( $obj );//CODIFICO O OBJETO
	$curl = curl_init('http://localhost:8081/verifica.php');//  CHAMADA CURL
	curl_setopt( $curl, CURLOPT_POSTFIELDS, $txt );
	curl_setopt( $curl, CURLOPT_HTTPHEADER, [ 'Content-type:application/json' ] );
	curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
	$txt = curl_exec( $curl );
	$obj = json_decode( $txt, true );

	if ( $obj['procurado'] == true ) {// VERIFICAÇÃO SE O DOCUMENTO INFORMADO É DE ALGUÉM PROCURADO
		print '<p>Esta pessoa é procurada pelas autoridades.</p>';
		print '<style> body { background-color: red; } </style>';
	}

	if ( $resultado1 > 0 and $resultado2 > 0 ) {	
		print 'Inserido com sucesso.';
		print '<script>window.setTimeout(function(){window.location=\'/paciente_cadastro.php\';}, 2000);</script>';
	} else {
		print 'Erro na inserção.';
	}
?>
