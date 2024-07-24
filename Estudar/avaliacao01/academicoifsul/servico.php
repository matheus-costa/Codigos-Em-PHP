<?php
    // Obtém o conteúdo da entrada bruta do corpo da requisição.
    $txt = file_get_contents('php://input');
    
    // Decodifica o JSON da entrada para um array associativo.
    $obj = json_decode($txt, true);
    
    // Extrai o valor 'cpf' do array decodificado.
    $cpf = $obj['cpf'];
    
    // Consulta SQL para selecionar informações de matrículas a partir da tabela 'matricula',
    // unindo com as tabelas 'aluno', 'disciplina' e 'professor' pelos respectivos ids,
    // e filtrando pelo CPF do aluno.
    $select = "SELECT  
    a.nome AS anome, 
    d.nome AS dnome,
    p.nome AS pnome, 
    m.conceito  
    FROM matricula m 
    JOIN aluno a ON a.id = m.aluno 
    JOIN disciplina d ON d.id = m.disciplina 
    JOIN professor p ON p.id = d.professor 
    WHERE a.cpf = '".$cpf."' 
    ORDER BY d.nome";

    // Cria uma nova conexão PDO com um banco de dados SQLite.
    $conexao = new PDO('sqlite:banco.sqlite');
     
    // Executa a consulta e obtém todos os resultados em um array associativo.
    $resultado = $conexao->query($select)->fetchAll(PDO::FETCH_ASSOC);
    
    // Converte o array de resultados para JSON.
    $txt = json_encode($resultado);

    // Imprime o JSON resultante.
    print $txt;
?>
