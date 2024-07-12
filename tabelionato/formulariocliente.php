<html>
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="tabelionato.css" />
    </head>
    <body>
        <p>
            <a href="listacliente.php">Cliente</a>
        </p>
        <h2>Cadastro de Cliente</h2>
        <form>
            <p><input type="text" autocomplete="off" name="cpf" placeholder="CPF" /></p>
            <p><input type="text" autocomplete="off" name="nome" placeholder="Nome" /></p>
            <p><button formaction="inserecliente.php" formmethod="post" formenctype="multipart/form-data">Cadastrar</button></p>
        </form>
    </body>
</html>