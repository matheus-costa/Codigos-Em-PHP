<?php
	$txt = file_get_contents('php://input'); 
	$obj = json_decode( $txt, true ); 
	$anvisa = $obj ['anvisa']; 
	$cpf = $obj['cpf']; 
    $conexao = new pdo ('sqlite:banco.sqlite');
	
    $sql = "
        select p.anvisa from venda v 
        join produto p on p.id = produto 
        join cliente c on c.id = cliente 
        where c.cpf = '".$cpf."' 
        order by v.datahora desc limit 3";
    
    $resultado = $conexao->query($sql)->fetchAll();
    $obj = false;

	foreach($resultado as $tupla){
	 	if($tupla['anvisa'] == $anvisa){
			$obj = true;
			break;
		}
	}

	$txt = json_encode($obj);
	print $txt;