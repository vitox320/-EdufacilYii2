<?php
 namespace  app\components\util;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class UtilDebug {
    
    public static function preprint($s, $return = false) {
        if($s === NULL || $s === false || $s === true ){
            $code = '<pre>';
            $code .= var_export($s,true);
            $code .= '</pre>';
            if ($return) 
                return $code;
            else
                print $code;
        }else{
            $code = '<pre>';
            $code .= print_r($s, 1);
            $code .= '</pre>';
            if ($return) 
                return $code;
            else
                print $code;
        }
    }
}