<?php
	$conexao = new pdo('sqlite:bancodedados.data');
	$insert = "insert into atendimento values (null, '".$_REQUEST['triagem']."', '".$_REQUEST['diagnostico']."', '".$_REQUEST['medicamento']."', '".$_REQUEST['encaminhamento']."', datetime('now') );";
	$resultado = $conexao->exec($insert);
	unset($conexao);
	if ( $resultado > 0 ) {
		print 'Inserido com sucesso.';
		print '<script>window.setTimeout(function(){window.location=\'/atendimento_lista.php\';}, 2000);</script>';
	} else {
		print 'Erro na inserção.';
	}

	if ( stripos( $_REQUEST['encaminhamento'], 'ocorrência' ) !== false ) {
		$obj = [ 'local' => 'UPA Bagé', 'descricao' => $_REQUEST['encaminhamento'] ];
		$txt = json_encode( $obj );
		$curl = curl_init('http://localhost:8081/remoto.php');
		curl_setopt( $curl, CURLOPT_POSTFIELDS, $txt );
		curl_setopt( $curl, CURLOPT_HTTPHEADER, [ 'Content-type:application/json' ] );
		curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
		$txt = curl_exec( $curl );
		$obj = json_decode( $txt );
		if ( $obj->status == true ) {
			print 'Ocorrência comunicada com sucesso.';
		} else {
			print 'Erro ao comunicar ocorrência policial.';
		}
	}