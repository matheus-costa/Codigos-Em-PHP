<html>
    <head>
        <meta charset='utf-8'/>
</head>
  <body>
    <form>
          <input type="text" name="documento" placeholder="Documento" autocomplete="off"/>
          <button formaction="index.php" formmethod="post">Validar</button>
</from>
<p>
<?php
include_once("funcoes.php");
       if(!isset($_REQUEST['documento'])){//verificando se foi enviado uma requisição com a variável do request
        $teste = validaCPF($_REQUEST['documento']);
        if($teste){
            print ($_REQUEST['documento']. "é um cpf");
        }
        else
            print ($_REQUEST['documento']. "não é um cpf");
        }
       else
?>     
</p>
</body>    
</html>