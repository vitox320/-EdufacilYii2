<?php
namespace  app\components\util;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UtilData
 *
 * @author João Paulo e Quemuel Leal
 */
class UtilData {

    public static $meses = array(1 => "Janeiro", 2 => "Fevereiro", 3 => "Março", 4 => "Abril", 5 => "Maio", 6 => "Junho", 7 => "Julho", 8 => "Agosto", 9 => "Setembro", 10 => "Outubro", 11 => "Novembro", 12 => "Dezembro");
    public static $meses_formatados_parte = array("08" => "Agosto", "09" => "Setembro", "10" => "Outubro", "11" => "Novembro", "12" => "Dezembro");
    public static $meses_formatados = array("01" => "Janeiro", "02" => "Fevereiro", "03" => "Março", "04" => "Abril", "05" => "Maio", "06" => "Junho", "07" => "Julho", "08" => "Agosto", "09" => "Setembro", "10" => "Outubro", "11" => "Novembro", "12" => "Dezembro");
    public static $days = array( 'Sunday' => 'Domingo', 'Monday' => 'Segunda-Feira', 'Tuesday' => 'Terça-Feira', 'Wednesday' => 'Quarta-Feira', 'Thursday' => 'Quinta-Feira', 'Friday' => 'Sexta-Feira','Saturday' => 'Sábado' );
    public static $daysNumber = array( '01' => 'Domingo', '02' => 'Segunda-Feira', '03' => 'Terça-Feira', '04' => 'Quarta-Feira', '05' => 'Quinta-Feira', '06' => 'Sexta-Feira','07' => 'Sábado' );

    public static $daysWeekLong = array('Domingo', 'Segunda-Feira', 'Terça-Feira', 'Quarta-Feira', 'Quinta-Feira', 'Sexta-Feira', 'Sabado');
    public static $daysWeekShort = array('Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado');
    public static $daysWeekSmall = array('DOM', 'SEG', 'TER', 'QUA', 'QUI', 'SEX', 'SAB');

    public static function mesNumToMesStr($mesNumerico) {
        if (array_key_exists((int) $mesNumerico, UtilData::$meses)) {
            return UtilData::$meses[(int) $mesNumerico];
        } else {
            return "";
        }
    }

    public static function mesStrToMesNum($mesString) {
        if (in_array($mesString, UtilData::$meses)) {
            return array_search($mesString, UtilData::$meses);
        } else {
            return -1;
        }
    }

    public static function formatNumPostMesDiretorio($numPost) {
        return strlen($numPost) == 1 ? '0' . $numPost : $numPost;
    }

    public static function preencherSelectMes($mesSelecionado = null) {
        $result = "";

        foreach (UtilData::$meses as $mes) {
            $keyMes = array_search($mes, UtilData::$meses);
            if ((int) $mesSelecionado == $keyMes) {
                $result .= "<option value=" . $keyMes . " selected>" . $mes . "</option>";
            } else {
                $result .= "<option value=" . $keyMes . ">" . $mes . "</option>";
            }
        }

        return $result;
    }

    public static function preencherSelectAPartirMes($mesSelecionado = null, $aPartirMes = null, $ateMes = null) {
        $result = "";
        $mesSelecionado = strlen($mesSelecionado) == 1 ? '0' . $mesSelecionado : $mesSelecionado;

        foreach (UtilData::$meses as $mes) {
            $keyMes = array_search($mes, UtilData::$meses);
            if ($aPartirMes != null && $keyMes < $aPartirMes) {
//            echo $keyMes.' a partir'.$aPartirMes;
                continue;
            } else {
                if ((int) $mesSelecionado == $keyMes) {
                    $result .= "<option value=" . $keyMes . " selected>" . $mes . "</option>";
                    if ($ateMes != null && $ateMes == $keyMes) {
                        break;
                    }
                } else {
                    $result .= "<option value=" . $keyMes . ">" . $mes . "</option>";
                    if ($ateMes != null && $ateMes == $keyMes) {
                        break;
                    }
                }
            }
        }

        return $result;
    }

    public static function preencherSelectAno($anoIni, $anoFim, $anoSelecionado = null) {
        $result = "";
        if ($anoSelecionado == null)
            $anoSelecionado = date("Y");

        if ($anoIni > $anoFim) {
            throw new Exception("O ano inicial deve ser menor do que o ano final.");
        }

        for ($x = $anoIni; $x <= $anoFim; $x++) {
            if ($x == $anoSelecionado) {
                $result .= "<option value=" . $x . " selected>" . $x . "</option>";
            } else {
                $result .= "<option value=" . $x . ">" . $x . "</option>";
            }
        }

        return $result;
    }

    public static function dataExtensoPortugues($dataSQL = NULL)
    {
//        UtilDebug::preprint($dataSQL);exit;
        $diasemana = array('Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado');
        if(isset($dataSQL) && !empty($dataSQL)){
            $data = $dataSQL;
        }else{
            $data = date('Y-m-d');
        }
        $diasemana_numero = date('w', strtotime($data));

        $diaExtenso = $diasemana[$diasemana_numero];
        $dia = date('d', strtotime($data));
        $mes = self::$meses_formatados[date('m', strtotime($data))];
        $ano = date('Y', strtotime($data));

        return "$diaExtenso, $dia de $mes de $ano";
    }

    public static function diaExtensoPortugues($data = NULL, $format = 'short')
    {
        switch ($format):
            case 'long':
                $arrayDiasSemana = UtilData::$daysWeekLong;
                break;
            case 'short':
                $arrayDiasSemana = UtilData::$daysWeekShort;
                break;
            case 'small':
                $arrayDiasSemana = UtilData::$daysWeekSmall;
                break;
        endswitch;



        $diasemana_numero = date('w', strtotime($data));

        $diaExtenso = $arrayDiasSemana[$diasemana_numero];

        return "$diaExtenso";
    }

