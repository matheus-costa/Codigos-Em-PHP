<?php
    // Obtém o conteúdo da entrada bruta do corpo da requisição.
    $txt = file_get_contents('php://input');
    
    // Decodifica o JSON da entrada para um array associativo.
    $obj = json_decode($txt, true);
    
    // Extrai o valor 'data' do array decodificado.
    $data = $obj['data'];
    
    // Consulta SQL para selecionar informações de voos a partir da tabela 'vvoo',
    // unindo com a tabela 'voo' pelo id e filtrando pela data/hora.
    $select = "SELECT vvoo.id as id, vvoo.voo as voo, vvoo.aviao as aviao, vvoo.origem as origem, vvoo.destino as destino, vvoo.datahora as datahora, voo.preco as preco  
    FROM vvoo 
    INNER JOIN voo ON voo.id = vvoo.id
    WHERE vvoo.datahora = '".$data."' 
    ORDER BY voo.preco DESC";

    // Cria uma nova conexão PDO com um banco de dados SQLite.
    $conexao = new PDO('sqlite:database');
     
    // Executa a consulta e obtém todos os resultados em um array associativo.
    $resultado = $conexao->query($select)->fetchAll(PDO::FETCH_ASSOC);
    
    // Converte o array de resultados para JSON.
    $txt = json_encode($resultado);

    // Imprime o JSON resultante.
    print $txt;
?>
