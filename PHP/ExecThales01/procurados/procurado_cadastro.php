<html>
    <head>
        <meta charset="utf-8" />
    </head>
    <body>
        <h1>Cadastro de Procurados</h1>
        <form>
            <label>
                CPF <input type="text" name="cpf" />
            </label>
            <label>
                Nome <input type="text" name="nome" />
            </label>
            <label>
                <button type="submit" 
                        formaction="procurado_insert.php" 
                        formmethod="post">Cadastrar</button>
            </label>
        </form>
    </body>
</html>