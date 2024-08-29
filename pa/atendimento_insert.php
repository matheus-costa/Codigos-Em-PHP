<?php
 $cpf = $_REQUEST['cpf'];

 $obj = ['documento' => $cpf];
 $txt = json_encode($obj);

 $curl = curl_init("http://localhost:8082/pp.php");//CONSOME SERVIÇO
 curl_setopt($curl, CURLOPT_POSTFIELDS,$txt);//o que vai ser enviado no corpo da requisição
 curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-type:application/json']);//digo qual o tipo de 
//conteúdo neste caso JSON
 curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);//neste caso digo que vou usar o que foi recebido 
//como uma variável
 $txt = curl_exec($curl);
 $obj = json_decode($txt, true);

 if($obj['status'] == false){
	   print 'Não é um CPF válido';
	   exit;
  }



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
?>