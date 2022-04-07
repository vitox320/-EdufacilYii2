<?php
namespace  app\components\util;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\db\Exception;
use Yii;
/**
 * Description of UtilText
 *
 * @author joaoppvn
 */
class UtilText {

    const LATIN1 = "ISO-8859-1";
    const UTF_8 = "UTF-8";
    const SUBST_VAZIO = " -- ";
    const LOWER = 1;
    const UPPER = 2;
    const FIRST_UPPER = 3;
    const EACH_FIRST_UPPER = 4;

    public static function gerarCodigoAleatorio($tamanho = 8, $comMaiusculas = true, $numeros = true, $simbolos = false)
    {
        $lmin = 'abcdefghijklmnopqrstuvwxyz';
        $lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $num = '1234567890';
        $simb = '!@#$%*-';
        $retorno = '';
        $caracteres = '';
        $caracteres .= $lmin;
        if ($comMaiusculas) $caracteres .= $lmai;
        if ($numeros) $caracteres .= $num;
        if ($simbolos) $caracteres .= $simb;
        $len = strlen($caracteres);
        for ($n = 1; $n <= $tamanho; $n++) {
            $rand = mt_rand(1, $len);
            $retorno .= $caracteres[$rand-1];
        }
        return $retorno;
    }


   public static function getIconByExtension($arquivo){

       $arquivoDir = Yii::$app->basePath . "/web" . $arquivo;
       $extesion   =  strtolower(pathinfo($arquivoDir, PATHINFO_EXTENSION));

         switch($extesion){

             case 'pdf':
                $sendIcon = 'fa fa-file-pdf-o';
             break;

             case 'pdf/x':
                 $sendIcon = 'fa fa-file-pdf-o';
                 break;

             case 'doc':
                $sendIcon = 'fa fa-file-word-o';
             break;

             case 'docx':
                 $sendIcon = 'fa fa-file-word-o';
                 break;

             case 'xls':
                 $sendIcon = 'fa fa-file-excel-o';
                 break;

             case 'xlsx':
                 $sendIcon = 'fa fa-file-excel-o';
                 break;

             default:
                 $sendIcon = 'fa fa-file';
                 break;
         }

        return $sendIcon;
    }



    public static function brDecimalToSqlDecimal($brDecimal) {
        return str_replace(",", ".", str_replace(".", "", $brDecimal));
    }

    public static function mssql_escape($data) {
        if (!isset($data) or empty($data))
            return '';
        if (is_numeric($data))
            return $data;

        $non_displayables = array(
            '/%0[0-8bcef]/', // url encoded 00-08, 11, 12, 14, 15
            '/%1[0-9a-f]/', // url encoded 16-31
            '/[\x00-\x08]/', // 00-08
            '/\x0b/', // 11
            '/\x0c/', // 12
            '/[\x0e-\x1f]/'             // 14-31
        );
        foreach ($non_displayables as $regex)
            $data = preg_replace($regex, '', $data);
        $data = str_replace("'", "''", $data);
        return $data;
    }

    public static function lcfirst($str) {
        return (string) (strtolower(substr($str, 0, 1)) . substr($str, 1));
    }

    public static function upfirst($str) {
        return (string) (strtoupper(substr($str, 0, 1)) . substr($str, 1));
    }

    public static function limitarStr($minhaStr, $tamLimite, $strAnexa = "...") {
        if (strlen($minhaStr) > $tamLimite) {
            return substr($minhaStr, 0, $tamLimite) . $strAnexa;
        } else {
            return $minhaStr;
        }
    }

    public static function boolToSimNao($boolValue, $upper = false) {
        $str = $boolValue ? "Sim" : "N�o";
        if ($upper)
            $str = strtoupper($str);
        return $str;
    }

    public static function tratarStr($string, $encoding = self::UTF_8, $substituiVazio = self::SUBST_VAZIO, $modoUpper = self::FIRST_UPPER) {
        if (trim($string) == '') {
            return $substituiVazio;
        } else {
            $aux = Encoding::toLatin1($string);
            $aux = trim($aux);

            switch ($modoUpper) {
                case self::LOWER:
                    $aux = mb_strtolower($aux, $encoding);
                    break;
                case self::UPPER:
                    $aux = mb_strtoupper($aux, $encoding);
                    break;

                case self::FIRST_UPPER:
                    $aux = ucfirst($aux);
                    break;

                case self::EACH_FIRST_UPPER:
                    $aux = mb_strtolower($aux, $encoding);
                    $aux = ucwords($aux);
                    break;

                default:
                    $aux = ucfirst($aux);
                    break;
            }

            switch ($encoding) {
                case UtilText::UTF_8:
                    $aux = Encoding::toUTF8($aux);
                    break;

                case UtilText::LATIN1:
                    $aux = Encoding::toLatin1($aux);
                    break;

                default:
                    $aux = Encoding::toUTF8($aux);
                    break;
            }

            return $aux;
        }
    }

    public static function explodePrimeiros($entrada, $split, $lim = 1) {
        $aux = explode($split, $entrada);

        $saida = $aux[0];
        for ($i = 1; $i < count($aux) - $lim; $i++) {
            $saida .= $split . $aux[$i];
        }
        return $saida;
    }

