<?php
    // Obtém o conteúdo da entrada bruta do corpo da requisição.
    $txt = file_get_contents('php://input');
    
    // Decodifica o JSON da entrada para um array associativo.
    $obj = json_decode($txt, true);
    
    // Extrai os valores 'cpf', 'nome' e 'id' do array decodificado.
    $cpf = $obj['cpf'];
    $nome = $obj['nome'];
    $id = $obj['id'];
    
    // Consulta SQL para buscar o id do cliente pelo CPF.
    $select = "SELECT id FROM cliente WHERE cpf = '".$cpf."' ;";

    // Cria uma nova conexão PDO com um banco de dados SQLite.
    $conexao = new PDO('sqlite:database');
     
    // Executa a consulta e obtém todos os resultados em um array associativo.
    $resultado = $conexao->query($select)->fetchAll(PDO::FETCH_ASSOC);

    // Verifica se o cliente já existe pelo CPF.
    if ($resultado[0]['id'] > 0) {
        // Se existir, obtém o id do cliente.
        $idCliente = $resultado[0]['id'];
    } else {
        // Se não existir, insere um novo cliente na tabela 'cliente'.
        $sql = "INSERT INTO cliente VALUES (NULL, '".$cpf."', '".$nome."') RETURNING id;";
        
        // Executa a inserção e obtém o id do novo cliente inserido.
        $result = $conexao->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        $idCliente = $result[0]['id'];
    }

    // Consulta SQL para inserir uma nova compra de voo na tabela 'passageiro'.
    $insert = "INSERT INTO passageiro VALUES (NULL, '".$id."', '".$idCliente."') RETURNING id;";
    
    // Executa a inserção e obtém o id do novo passageiro inserido.
    $result = $conexao->query($insert)->fetchAll(PDO::FETCH_ASSOC);
    $idPassageiro = $result[0]['id'];
    
    // Verifica se a inserção do passageiro foi bem-sucedida.
    if ($idPassageiro > 0) {
        // Se bem-sucedida, cria um array de resultado com status de sucesso e o id do passageiro.
        $resultado = ["status" => "sucesso", "passagem" => $idPassageiro];
    } else {
        // Se falhar, cria um array de resultado com status de erro.
        $resultado = ["status" => "erro"];
    }
    
    // Converte o array de resultado para JSON.
    $txt = json_encode($resultado);
    
    // Imprime o JSON resultante.
    print $txt;
?>
