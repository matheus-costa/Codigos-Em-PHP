<?php 
    // Obtém o valor 'cpf' da requisição.
    $cpf = $_REQUEST['cpf'];
    
    // Cria um array associativo com o valor 'cpf'.
    $obj = [ 'cpf' => $cpf ];
    
    // Converte o array para JSON.
    $txt = json_encode($obj);

    // Inicializa uma nova sessão cURL para a URL do serviço.
    $curl = curl_init('http://localhost:8081/servico.php');
    
    // Define as opções cURL para enviar uma requisição POST com o JSON no corpo da requisição.
    curl_setopt($curl, CURLOPT_POSTFIELDS, $txt);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [ 'Content-type:application/json' ]);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    
    // Executa a requisição cURL e obtém a resposta.
    $txt = curl_exec($curl);
    
    // Decodifica a resposta JSON para um array associativo.
    $obj = json_decode($txt, true);
    
    // Fecha a sessão cURL.
    curl_close($curl);
?>
<html>
    <head>
        <meta charset="utf-8" />
    </head>
    <body>
        <?php include 'menu.php'; ?>
        <h1>Lista de Estágios</h1>
        <table border="1">
<?php
    // Itera sobre o array de resposta e cria uma linha na tabela para cada item.
    foreach ($obj as $o) {
?>
            <tr>
                <td><?php print $o['nome']; ?></td>
                <td><?php print $o['cnpj']; ?></td>
            </tr>
<?php
    }
?>
        </table>
    </body>
</html>
