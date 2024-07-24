<?php
    $txt = file_get_contents('php://input');
    $obj = json_decode($txt,true);
    $data = $obj['data'];
    

    $select = "select vvoo.id as id,vvoo.voo as voo,vvoo.aviao as aviao,vvoo.origem as origem,vvoo.destino as destino,vvoo.datahora as datahora,voo.preco as preco  
    from vvoo 
    inner join voo on voo.id = vvoo.id
    where vvoo.datahora =  '".$data."' 
    order by voo.preco desc";

	$conexao = new pdo ('sqlite:database');
	 
    $resultado = $conexao->query($select)->fetchAll(2);
    $txt = json_encode( $resultado );

   
    print $txt;
?>
