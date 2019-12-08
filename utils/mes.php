<?php
function case_mes($mes){ 
        switch ($mes){
            case '01':
                $mes_extenso = 'Janeiro';
            break;
            case '02':
                $mes_extenso = 'Fevereiro';
            break;
            case '03':
                $mes_extenso = 'Março';
            break;
            case '04':
                $mes_extenso = 'Abril';
            break;
            case '05':
                $mes_extenso = 'Maio';
            break;
            case '06':
                $mes_extenso = 'Junho';
            break;
            case '07':
                $mes_extenso = 'Julho';
            break;
            case '8':
                $mes_extenso = 'Agosto';
            break;
            case '9':
                $mes_extenso = 'Setembro';
            break;
            case '10':
                $mes_extenso = 'Outubro';
            break;
            case '11':
                $mes_extenso = 'Novembro';
            break;
            case '12':
                $mes_extenso = 'Dezembro';
            break;
            default:
                $mes_extenso = 'erro';
            
        }
        echo $mes_extenso;
    }