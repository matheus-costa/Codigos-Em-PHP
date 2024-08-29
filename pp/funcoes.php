<?php

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
        if ( $v >= 10 ) {
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
        if ( $v >= 10 ) {
            $v = 0;
        } 
        if ( $v != $documento[10] ) {
            return false;
        }
        return true;
    }