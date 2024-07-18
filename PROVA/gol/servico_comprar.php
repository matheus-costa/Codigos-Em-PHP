<?php
    $json = file_get_contents('php://input');
	$obj = json_decode( $json, true );

    $voo = $obj['voo'];
    $cpf = $obj['cpf'];
    $nome = $obj['nome'];

    $conexao = new pdo('sqlite:database');

    $sql = "select * from cliente where cpf = '".$cpf."'";
    $resultado = $conexao->query($sql)->fetchAll(2);
    if(count($resultado) == 0){
        if(!isset($obj['nome'])){
            $obj = ['status' => 'erro'];
            $json = json_encode($obj);
            print $json;
            exit;
        }
        $sql = "insert into cliente values (null, '".$cpf."', '".$nome."'); ";
        $resultado = $conexao->exec($sql);
        if($resultado == 0){
            $obj = ['status' => 'erroo'];
            $json = json_encode($obj);
			print $json;
			exit;
        }
    }
    $sql = "select * from cliente where cpf = '".$cpf."'";
    $resultado = $conexao->query($sql)->fetchAll(2);
    $cliente = $resultado['0']['id'];
    $sql = "insert into passageiro values (null, '".$voo."', '".$cliente."')";
    
    $resultado = $conexao->exec($sql);
	if ( $resultado == 0 ) {
		$obj = [ 'status' => 'errooo' ];
		$json = json_encode($array);
		print $json;
		exit;
	}

	$obj = [ 'status' => 'sucesso' ];

	unset($conexao);

    $json = json_encode($obj);

	header("content-type: application/json");
	print $json;
?>
