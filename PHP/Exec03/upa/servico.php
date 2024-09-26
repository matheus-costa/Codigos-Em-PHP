<?php
//um serviço web que provê as quantidades de pacientes que aguardam a triagem,
$conexao = new pdo('sqlite:bancodedados.data');
$sql='select count(id) from paciente';// feito

//e as quantidades de pacientes de riscos eletivo, baixo, médio e alto
