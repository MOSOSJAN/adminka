<?php
namespace common\models;
/**
 * Created by PhpStorm.
 * User: Mos
 * Date: 04.06.2015
 * Time: 14:33
 */

class Func{


    public static  function d($params,$flag=1){
        echo "<pre>";
        print_r($params);
        echo "</pre>";
        if($flag){
            exit;
        }
    }

    function getExcerpt($str, $startPos=0, $maxLength=100) {
        if(strlen($str) > $maxLength) {
            $excerpt   = substr($str, $startPos, $maxLength-3);
            $lastSpace = strrpos($excerpt, ' ');
            $excerpt   = substr($excerpt, 0, $lastSpace);
            $excerpt   = strip_tags($excerpt);
            $excerpt  .= '...';
        } else {
            $excerpt = strip_tags($str);
        }

        return $excerpt;
    }
}