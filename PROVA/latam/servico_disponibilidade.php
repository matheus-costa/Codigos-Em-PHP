<?php
    $json = file_get_contents('php://input');
	$obj = json_decode( $json, true );

    $origem = $obj['origem'];
    $destino = $obj['destino'];
    $datahora1 = $obj['datahora1'];
    $datahora2 = $obj['datahora2'];
    $companhia = 'latam';

    $conexao = new pdo('sqlite:database');

    $sql = "select *, '".$companhia."' as companhia from vvoo where destino = '".$destino."' and origem = '".$origem."' and datahora between '".$datahora1."' and '".$datahora2."'";

    $resultado = $conexao->query($sql)->fetchAll(2);
	unset($conexao);

    $json = json_encode($resultado);

	header("content-type: application/json");
	print $json;
?>