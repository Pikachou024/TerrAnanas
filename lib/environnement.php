<?php

function getPathPublicAbsolute($file): string
{
    if(!defined('PATH_ROOT') || !defined('PATH_PUBLIC')){

    }
    return PATH_ROOT . PATH_PUBLIC . '/'. $file;
}

/**
 * @throws Exception
 */
function getPathScript($file,$role,$filename): string
{
    return '<script src="' .getPathPublicAbsolute($file) .'/'.$role.'/'.$filename.'js'.'"></script>';
}

/**
 * @throws Exception
 */
function getPathCSS($file,$filename): string
{
    return  getPathPublicAbsolute($file).'/'.$filename.'.css';
}
function getPathTemplate($file,$template){
//    var_dump($template);
//    return PATH_ROOT.PATH_TEMPLATES.'/'.$file.'/'.$base.".phtml";
    return $_SERVER['DOCUMENT_ROOT'].PATH_TEMPLATES.'/'.$file.'/'.$template.".phtml";
}