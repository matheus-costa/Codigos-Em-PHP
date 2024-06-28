<html>

<head>
    <meta charset="utf-8" />
</head>

<body>
    <h1>Upload e Armazenamento de Arquivos no repositorio</h1>
    <form method="post" action="servico.php" enctype="multipart/form-data">
        <input type="text" name="descricao" placeholder="Descreva o arquivo." />
        <input type="file" name="arquivo" />
        <input type="submit" value="Enviar" />
    </form>
</body>

</html>