    public static function explodePrimeiro($entrada, $split) {
        return current(explode($split, $entrada));
    }

    public static function explodeUltimo($entrada, $split) {
        //return substr($entrada, strrpos($entrada, $split)+1);
        $aux = explode($split, $entrada);
        $pos = count($aux);
        return $aux[$pos - 1];
    }

    public static function explodeUltimos($entrada, $split, $lim = 1) {
        $aux = explode($split, $entrada);
        $saida = "";
        for ($i = $lim; $i < count($aux); $i++) {
            $saida .= $aux[$i];
            if ($i != count($aux) - 1) {
                $saida .= $split;
            }
        }
        return $saida;
    }

    /**
     * Obt�m uma String, um limite de largura e uma inst�ncia de FPDF e retorna um array de Strings
     * todas contendo no m�ximo o limite determinado. A quantidade de linhas ser� a quantidade
     * de elementos no array.
     * @param String $str Texto para ser tratado.
     * @param float $lim Limite para a largura no FPDF
     * @param FPDF $fpdf Inst�ncia do FPDF para calcular largura das linhas.
     * @return array $linhas Array contendo as linhas resultantes da quebra.
     */
    public static function quebraStrLinhas($str, $lim, $fpdf) {
        //return $fpdf->GetStringWidth($str);
        $linhas = array();
        //hoje vou beber
        do {
            $i = 0;
            do {
                $aux = self::explodePrimeiros($str, ' ', $i);
                $i++;
            } while ($fpdf->GetStringWidth($aux) > $lim && $i < 100);
            $linhas[] = $aux;
            $pedacos = explode(' ', $str);
            $str = self::explodeUltimos($str, ' ', count($pedacos) - ($i - 1));
        } while ($fpdf->GetStringWidth($str) > $lim && $i < 100);

        if ($str != '') {
            $linhas[] = $str;
        }

        return $linhas;
    }
    
    public static function quebraStrLinhasPrint($str, $lim, $fpdf) {
        //return $fpdf->GetStringWidth($str);
        $linhas = array();
        //hoje vou beber
        do {
            $i = 0;
            do {
                $aux = self::explodePrimeiros($str, ' ', $i);
                $i++;
            } while ($fpdf->GetStringWidth($aux) > $lim && $i < 100);
            $linhas[] = $aux;
            $pedacos = explode(' ', $str);
            $str = self::explodeUltimos($str, '\n', count($pedacos) - ($i - 1));
        } while ($fpdf->GetStringWidth($str) > $lim && $i < 100);

        if ($str != '') {
            $linhas[] = $str;
        }
            foreach ($linhas as $value) {
                $string = $value.$fpdf->Ln();
            }

        
//        print_r($linhas);die();
//        echo $string;die();
        return $string;
    }