    public static function trataDataValorMinimo($data) {
        $data_aux = explode(' ', $data);
        if ($data_aux[0] == '1900-01-01' || $data_aux[0] == '01/01/1900') {
            return '';
        } else {
            return $data;
        }
    }

    public static function toSqlDate($unknowFormatDate, $flgIncludeTime = true) {
        if (trim($unknowFormatDate) == '')
            return '';
        $dateAux = explode(" ", $unknowFormatDate);
        $separador = strstr($dateAux[0], "/") ? "/" : "-";
        $dateAux2 = explode($separador, $dateAux[0]);

        if (strlen($dateAux2[0]) == 4) {
            $retorno = $dateAux2[0] . "-" . $dateAux2[1] . "-" . $dateAux2[2];
        } else {
            $retorno = $dateAux2[2] . "-" . $dateAux2[1] . "-" . $dateAux2[0];
        }

        if ($flgIncludeTime && isset($dateAux[1])) {
            $retorno .= " " . $dateAux[1];
        }
        return $retorno;
    }

    public static function formatarDataBR($unknowFormatDate = NULL) {
        if ($unknowFormatDate == '' || $unknowFormatDate == NULL)
            return '';
        $retorno = date('d/m/Y H:i', strtotime($unknowFormatDate));
       
        return $retorno;
    }

    public static function toBrDate($unknowFormatDate = NULL, $flgIncludeTime = true, $flgIncludeSeg = true, $flgIncludeMilSeg = false) {
        if (trim($unknowFormatDate) == ''|| $unknowFormatDate == NULL)
            return '';
        $dateAux = explode(" ", $unknowFormatDate);
        $separador = strstr($dateAux[0], "/") ? "/" : "-";
        $dateAux2 = explode($separador, $dateAux[0]);

        if (strlen($dateAux2[0]) == 4) {
            $retorno = $dateAux2[2] . "/" . $dateAux2[1] . "/" . $dateAux2[0];
        } else {
            $retorno = $dateAux2[0] . "/" . $dateAux2[1] . "/" . $dateAux2[2];
        }

        if ($flgIncludeTime && isset($dateAux[1])) {
            if(!$flgIncludeSeg){
                $retorno .= " " . UtilText::limitarStr($dateAux[1], 5,'');
            }else if(!$flgIncludeMilSeg){
                $retorno .= " " . UtilText::limitarStr($dateAux[1], 8,'');
            }else{
                $retorno .= " " . $dateAux[1];
            }
        }
        return $retorno;
    }

    //fonte: http://www.vivaolinux.com.br/dica/Calculo-de-dias-uteis-entre-duas-datas-em-PHP
    //CALCULANDO DIAS NORMAIS
    /* Abaixo vamos calcular a diferença entre duas datas. Fazemos uma reversão da maior sobre a menor 
      para não termos um resultado negativo. */
    public static function calculaDias($xDataInicial, $xDataFinal) {
        $time1 = self::dataToTimestamp($xDataInicial);
        $time2 = self::dataToTimestamp($xDataFinal);

        $tMaior = $time1 > $time2 ? $time1 : $time2;
        $tMenor = $time1 < $time2 ? $time1 : $time2;

        $diff = $tMaior - $tMenor;
        $numDias = $diff / 86400; //86400 é o número de segundos que 1 dia possui  
        return $numDias;
    }

    /* Abaixo vamos calcular a diferença entre duas datas e retornar as quantidades de dias, meses e anos. 
     * Faz-se uma reversão da maior sobre a menor para não termos um resultado negativo. */
    
    /*Parametro $dateTimeIni e $dateTimeFim fomato americano, ex.: $dateTimeIni = 2015-12-30 00:00:00*/
    
    /*Retorno array $diasMesesAnos com as quantidades dos dias, meses e anos do tipo inteiro*/
    public static function calculaDiasMesAno($dateTimeIni, $dateTimeFim) {
        if(self::compareDatePHP($dateTimeIni, $dateTimeFim) == 1){
            $dateTimeMaior = $dateTimeIni;
            $dateTimeMenor = $dateTimeFim;
        }else{
            $dateTimeMaior = $dateTimeFim;
            $dateTimeMenor = $dateTimeIni;
        }
        
        $diff = abs(strtotime($dateTimeMaior) - strtotime($dateTimeMenor));

        $years = floor($diff / (365*60*60*24));
        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
        $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

        $diasMesesAnos = array("years" => $years,"months" => $months,"days" => $days);
        
        return $diasMesesAnos;
    }

    //LISTA DE FERIADOS NO ANO
    /* Abaixo criamos um array para registrar todos os feriados existentes durante o ano. */
    public static function getFeriados($ano) {
        $dia = 86400;
        $datas = array();
        $datas['pascoa'] = easter_date($ano);
        $datas['sexta_santa'] = $datas['pascoa'] - (2 * $dia);
        $datas['carnaval'] = $datas['pascoa'] - (47 * $dia);
        $datas['corpus_cristi'] = $datas['pascoa'] + (60 * $dia);
        $feriados = array(
            '01/01',
            '02/02', // Yemanjá
            date('d/m', $datas['carnaval']),
            date('d/m', $datas['sexta_santa']),
            date('d/m', $datas['pascoa']),
            '21/04', //Tiradentes
            '01/05', //Dia do Trabalhador
            date('d/m', $datas['corpus_cristi']),
            '24/06', //São João
            '20/09', // Revolução Farroupilha
            '12/10',
            '02/11',
            '15/11',
            '25/12' //Natal
        );

        //return $feriados[$posicao] . "/" . $ano;
        return $feriados;
    }

