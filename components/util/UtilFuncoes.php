<?php
namespace  app\components\util;

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
/**
 * Description of UtilFuncoes
 *
 * @author quemuellp
 */
class UtilFuncoes
{
    public static function isTratarStringAmbiente() {
        $tratarString = false;
        //SE TIVER EM PRODUCAO E NAO ESTIVER NO ARRAY ABAIXO, ENTAO, TRATE A STRING
        if((\Yii::$app->params['environment'] === 'prod') && !in_array($_SERVER['HTTP_HOST'], ['172.22.8.39', '177.20.6.129','coviddrivethru.salvador.ba.gov.br','www.coviddrivethru.salvador.ba.gov.br'])) {
            $tratarString = true;
        }
        $servidor = $_SERVER['HTTP_HOST'];
        if(strpos($servidor,"localhost") > -1){
            $tratarString = false; 
        }
        return $tratarString;
    }

    public static function validarPlaca($placa) {
        $expressoesRegularesPlaca = array(
            '/^[a-zA-Z]{3}[0-9]{4}$/', //PLACA COMUM SEM HIFEN
            '/^[a-zA-Z]{3}-[0-9]{4}$/', //PLACA COMUM COM HIFEN
            '/^[a-zA-Z]{3}[0-9]{1}[a-zA-Z]{1}[0-9]{2}$/', //PLACA MERCOSUL SEM HIFEN
            '/^[a-zA-Z]{3}-[0-9]{1}[a-zA-Z]{1}[0-9]{2}$/' //PLACA MERCOSUL COM HIFEN
        );

        foreach ($expressoesRegularesPlaca as $expressao) {
            if(preg_match($expressao, $placa)) {
                return true;
            }
        }

        return false;
    }

    public static function isPlacaMercosul($placa) {
        $expressoesRegularesPlaca = array(
            '/^[a-zA-Z]{3}[0-9]{1}[a-zA-Z]{1}[0-9]{2}$/', //PLACA MERCOSUL SEM HIFEN
            '/^[a-zA-Z]{3}-[0-9]{1}[a-zA-Z]{1}[0-9]{2}$/' //PLACA MERCOSUL COM HIFEN
        );

        foreach ($expressoesRegularesPlaca as $expressao) {
            if(preg_match($expressao, $placa)) {
                return true;
            }
        }

        return false;
    }

    public static function getErrorsFormat($arrayErrors)
    {
        if (isset($arrayErrors) && !empty($arrayErrors)) {
            $message = "<ul>";
            foreach ($arrayErrors as $value) {
                $message .= '<li>' . $value[0] . '</li>';
            }
            $message .= "</ul>";
            return $message;
        } else {
            return '';
        }
    }

    public static function formatBytes($size, $precision = 2)
    {
        $base = log($size, 1024);
        $suffixes = array('', 'K', 'M', 'G', 'T');

        return round(pow(1024, $base - floor($base)), $precision) .' '. $suffixes[floor($base)];
    }

    public static function arrayWhereKeys($array, $keysArray)
    {
        foreach ($array as $key => $row) {
            foreach ($keysArray as $keyValue) {
                if ($key == $keyValue) {
                    $arraySelected[$key] = $row;
                    break;
                }
            }
        }
        return $arraySelected;
    }

    /*
     * function toSqlFormatNumber
     * função para converter numero 
     * 
     * $number int exemple: 10645
     * return 106.45
     */

    public static function toSqlFormatNumber($number)
    {
        if (empty($number))
            return '';
//        UtilDebug::preprint('numero'.$numbeCr);
        $number = trim(str_replace("R$ ", "", str_replace("R$", "",str_replace(",", "", str_replace(".", "", str_replace("-", "", $number))))));
//        UtilDebug::preprint('numeroreplaced'.$number);
        $decimal = substr($number, strlen($number) - 2, strlen($number));
//        UtilDebug::preprint('decimal'.$decimal);
        $int = substr($number, 0, strlen($number) - 2);
//        UtilDebug::preprint('int'.$inCt);
        return $int . "." . $decimal;
    }

    /*
     * function getDataOfArraysByComparing
     * FUNCAO FAZ A COMPARACAO APENAS DOS VALORES ENTRE DOIS ARRAYS
     *
     * TRAZENDO
     * OS ITENS QUE VAO SER DELETADOS,
     * OS ITENS QUE VAO SER INSERIDOS E
     * OS ITENS QUE VAO SER ATUALIZADOS(OU SEJA QUE SAO IGUAIS)
     * 
     * return arrayDiff[]
     */

    public static function getDataOfArraysByComparing($firtArrayOfObject, $secondArrayOfObject)
    {
        $delete = array_diff($firtArrayOfObject, $secondArrayOfObject);
        $insert = array_diff($secondArrayOfObject, $firtArrayOfObject);
        $update = array_intersect($firtArrayOfObject, $secondArrayOfObject);
        return [
            'delete' => $delete,
            'insert' => $insert,
            'update' => $update
        ];
    }

    /*
     * function arrayOfObjectDiff
     * função para converter numero
     *
     * $number int exemple: 10645
     * return 106.45
     */