    public static function manualXssEscape($string) {
        return $html = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $string);
    }

    public static function maskFormatter($string, $tipo = "") {
        if($tipo != "placa"){
            $string = preg_replace("/[^0-9]/", "", $string);
        }
        if (!$tipo) {
            switch (strlen($string)) {
                case 10: $tipo = 'fone';
                    break;
                case 8: $tipo = 'cep';
                    break;
                case 11: $tipo = 'cpf';
                    break;
                case 14: $tipo = 'cnpj';
                    break;
            }
        }
        switch ($tipo) {
            case 'fone':
                $string = '(' . substr($string, 0, 2) . ') ' . substr($string, 2, 4) .
                        '-' . substr($string, 6);
                break;
            case 'cep':
                $string = substr($string, 0, 2) . substr($string, 2, 3) . '-' . substr($string, 5, 3);
                break;
            case 'cpf':
                $string = substr($string, 0, 3) . '.' . substr($string, 3, 3) .
                        '.' . substr($string, 6, 3) . '-' . substr($string, 9, 2);
                break;
            case 'cnpj':
                $string = substr($string, 0, 2) . '.' . substr($string, 2, 3) .
                        '.' . substr($string, 5, 3) . '/' .
                        substr($string, 8, 4) . '-' . substr($string, 12, 2);
                break;
            case 'rg':
                $string = substr($string, 0, 2) . '.' . substr($string, 2, 3) .
                        '.' . substr($string, 5, 3);
                break;
            
            case 'placa':
                $string = strtoupper(substr($string, 0, 3)) . '-' . substr($string, 3, 4);
                break;
            case 'codigo_solicitacao':
                $string = self::mascara_string("#### #### #### ####", $string);
                break;
            case 'numero_processo':
                $string = substr($string, 0, strlen($string)-4)."-".substr($string, strlen($string)-4, 4);
                break;
            case 'telefone':
                if (strlen(trim($string)) == 10) {
                    $string = self::mascara_string("(##) ####-####", $string);
                } else {
                    $string = self::mascara_string("(##) #####-####", $string);
                }
                break;
        }
        return $string;
    }

    public static function mascara_string($mascara, $string) {
        $string = trim($string);
        for ($i = 0; $i < strlen($string); $i++) {
            $mascara[strpos($mascara, "#")] = $string[$i];
        }
        return $mascara;
    }

    public static function somenteNumeros($string) {
        return preg_replace("/[^0-9]/", "", $string);
    }

    //Função Remove acentos, para facilitar buscas
    public static function removeAcentos($string, $slug = false) {
        $string = strtolower($string);

        // Código ASCII das vogais
        $ascii['a'] = range(224, 230);
        $ascii['e'] = range(232, 235);
        $ascii['i'] = range(236, 239);
        $ascii['o'] = array_merge(range(242, 246), array(240, 248));
        $ascii['u'] = range(249, 252);

        // Código ASCII dos outros caracteres
        $ascii['b'] = array(223);
        $ascii['c'] = array(231);
        $ascii['d'] = array(208);
        $ascii['n'] = array(241);
        $ascii['y'] = array(253, 255);

        foreach ($ascii as $key => $item) {
            $acentos = '';
            foreach ($item AS $codigo)
                $acentos .= chr($codigo);
            $troca[$key] = '/[' . $acentos . ']/i';
        }

        $string = preg_replace(array_values($troca), array_keys($troca), $string);

        // Slug?
        if ($slug) {
            // Troca tudo que não for letra ou número por um caractere ($slug)
            $string = preg_replace('/[^a-z0-9]/i', $slug, $string);
            // Tira os caracteres ($slug) repetidos
            $string = preg_replace('/' . $slug . '{2,}/i', $slug, $string);
            $string = trim($string, $slug);
        }

        return $string;
    }

    public static function  substituirAcentos($string, $codificacaoEntrada = 'UTF-8', $codificacaoSaida = 'UTF-8', $somenteLetras = true) {
        $string = iconv($codificacaoEntrada, $codificacaoSaida, $string);
        $string = preg_replace([
            "/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/","/(ç)/","/(Ç)/"
        ], [
            "a", "A", "e", "E", "i", "I", "o", "O", "u", "U", "n", "N", "c", "C"
        ], $string);

        if(!$somenteLetras) {
            $string = preg_replace("/[][><}{)(:;,!?*%~^`@]/", "", $string);
        }
        return $string;
    }

    public static function  remover_caracter($string) {
        $string = preg_replace("/[ÁÀÂÃÄáàâãä]/", "a", $string);
        $string = preg_replace("/[ÉÈÊéèê]/", "e", $string);
        $string = preg_replace("/[ÍÌíì]/", "i", $string);
        $string = preg_replace("/[ÓÒÔÕÖóòôõö]/", "o", $string);
        $string = preg_replace("/[ÚÙÜúùü]/", "u", $string);
        $string = preg_replace("/Çç/", "c", $string);
        $string = preg_replace("/[][><}{)(:;,!?*%~^`@]/", "", $string);
        $string = preg_replace("/ /", "_", $string);
        $string = strtolower($string);
        return $string;
    }

    public static function removeAcentosSimplificado($string) {
        return preg_replace('/[`^~\'"]/', null, iconv('UTF-8', 'ASCII//TRANSLIT', $string));
    }

    public static function removeAcentosSimplificadoCodificacao($string, $codificacaoEntrada = 'UTF-8',$codificacaoSaida = 'ASCII//TRANSLIT') {
        return preg_replace('/[`^~\'"]/', null, iconv($codificacaoEntrada, $codificacaoSaida, $string));
    }

    public static function msgTextFlash(\Exception $objectException) {
        $trace = $objectException->getTrace();
//        echo Yii::trace(CVarDumper::dumpAsString($trace[3]['line']),'vardump');
//        echo Yii::trace(CVarDumper::dumpAsString($objectException->getLine()),'vardump');
//        echo Yii::trace(CVarDumper::dumpAsString($trace[3]),'vardump');
        if (isset($objectException->errorInfo) && !empty($objectException->errorInfo) && count($objectException->errorInfo) == 0) {
            return  '<h4>'
                        . '<b><span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span> Ocorreu erro(s) em sua requisição!</b>'
                    . '</h4><br/>'
                    . '' . $objectException->getMessage();
        } else {
            return  '<h4>'
                        . '<b><span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span> Ocorreu erro(s) em sua requisição!</b>'
                    . '</h4><br/>'
                    . '<a class="btn btn-sm btn-primary" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">'
                        . '<span class="glyphicon glyphicon-th-list" aria-hidden="true"></span><b> Detalhes Técnico</b>'
                    . '</a>'
                    . '<div class="collapse" id="collapseExample">'
                        . '<div class="well text-primary">'
//                            . '<b>Caminho do erro:</b> '.$trace[3]['file'].' <b>Linha:</b> '.$trace[3]['line'].'<br/>'
                            . $objectException->getMessage()
                        . '</div>'
                    . '</div>';
        }

    }

    public static function msgTextException($model, $nameModel) {
        return "Não foi possível salvar o model $nameModel.<br/><b>Detalhes:</b> " . UtilFuncoes::getErrorsFormat($model->getErrors());
    }

}

?>
