<?php   

   $cpf = $_REQUEST['documento'];

   $obj = ['documento' => $cpf];
   $txt = json_encode($obj);

   $curl = curl_init("http://localhost:8081/servico.php");//CONSOME SERVIÇO
   curl_setopt($curl, CURLOPT_POSTFIELDS,$txt);//o que vai ser enviado no corpo da requisição
   curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-type:application/json']);//digo qual o tipo de 
//conteúdo neste caso JSON
   curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);//neste caso digo que vou usar o que foi recebido 
//como uma variável
   $txt = curl_exec($curl);
   $obj = json_encode($txt, true);
   
    if($obj['status' == false ]){
		print 'Não é um cpf valido';
	}

	$insert = "insert into paciente values (null, '".$_REQUEST['documento']."', '".$_REQUEST['nome']."', '".$_REQUEST['sexo']."', '".$_REQUEST['nascimento']."', '".$_REQUEST['email']."', '".$_REQUEST['fone']."', '".$_REQUEST['moradia']."', '', datetime('now') );";
	$resultado1 = $conexao->exec($insert);
	$pid = "select max(id) pid from paciente;";
	$pid = $conexao->query($pid)->fetchAll();
	$pid = $pid[0]['pid'];
	$insert = "insert into triagem values (null, '".$pid."', null, null, null, null, null, null, null);";
	$resultado2 = $conexao->exec($insert);
	unset($conexao);
	if ( $resultado1 > 0 and $resultado2 > 0 ) {	
		print 'Inserido com sucesso.';
		print '<script>window.setTimeout(function(){window.location=\'/paciente_cadastro.php\';}, 2000);</script>';
	} 
	
	
