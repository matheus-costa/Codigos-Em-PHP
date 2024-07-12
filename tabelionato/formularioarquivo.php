<html>
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="tabelionato.css" />
    </head>
    <body>
        <p>
            <a href="listacliente.php">Cliente</a>
        </p>
        <h2>Upload de Arquivo</h2>
        <form>
            <p><input type="file" autocomplete="off" name="arquivo" /></p>
            <p><button formaction="inserearquivo.php?cliente=<?php print $_REQUEST['cliente']; ?>" formmethod="post" formenctype="multipart/form-data">Cadastrar</button></p>
        </form>
    </body>
</html>