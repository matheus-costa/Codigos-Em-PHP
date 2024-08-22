<?php
    $conexao = new pdo('sqlite:banco');
    $consulta = "select cpf, nome from pessoa; ";
    $resultado = $conexao->query($consulta)->fetchAll();
?>
<table border="1">
    <tr>
        <td>CPF</td>
        <td>Nome</td>
    </tr>
<?php foreach ( $resultado as $tupla ) { ?>
    <tr>
        <td>    <?php print ($tupla['cpf']); ?>     </td>
        <td>    <?php print ($tupla['nome']); ?>    </td>
        <td> <a href="remover.php?cpf=<?php print ($tupla['cpf']); ?>">X</a> </td>
    </tr>
<?php } ?>
</table>
<a href="formulario.php">Inserir</a>