    public static function getFeriadosCalendarioBD($ano) {
        $dia = 86400;
        $datas = array();
//        echo "ano $ano";exit;
        $datas['pascoa'] = easter_date($ano);
        $datas['sexta_santa'] = $datas['pascoa'] - (2 * $dia);
        $datas['carnaval'] = $datas['pascoa'] - (47 * $dia);
        $datas['corpus_cristi'] = $datas['pascoa'] + (60 * $dia);
        
        $feriados = array(
            '01/01',
            '02/02', // Yemanjá
            date('d/m', $datas['carnaval']),
            date('d/m', $datas['sexta_santa']),
            date('d/m', $datas['pascoa']),
            '21/04', //Tiradentes
            '01/05', //Dia do Trabalhador
            date('d/m', $datas['corpus_cristi']),
            '24/06', //São João
            '20/09', // Revolução Farroupilha
            '12/10',
            '02/11',
            '15/11',
            '25/12' //Natal
        );
        
        $datesHolidays = CalendarioDAO::getInstance()->selectHolidaysFromYear('2014');
        foreach ($datesHolidays as $data) {
            $feriados[] = date('d/m',strtotime($data->getDataInicio()));
        }
        return $feriados;
    }
    
    
    //FORMATA COMO TIMESTAMP
    /* Esta função é bem simples, e foi criada somente para nos ajudar a formatar a data já em formato  TimeStamp facilitando nossa soma de dias para uma data qualquer. */
    public static function dataToTimestamp($data) {
        $ano = substr($data, 6, 4);
        $mes = substr($data, 3, 2);
        $dia = substr($data, 0, 2);
        return mktime(0, 0, 0, $mes, $dia, $ano);
    }

    //SOMA 01 DIA   
    public static function soma1dia($data) {
        $ano = substr($data, 6, 4);
        $mes = substr($data, 3, 2);
        $dia = substr($data, 0, 2);
        return date("d/m/Y", mktime(0, 0, 0, $mes, $dia + 1, $ano));
    }

    //VERIFICA SE É VALIDA O INTERVALO ENTRE AS DATAS 
    //Função que analisa se a primeira data é menor que a segunda se for retorna true se não retorna false.
    public static function isValidDateRange($dateFirst, $dateSecond) {
        $dateFirst = date("Ymd", strtotime(self::toSqlDate($dateFirst)));
        $dateSecond = date("Ymd", strtotime(self::toSqlDate($dateSecond)));
        if ($dateFirst >= $dateSecond) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Função para calcular o próximo dia útil de uma data
     * Formato de entrada da $data: AAAA-MM-DD
     */
    function proximoDiaUtil($data, $saida = 'Y-m-d') {
        // Converte $data em um UNIX TIMESTAMP
        $timestamp = strtotime($data);
        // Calcula qual o dia da semana de $data
        // O resultado será um valor numérico:
        // 1 -> Segunda ... 7 -> Domingo
        $dia = date('N', $timestamp);
        // Se for sábado (6) ou domingo (7), calcula a próxima segunda-feira
        if ($dia >= 6) {
            $timestamp_final = $timestamp + ((8 - $dia) * 3600 * 24);
        } else {
            // Não é sábado nem domingo, mantém a data de entrada
            $timestamp_final = $timestamp;
        }
        return date($saida, $timestamp_final);
    }

    /**
     * Função para calcular o dia útil anterior de uma data
     * Formato de entrada da $data: AAAA-MM-DD
     */
    function anteriorDiaUtil($data, $saida = 'Y-m-d') {
        // Converte $data em um UNIX TIMESTAMP
        $timestamp = strtotime($data);
        // Calcula qual o dia da semana de $data
        // O resultado será um valor numérico:
        // 1 -> Segunda ... 7 -> Domingo
        $dia = date('N', $timestamp);
        if ($dia == 6) {// Se for sábado (6), calcula 1 dia a menos
            $timestamp_final = $timestamp - ((8 - $dia) * 3600 * 24);
        } else if ($dia == 7) {// Se for domingo (7), calcula 2 dia a menos           
            $sabado = $timestamp - ((8 - $dia) * 3600 * 24);
            $timestamp_final = $sabado - ((8 - $dia) * 3600 * 24);
        } else {
            // Não é sábado nem domingo, mantém a data de entrada
            $timestamp_final = $timestamp;
        }
        return date($saida, $timestamp_final);
    }

    function getDatasApuracao() {
        $timePeriodoIni = new DateTime(UtilData::toSqlDate("01/10/2015"));
        $timePeriodoFim = new DateTime(UtilData::toSqlDate(date('Y-m-d')));
        $datas = array();
        $i=0;
        while ($timePeriodoIni <= $timePeriodoFim) {
            $datas[] = $timePeriodoIni->format('Y-m-d');
            $timePeriodoIni->modify('+1 month');
            UtilDebug::preprint($datas);
            if($i==10){
                break;
            }
            $i++;
        }
        exit;
//        return $datas;
//        
//        $i=0;
//        
//        echo date('Y-m-d', strtotime($date.' +20 day'));exit;
//        while($i<=20){
//            $date = date('Y-m-d', strtotime($date.' +20 day'))."<br>";
//            echo $date;
//            $i++;
//        }
//        exit;
//        $periodo
//        return array('dataIni' => $dataIni, 'dataFim' => $dataFim);
    }

    /**
     * Função que traz as datas úteis dentro de um período verificando também os feriados
     * Formato de entrada da $data: AAAA-MM-DD
     * Retorno : array de datas
     */
    function datasUteisDeUmIntervalo($date1, $date2) {
        $feriados = self::getFeriadosCalendarioBD(date("Y"));
        if ($date1 < $date2) {
            $dates_range[] = $date1;
            $date1 = strtotime($date1);
            $date2 = strtotime($date2);
            while ($date1 < $date2) {
                $date1 = mktime(0, 0, 0, date("m", $date1), date("d", $date1) + 1, date("Y", $date1));
                $proxDia = self::proximoDiaUtil(date('Y-m-d', $date1), 'Y-m-d');
                $mes = self::toBrDate($proxDia);
                $mes = substr($mes, 0, 5);
                if ($date1 >= $date2) {//Se chegar na útilma data do período não pega o proximo dia
                    $proxDia = self::anteriorDiaUtil(date('Y-m-d', $date1), 'Y-m-d');
                } else if (in_array($mes, $feriados)) {//Se for feriado o proximo dia recebe null e é eliminado do array depois
                    $proxDia = self::anteriorDiaUtil(date('Y-m-d', $date1), 'Y-m-d');
                }
                $dates_range[] = $proxDia;
            }
            $dates_range = array_unique($dates_range); //Eliminando datas iguas no array
            $datas_filtradas = array_filter($dates_range); //Eliminando do array índices com valores null
            sort($datas_filtradas); //Reordena índices do array
        }

        return $datas_filtradas;
    }

    //Parametros no padrão americano aceitavel:
    //Ex.: 2008-04-12 13:24:00
    public static function compareDate($dateIni, $dateFim) {
        $query = "SELECT (
                    CASE 
                        WHEN '$dateIni' < '$dateFim'  THEN -1
                        WHEN '$dateIni' > '$dateFim'  THEN 1
                        WHEN '$dateIni' = '$dateFim'  THEN 0
                        ELSE NULL
                    END
                    ) AS resultado";
       $row = Yii::app()->db->createCommand($query)->queryRow();
        return $row["resultado"];
    }
    
