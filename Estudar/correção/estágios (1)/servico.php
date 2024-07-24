<?php
    // Obtém o conteúdo da entrada bruta do corpo da requisição.
    $txt = file_get_contents('php://input');
    
    // Decodifica o JSON da entrada para um array associativo.
    $obj = json_decode($txt, true);
    
    // Extrai o valor 'cpf' do array decodificado.
    $cpf = $obj['cpf'];
    
    // Consulta SQL para selecionar informações da empresa a partir das tabelas 'estudante', 'aluno', 'estagio' e 'empresa',
    // unindo pelos respectivos ids e filtrando pelo CPF do estudante.
    $sql = "
        SELECT empresa.nome, empresa.cnpj
        FROM estudante
        JOIN aluno ON estudante.id = aluno.estudante
        JOIN estagio ON aluno.id = estagio.aluno
        JOIN empresa ON estagio.empresa = empresa.id
        WHERE estudante.cpf = '$cpf';
    ";
    
    // Cria uma nova conexão PDO com um banco de dados SQLite.
    $conexao = new PDO('sqlite:database');
    
    // Executa a consulta e obtém todos os resultados em um array associativo.
    $obj = $conexao->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    
    // Converte o array de resultados para JSON.
    $txt = json_encode($obj);
    
    // Imprime o JSON resultante.
    print $txt;
?>
