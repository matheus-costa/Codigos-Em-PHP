<?php
//coloca 1 índice de forma decrescente em cada digito do CPF
//vão de 9° até 1°
//multiplica o valor do índice pelo  digito do CPF, pegando o resultado e 
//armazenando em uma variável
//soma-se todo o resultado, este resultado será dividido por 11 e subtraído de 11
    function validaCPF ( $documento ) {
        if ( strlen($documento) != 11 ) {
            return false;
        }
        if ( !is_numeric( $documento ) ) {
            return false;
        }
        $soma = 0;
        for ( $i = 0 ; $i < 9 ; $i++ ) {
            $d = $documento[$i];
            $c = 10 - $i;
            $soma = $soma + $d * $c;
        }
        $resto = $soma % 11;
        $v = 11 - $resto;
        if ( $v == 10 ) {
            $v = 0;
        } 
        if ( $v != $documento[9] ) {
            return false;
        }
        $soma = 0;
        for ( $i = 0 ; $i < 10 ; $i++ ) {
            $d = $documento[$i];
            $c = 11 - $i;
            $soma = $soma + $d * $c;
        }
        $resto = $soma % 11;
        $v = 11 - $resto;
        if ( $v == 10 ) {
            $v = 0;
        } 
        if ( $v != $documento[10] ) {
            return false;
        }
        return true;
    }