    public static function arrayOfObjectsDiff($firtArrayOfObject, $secondArrayOfObject, $attribute)
    {
        if (empty($firtArrayOfObject) || empty($secondArrayOfObject) || empty($attribute))
            return array();

        $firtArray = array();
        foreach ($firtArrayOfObject as $object) {
            $value = $object->$attribute;
            if (!empty($value)) {
                $firtArray[] = $object->$attribute;
            }
        }
//        UtilDebug::preprint($firtArray);

        $secondArray = array();
        foreach ($secondArrayOfObject as $object) {
            $value = $object->$attribute;
            if (!empty($value)) {
                $secondArray[] = $object->$attribute;
            }
        }
//        UtilDebug::preprint($secondArray);
//        implode(',', array_keys(array_diff($guardaPessoa, $pessoa->attributes)))
        if (count($firtArray) > count($secondArray)) {
            return array_diff($firtArray, $secondArray);
        } else {
            return array_diff($secondArray, $firtArray);
        }
    }

    public static function arrayOfArrayDiff($firstArray, $secondArray)
    {
        if (empty($firstArray) || empty($secondArray))
            return array();

        if (count($firstArray) > count($secondArray)) {
            return array_diff($firstArray, $secondArray);
        } else {
            return array_diff($secondArray, $firstArray);
        }
    }

    public static function subtrairValores($valor1, $valor2)
    {
        if ($valor1 >= $valor2) {
            return $valor1 - $valor2;
        } else {
            return $valor2 - $valor1;
        }
    }

    public static function reArrayFiles(&$file_post)
    {
        $file_ary = array();
        $file_count = count($file_post['name']);
        $file_keys = array_keys($file_post);

        for ($i = 0; $i < $file_count; $i++) {
            foreach ($file_keys as $key) {
                $file_ary[$i][$key] = $file_post[$key][$i];
            }
        }

        return $file_ary;
    }

    public static function reArrayFile($file_post)
    {
        $file_ary = array();
        $file_count = count($file_post['name']);
        $file_keys = array_keys($file_post);

        for ($i = 0; $i < $file_count; $i++) {
            foreach ($file_keys as $key) {
                $file_ary[$i][$key] = $file_post[$key];
            }
        }

        return $file_ary;
    }

    public static function uniqueFileName($extension)
    {
        if (strpos($extension, '.') === false)
            $extension = '.' . $extension;

        $maxExecTime = time() + 10;
        $isUnique = false;
        while (time() !== $maxExecTime) {
            //////////// Unique file name
            $uniqueFileName = uniqid(mt_rand(), false) . $extension;
            if (!Arquivo::model()->exists("arq_nom_arquivo = '{$uniqueFileName}'")) {
                $isUnique = true;
                break;
            }
        }

        return $uniqueFileName;
    }

    public static function curl($url)
    {
        // Assigning cURL options to an array
        $options = Array(
            CURLOPT_RETURNTRANSFER => TRUE, // Setting cURL's option to return the webpage data
            CURLOPT_FOLLOWLOCATION => TRUE, // Setting cURL to follow 'location' HTTP headers
            CURLOPT_BINARYTRANSFER => TRUE, // Setting cURL to follow 'location' HTTP headers
            CURLOPT_AUTOREFERER => TRUE, // Automatically set the referer where following 'location' HTTP headers
            CURLOPT_CONNECTTIMEOUT => 120, // Setting the amount of time (in seconds) before the request times out
            CURLOPT_TIMEOUT => 120, // Setting the maximum amount of time for cURL to execute queries
            CURLOPT_MAXREDIRS => 10, // Setting the maximum number of redirections to follow
            CURLOPT_USERAGENT => "Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.9.1a2pre) Gecko/2008073000 Shredder/3.0a2pre ThunderBrowse/3.2.1.8", // Setting the useragent
            CURLOPT_URL => $url, // Setting cURL's URL option with the $url variable passed into the function
        );

        $ch = curl_init();  // Initialising cURL
        curl_setopt_array($ch, $options);   // Setting cURL's options using the previously assigned array data in $options
        $data = curl_exec($ch); // Executing the cURL request and assigning the returned data to the $data variable
        curl_close($ch);    // Closing cURL
        return $data;
    }

    public static function scrape_between($data, $start, $end)
    {
        $data = stristr($data, $start); // Stripping all data from before $start
        $data = substr($data, strlen($start));  // Stripping $start
        $stop = stripos($data, $end);   // Getting the position of the $end of the data to scrape
        $data = substr($data, 0, $stop);    // Stripping all data from after and including the $end of the data to scrape
        return $data;   // Returning the scraped data from the function
    }

    public static function array_insert(&$array, $position, $insert) {
        if (is_int($position)) {
            array_splice($array, $position, 0, $insert);
        }
        else {
            $pos = array_search($position, array_keys($array));
            $array = array_merge(array_slice($array, 0, $pos), $insert, array_slice($array, $pos));
        }
    }

    //Função para verificar se o IPTU é válido
    public static function iptuMod11Valido($dado, $numDig, $limMult, $digitoIptu){

        for($n = 1; $n <= $numDig; $n++){
            $soma = 0;
            $mult = 2;

            for($i = strlen($dado) - 1; $i >= 0; $i--){
                $soma += ($mult * (int) $dado[$i]);
                if(++$mult > $limMult){
                    $mult = 2;
                }
            }
            $dado .= (($soma * 10) % 11) % 10;
        }

        $digitoCalculado = substr($dado, strlen($dado) - $numDig, $numDig);

        return ($digitoCalculado == $digitoIptu ? true : false);
    }
}