    //Parametros no padrão americano aceitavel:
    //Ex.: 2008-04-12 13:24:00
    public static function checkInRange($dateIni, $dateFim, $dateUser){
        $query = "SELECT (
                    CASE 
                        WHEN (('$dateIni' <= '$dateUser') AND ('$dateUser' <= '$dateFim'))  THEN 1
                        ELSE 0
                    END
                ) AS resultado";
        $result = mssql_query($query);
        $row = mssql_fetch_assoc($result);
        if($row["resultado"]==1){
            return true;
        }else{
            return false;
        }
    }
    
    //CALCULA DIAS UTEIS
    /* É nesta função que faremos o calculo. Abaixo podemos ver que faremos o cálculo normal de dias ($calculoDias), após este cálculo, faremos a comparação de dia a dia, verificando se este dia é um sábado, domingo ou feriado e em qualquer destas condições iremos incrementar 1 */

    public static function diasUteis($yDataInicial, $yDataFinal) {
        $yDataInicial = self::toBrDate($yDataInicial, false);
        $yDataFinal = self::toBrDate($yDataFinal, false);

        $diaFDS = 0; //dias não úteis(Sábado=6 Domingo=0)
        $calculoDias = self::calculaDias($yDataInicial, $yDataFinal); //número de dias entre a data inicial e a final
        $diasUteis = 0;

        $feriados = self::getFeriadosCalendarioBD(date("Y"));
        $diaSemana = date("w", self::dataToTimestamp($yDataInicial));
        if ($diaSemana == 0 || $diaSemana == 6) {
            //se SABADO OU DOMINGO, SOMA 01
            $diaFDS++;
        }
        $diaSemana = date("w", self::dataToTimestamp($yDataFinal));
        if ($diaSemana == 0 || $diaSemana == 6) {
            //se SABADO OU DOMINGO, SOMA 01
            $diaFDS++;
        }
        while ($yDataInicial != $yDataFinal) {
            $diaSemana = date("w", self::dataToTimestamp($yDataInicial));
            if ($diaSemana == 0 || $diaSemana == 6) {
                //se SABADO OU DOMINGO, SOMA 01
                $diaFDS++;
            } else {
                //senão vemos se este dia é FERIADO
                //if ($yDataInicial == self::feriados(date("Y"), $i)) {
                $mes = substr($yDataInicial, 0, 5);
                if (in_array($mes, $feriados)) {
                    $diaFDS++;
                }
            }
            $yDataInicial = self::soma1dia($yDataInicial); //dia + 1
        }
       
        return $calculoDias - $diaFDS+1;
    }

    public static function somarSubtrairMesAtualViaBDsqlServer($isSomar,$qnt){
        if($isSomar){
            //Consulta que soma um mês do mês atual e traz o mes e o ano consernente a essa soma;
            $query = "select right('00' + convert(varchar(2),month(DATEADD(mm, +$qnt, GETDATE ()))),2) mes, year(DATEADD(mm, +$qnt, GETDATE ())) ano";
        }else{  
            //Consulta que subtrai um mês do mês atual e traz o mes e o ano consernente a essa subtracao;
            $query = "select right('00' + convert(varchar(2),month(DATEADD(mm, -$qnt, GETDATE ()))),2) mes, year(DATEADD(mm, -$qnt, GETDATE ())) ano";
        }
        $result = mssql_query($query);
        $mesAno = mssql_fetch_assoc($result);
        return $mesAno;
    }
    public static function somarSubtrairMesAtualViaBDsqlServerFromData($isSomar,$qnt,$data){
//        if($data == "2014-08-21"){
//                echo '<pre> quantidadeiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii';
//                 print_r($qnt);
//             echo '</pre>';   exit;             
//         }
        if($isSomar){
            //Consulta que soma um mês do mês atual e traz o mes e o ano consernente a essa soma;
            $query = "select right('00' + convert(varchar(2),month(DATEADD(mm, +$qnt, '$data'))),2) mes, year(DATEADD(mm, +$qnt, '$data')) ano";
//            var_dump($query);exit;
        }else{
            //Consulta que subtrai um mês do mês atual e traz o mes e o ano consernente a essa subtracao;
            $query = "select right('00' + convert(varchar(2),month(DATEADD(mm, -$qnt, '$data'))),2) mes, year(DATEADD(mm, -$qnt, '$data')) ano";
        }
        $result = mssql_query($query);
        $mesAno = mssql_fetch_assoc($result);
        return $mesAno;
    }
    //RETORNA TODAS DAS DATAS DE UM INTERVALO;
    public static function getDatesFromRange($start, $end){
        $dates = array(date('Y-m-d', strtotime($start)));
        while(end($dates) < date('Y-m-d', strtotime($end))){
            $dates[] = date('Y-m-d', strtotime(end($dates).' +1 day'));
        }
        return $dates;
    }

    public static function randomDate($start_date, $end_date){
        // Convert to timetamps
        $min = strtotime($start_date);
        $max = strtotime($end_date);

        // Generate random number using above bounds
        $val = rand($min, $max);

        // Convert back to desired date format
        return date('Y-m-d H:i:s', $val);
    }

    public static function randomTime($date,$start_time,$end_time){
        // Convert to timetamps
        $min = strtotime($date." ".$start_time);
        $max = strtotime($date." ".$end_time);

        // Generate random number using above bounds
        $val = rand($min, $max);

        // Convert back to desired date format
        return date('H:i:s', $val);
    }

    //RETORNA TODAS DAS DATAS DE UM INTERVALO; PROBLEMAS COM HORARIO DIA PROXIMOS AO HORARIO DE VERÃO
    public static function dateRange($first, $last, $step = '+1 day', $format = 'd/m/Y' ) { 
        
        $dates = array();
        $current = strtotime($first);
        $last = strtotime($last);
        while( $current <= $last ) {
            $dates[] = date($format, $current);
            $current = strtotime($step, $current);
        }

        return $dates;
    }

    //RETORNA TODAS DAS DATAS DE UM INTERVALO; PROBLEMAS COM HORARIO DIA PROXIMOS AO HORARIO DE VERÃO
    public static function datasDeUmIntervalo($dataIni,$dataFim) {
        $timePeriodoIni = new DateTime(UtilData::toSqlDate($dataIni));
        $timePeriodoFim = new DateTime(UtilData::toSqlDate($dataFim));
        $datas = array();
        while ($timePeriodoIni <= $timePeriodoFim) {
            $datas[] = $timePeriodoIni->format('Y-m-d');
            $timePeriodoIni->modify('+1day');
        }
        return $datas;
    }

    public static function calcularQuantidadeDiasDoMes($mes,$ano){
        return cal_days_in_month(CAL_GREGORIAN , $mes, $ano);
    }

    public static function intervaloDatasEspelhoPontoFromVinculoGeral($id_vinculo, $mesAnoIni, $mesAnoFim) {
        if ($id_vinculo == Parametros::ID_PRESTADOR_SERVICO) {
            $dataIni = "16/$mesAnoIni";
            $dataFim = "15/$mesAnoFim";
            return array('dataIni' => $dataIni, 'dataFim' => $dataFim);
        } else if ($id_vinculo != Parametros::ID_TERCEIRIZADO) {
            $dataIni = "21/$mesAnoIni";
            $dataFim = "20/$mesAnoFim";
            return array('dataIni' => $dataIni, 'dataFim' => $dataFim);
        }else{
            $dataIni = "01/$mesAnoIni";
            $arrayMesAno = explode("/",$mesAnoFim);
            $dia = self::calcularQuantidadeDiasDoMes($arrayMesAno[0], $arrayMesAno[1]);
            $dataFim = "$dia/$mesAnoFim";
            return array('dataIni' => $dataIni, 'dataFim' => $dataFim);
        }
        return array('dataIni' => $dataIni, 'dataFim' => $dataFim);
    }
    
    public static function intervaloDatasEspelhoPontoFromVinculo($id_vinculo, $isPeriodoAtual) {
        if ($id_vinculo == Parametros::ID_PRESTADOR_SERVICO) {
            if ($isPeriodoAtual) {
                $dia = date('d');
                $mes = date('m');
                $ano = date('Y');
//                echo $dia."<br>";
//                var_dump($dia >= 16);
//                echo "<br>";
                if ($dia >= 16) {
                    $dataIni = "16/$mes/$ano";
                    $mesAno = self::somarSubtrairMesAtualViaBDsqlServer(true, 1);
//                    echo "$dataIni<br><pre>";
//    print_r($mesAno);
//echo '</pre>'; exit;
                    $dataFim = "15/{$mesAno['mes']}/{$mesAno['ano']}";
                } else {
                    $mesAno = self::somarSubtrairMesAtualViaBDsqlServer(false, 1);
                    $dataIni = "16/{$mesAno['mes']}/{$mesAno['ano']}";
                    $dataFim = "15/$mes/$ano";
                }
            } ELSE {
                $dia = date('d');
                $mes = date('m');
                $ano = date('Y');
                if ($dia >= 16) {
                    $mesAno = self::somarSubtrairMesAtualViaBDsqlServer(false, 1);
                    $dataIni = "16/{$mesAno['mes']}/{$mesAno['ano']}";
                    $dataFim = "15/$mes/$ano";
                } else {
                    $mesAnoIni = self::somarSubtrairMesAtualViaBDsqlServer(false, 2);
                    $dataIni = "16/{$mesAnoIni['mes']}/{$mesAnoIni['ano']}";
                    $mesAnoFim = self::somarSubtrairMesAtualViaBDsqlServer(false, 1);
                    $dataFim = "15/{$mesAnoFim['mes']}/{$mesAnoFim['ano']}";
                }
            }
        } else if ($id_vinculo != Parametros::ID_TERCEIRIZADO) {
            if ($isPeriodoAtual) {
                $dia = date('d');
                $mes = date('m');
                $ano = date('Y');
                if ($dia >= 21) {
                    $dataIni = "21/$mes/$ano";
                    $mesAno = self::somarSubtrairMesAtualViaBDsqlServer(true,1);
                    $dataFim = "20/{$mesAno['mes']}/{$mesAno['ano']}";
                }else{
                    $mesAno = self::somarSubtrairMesAtualViaBDsqlServer(false,1);
                    $dataIni =  "21/{$mesAno['mes']}/{$mesAno['ano']}";
                    $dataFim = "20/$mes/$ano";
                }
            }ELSE{
                $dia = date('d');
                $mes = date('m');
                $ano = date('Y');
                if($dia >= 21){
                    $mesAno = self::somarSubtrairMesAtualViaBDsqlServer(false,1);
                    $dataIni = "21/{$mesAno['mes']}/{$mesAno['ano']}";
                    $dataFim = "20/$mes/$ano";
                }else{
                    $mesAnoIni = self::somarSubtrairMesAtualViaBDsqlServer(false,2);
                    $dataIni =  "21/{$mesAnoIni['mes']}/{$mesAnoIni['ano']}";
                    $mesAnoFim = self::somarSubtrairMesAtualViaBDsqlServer(false,1);
                    $dataFim = "20/{$mesAnoFim['mes']}/{$mesAnoFim['ano']}";
                }
            }
        }else{
            if($isPeriodoAtual){  
                $dataIni = date('01/m/Y');
                $mes = date('m');
                $ano = date('Y');
                $dia = self::calcularQuantidadeDiasDoMes($mes, $ano);
                $dataFim = date("d/m/Y", strtotime("$ano/$mes/$dia"));
            }ELSE{
                $dia = "01";
                $mesAno = self::somarSubtrairMesAtualViaBDsqlServer(false,1);
                $dataIni = date("d/m/Y", strtotime("{$mesAno['ano']}/{$mesAno['mes']}/$dia"));
                $dia = self::calcularQuantidadeDiasDoMes($mesAno['mes'], $mesAno['ano']);
                $dataFim = date("d/m/Y", strtotime("{$mesAno['ano']}/{$mesAno['mes']}/$dia"));
            }
        }
        return array('dataIni' => $dataIni, 'dataFim' => $dataFim);
    }
    public static function intervaloDatasEspelhoPontoFromVinculoAndData($id_vinculo, $data) {
//        echo $id_vinculo;
        $data_array = explode("/",$data);
        $dia = $data_array[0];
        $mes = $data_array[1];
        $ano = $data_array[2];
//        print_r($id_vinculo);
        
        if ($id_vinculo == Parametros::ID_PRESTADOR_SERVICO) {
            if ($dia >= 16) {
                $dataIni = "16/$mes/$ano";
                $mesAno = self::somarSubtrairMesAtualViaBDsqlServerFromData(true, 1,"$ano-$mes-$dia");
                $dataFim = "15/{$mesAno['mes']}/{$mesAno['ano']}";
            } else {
                $mesAno = self::somarSubtrairMesAtualViaBDsqlServerFromData(false, 1,"$ano-$mes-$dia");
                $dataIni = "16/{$mesAno['mes']}/{$mesAno['ano']}";
                $dataFim = "15/$mes/$ano";
            }
        } else if ($id_vinculo != Parametros::ID_TERCEIRIZADO) {
//            echo $dia;exit;
//            if($data == "20/09/2014"){
//                echo $dia;exit;
//            }
            if ($dia >= 21) {
                $dataIni = "21/$mes/$ano";
                $mesAno = self::somarSubtrairMesAtualViaBDsqlServerFromData(true, 1,"$ano-$mes-$dia");
//                var_dump("$ano-$mes-$dia");exit;
                
                $dataFim = "20/{$mesAno['mes']}/{$mesAno['ano']}";
            } else {
                $mesAno = self::somarSubtrairMesAtualViaBDsqlServerFromData(false, 1,"$ano-$mes-$dia");
                $dataIni = "21/{$mesAno['mes']}/{$mesAno['ano']}";
                $dataFim = "20/$mes/$ano";
            }
        } else {
                $dataIni = "01/$mes/$ano";
                $dia = self::calcularQuantidadeDiasDoMes($mes,$ano);
                $dataFim = "$dia/$mes/$ano";
        }
        return array('dataIni' => $dataIni, 'dataFim' => $dataFim);
    }
    
    public static function intervaloDatasEspelhoPontoFromVinculoAndMesAndAno($id_vinculo,$mes,$ano) {
        if ($id_vinculo == Parametros::ID_PRESTADOR_SERVICO) {
            $dataIni = "16/$mes/$ano";
            $mesAno = self::somarSubtrairMesAtualViaBDsqlServerFromData(true, 1,"$ano-$mes-15");
            $dataFim = "15/{$mesAno['mes']}/{$mesAno['ano']}";
        } else if ($id_vinculo != Parametros::ID_TERCEIRIZADO) {
//            echo $mes. "/" .$ano."<br>";
            $dataIni = "21/$mes/$ano";
            $mesAno = self::somarSubtrairMesAtualViaBDsqlServerFromData(true, 1,"$ano-$mes-20");
//            echo '<pre>';
//            print_r("$ano-$mes-20");
//            echo '</pre>';
            $dataFim = "20/{$mesAno['mes']}/{$mesAno['ano']}";
        } else {
            $dataIni = "01/$mes/$ano";
            $dia = self::calcularQuantidadeDiasDoMes($mes,$ano);
            $dataFim = "$dia/$mes/$ano";
        }
        return array('dataIni' => $dataIni, 'dataFim' => $dataFim);
    }

    //Minutos para Horas
    public static function m2h($minutos,$isSinal=false) {
        if(($minutos > 0)&&($isSinal)){
            $sinal ="+ ";
        }elseif(($minutos < 0)&&($isSinal)){
            $sinal = "- ";
        }else{
            $sinal = "";
        }
        $minutos = abs($minutos);
        $hora = floor($minutos/60);
        if(strlen($hora)==1){
            $hora = "0".$hora;
        }
        $resto = $minutos%60;
        if(strlen($resto)==1){
            $resto = "0".$resto;
        }

        return $sinal.$hora.':'.$resto;
    }

    //Horas para Minutos
    public static function h2m($hora) {
        $hora = explode(":",$hora); 
        return  ($hora[0]*60)+$hora[1];
    }

     public static function saldo($ini,$fim){
        if($ini==$fim){
            return "00:00";
        }
        if(strtotime($ini)>strtotime($fim)){
            $data1 = strtotime($ini);
            $data2 = strtotime($fim);
            $sinal = "-";
        }else{
            $data1 = strtotime($fim);
            $data2 = strtotime($ini);
            $sinal = "+";
        }

        $tempo_con = mktime(date('H', $data1) - date('H', $data2), date('i', $data1) - date('i', $data2), date('s', $data1) - date('s', $data2));

        return $sinal.date('H:i', $tempo_con);
    }
    
    //Parameter YYYY-MM-DD
    public static function getDayFromDate($date) {
        setlocale( LC_ALL, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.utf-8', 'portuguese' );
        date_default_timezone_set( 'America/Sao_Paulo' );
        return strftime( '%A', strtotime($date));
    }
    
    /*Compara data com funções do php, 
     * Se $dateTime1 for menor que $dateTime2 entao retorne -1
     * Se $dateTime1 for maior que $dateTime2 entao retorne  1 
     * Se $dateTime1 for igual que $dateTime2 entao retorne  0 */
    /*Parametro $dateTime1 e $dateTime2 fomato americano, ex.: $dateTime1 = 2015-12-30 00:00:00*/
    public static function compareDatePHP($dateTime1,$dateTime2) {
//        setlocale( LC_ALL, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.utf-8', 'portuguese' );
//        date_default_timezone_set( 'America/Sao_Paulo' );
        if(strtotime($dateTime1) < strtotime($dateTime2)){
            return -1;
        }else if(strtotime($dateTime1) > strtotime($dateTime2)){
            return 1;
        }  else {
            return 0;
        }
    }
    
    public static function isFimSemana($dia) {
        if(($dia == "Sábado") || ($dia == "Domingo") || ($dia == "sábado") || ($dia == "domingo")){
            return true;
        }else{
            return false;
        }
    }
    
    public static function dateDifference($startDate, $endDate) { 
        $startDate = strtotime($startDate); 
        $endDate = strtotime($endDate); 
        if ($startDate === false || $startDate < 0 || $endDate === false || $endDate < 0 || $startDate > $endDate) 
            return false; 

        $years = date('Y', $endDate) - date('Y', $startDate); 

        $endMonth = date('m', $endDate); 
        $startMonth = date('m', $startDate); 

        // Calculate months 
        $months = $endMonth - $startMonth; 
        if ($months <= 0)  { 
            $months += 12; 
            $years--; 
        } 
        if ($years < 0) 
            return false; 

        // Calculate the days 
                    $offsets = array(); 
                    if ($years > 0) 
                        $offsets[] = $years . (($years == 1) ? ' year' : ' years'); 
                    if ($months > 0) 
                        $offsets[] = $months . (($months == 1) ? ' month' : ' months'); 
                    $offsets = count($offsets) > 0 ? '+' . implode(' ', $offsets) : 'now'; 

                    $days = $endDate - strtotime($offsets, $startDate); 
                    $days = date('z', $days);    

        return array($years, $months, $days); 
    }
    
    public static function time_diff($dt1,$dt2){
        $y1 = substr($dt1,0,4);
        $m1 = substr($dt1,5,2);
        $d1 = substr($dt1,8,2);
        $h1 = substr($dt1,11,2);
        $i1 = substr($dt1,14,2);
        $s1 = substr($dt1,17,2);    

        $y2 = substr($dt2,0,4);
        $m2 = substr($dt2,5,2);
        $d2 = substr($dt2,8,2);
        $h2 = substr($dt2,11,2);
        $i2 = substr($dt2,14,2);
        $s2 = substr($dt2,17,2);    

        $r1=date('U',mktime($h1,$i1,$s1,$m1,$d1,$y1));
        $r2=date('U',mktime($h2,$i2,$s2,$m2,$d2,$y2));
        return ($r1-$r2);

    }
    public static function date_diff($date1, $date2) { 
        $count = 0; 
        //Ex 2012-10-01 ir 2012-10-20
        if(strtotime($date1) < strtotime($date2))
        {                       
          $current = $date1;                
          while(strtotime($current) < strtotime($date2)){ 
              $current = date("Y-m-d",strtotime("+1 day", strtotime($current))); 
              $count++; 
          } 
        }                 
        //Ex 2012-10-20 ir 2012-10-01
        else if(strtotime($date2) < strtotime($date1))
        {           
          $current = $date2;                
          while(strtotime($current) < strtotime($date1)){ 
              $current = date("Y-m-d",strtotime("+1 day", strtotime($current))); 
              $count++;  
          }
          $current = $current * -1;
        }
        return $count; 
    } 
    
    public static function s_datediff($str_interval, $dt_menor, $dt_maior){

       if( is_string( $dt_menor)) $dt_menor = date_create( $dt_menor);
       if( is_string( $dt_maior)) $dt_maior = date_create( $dt_maior);

       $diff = self::date_diff( $dt_menor, $dt_maior);
       
       switch( $str_interval){
           case "y": 
               $total = $diff->y + $diff->m / 12 + $diff->d / 365.25; break;
           case "m":
               $total= $diff->y * 12 + $diff->m + $diff->d/30 + $diff->h / 24;
               break;
           case "d":
               $total = $diff->y * 365.25 + $diff->m * 30 + $diff->d + $diff->h/24 + $diff->i / 60;
               break;
           case "h": 
               $total = ($diff->y * 365.25 + $diff->m * 30 + $diff->d) * 24 + $diff->h + $diff->i/60;
               break;
           case "i": 
               $total = (($diff->y * 365.25 + $diff->m * 30 + $diff->d) * 24 + $diff->h) * 60 + $diff->i + $diff->s/60;
               break;
           case "s": 
               $total = ((($diff->y * 365.25 + $diff->m * 30 + $diff->d) * 24 + $diff->h) * 60 + $diff->i)*60 + $diff->s;
               break;
          }
       if( $diff->invert)
               return -1 * $total;
       else    return $total;
   }
   
    public static function dateDiff($d1,$d2){
        $date1=strtotime($d1);
        $date2=strtotime($d2);
        $seconds = $date1 - $date2;
        $weeks = floor($seconds/604800);
        $seconds -= $weeks * 604800;
        $days = floor($seconds/86400);
        $seconds -= $days * 86400;
        $hours = floor($seconds/3600);
        $seconds -= $hours * 3600;
        $minutes = floor($seconds/60);
        $seconds -= $minutes * 60;
        $months=round(($date1-$date2) / 60 / 60 / 24 / 30);
        $years=round(($date1-$date2) /(60*60*24*365));
        $diffArr=array("Seconds"=>$seconds,
                      "minutes"=>$minutes,
                      "Hours"=>$hours,
                      "Days"=>$days,
                      "Weeks"=>$weeks,
                      "Months"=>$months,
                      "Years"=>$years
                     ) ;
       return $diffArr;
    }
    
    /* function dateDiffSqlServer 
     * ARGUMENTS 
     *  datepart    -   Abbreviations
     * 
        year        -   yy, yyyy
        quarter     -   qq, q
        month       -   mm, m
        dayofyear   -   dy, y
        day         -   dd, d
        week        -   wk, ww
        hour        -   hh
        minute      -   mi, n
        second      -   ss, s
        millisecond -   ms
        microsecond -   mcs
        nanosecond  -   ns
     * $startdate - Example: $startdate = 2015-09-01 08:09:38.657;
     * $enddate   - Example: $enddate = 2015-09-01 08:09:38.657;
    */
    public static function dateDiffSqlServer($datepart, $startdate, $enddate){
        $query = "SELECT DATEDIFF($datepart, '$startdate', '$enddate') AS result";
        $row = \Yii::$app->db->createCommand($query)->queryOne();
        return $row["result"];
    }
    
    /* function dayConvertEnToPt 
     * ARGUMENTS 
     *  $day string   -   ex.: Thursday (format american)
     * 
     *  return string (day in portuguese); ex.: Quinta-Feira
    */
    public static function dayConvertEnToPt($day){
        return self::$days[$day];
    }
    
    /* function dayConvertEnToPtFromDate 
     * ARGUMENTS 
     *  $date string   -   ex.: 2015-10-29 (format american)
     * 
     *  return string (day in portuguese); ex.: Quinta-Feira
    */
    public static function dayConvertEnToPtFromDate($date){
        $getDate = getdate(strtotime($date));
        $day = $getDate['weekday'];
        return self::$days[$day];
    }
    
    public static function GetDeltaTime($dtTime1, $dtTime2) {
        $nUXDate1 = strtotime($dtTime1->format("Y-m-d H:i:s"));
        $nUXDate2 = strtotime($dtTime2->format("Y-m-d H:i:s"));

        $nUXDelta = $nUXDate1 - $nUXDate2;
        $strDeltaTime = "" . $nUXDelta/60/60; // sec -> hour

        $nPos = strpos($strDeltaTime, ".");
        if ($nPos !== false)
          $strDeltaTime = substr($strDeltaTime, 0, $nPos + 3);

        return $strDeltaTime;
    }
}


//echo "Abaixo somando 1 ano à data atual:<br>";
//echo date('d-m-Y H:i:s', strtotime('+1 year'));
//echo "<br>";
//echo "Abaixo somando 1 mês à data atual:<br>";
//echo date('d-m-Y H:i:s', strtotime('+1 month'));
//echo "<br>";
//echo "Abaixo somando 1 dia à data atual:<br>";
//echo date('d-m-Y H:i:s', strtotime('+1 day'));
//echo "<br>";
//echo "Abaixo somando 1 hora à hora atual:<br>";
//echo date('d-m-Y H:i:s', strtotime('+1 hour'));
//echo "<br>";
//echo "Abaixo somando 1 minuto à hora atual:<br>";
//echo date('d-m-Y H:i:s', strtotime('+1 minute'));
//echo "<br>";
//echo "Abaixo somando 1 segundo à hora atual:<br>";
//echo date('d-m-Y H:i:s', strtotime('+1 second'));
//echo "<br>";
