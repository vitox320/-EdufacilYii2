<?php
/**
 * Created by PhpStorm.
 * User: eudesjf
 * Date: 27/08/2018
 * Time: 11:45
 */

namespace app\components\util;


class UtilUpload {


    public static $errosUpload = [
        0 => 'Não houve erro',
        1 => 'O arquivo no upload é maior do que o limite do PHP',
        2 => 'O arquivo excede o limite definido em MAX_FILE_SIZE no formulário HTML',
        3 => 'O upload do arquivo foi feito parcialmente',
        4 => 'Nenhum arquivo foi enviado',
        6 => 'Pasta temporária ausente',
        7 => 'Falha em escrever o arquivo em disco',
        8 => 'Uma extensão do PHP interrompeu o upload do arquivo. O PHP não fornece uma maneira de determinar qual extensão causou a interrupção'
    ];


}