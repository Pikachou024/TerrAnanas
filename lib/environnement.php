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
function getPathScript($file,$filename): string
{
    return '<script src="' .getPathPublicAbsolute($file) .'/'.$filename.'.js'.'"></script>';
}

/**
 * @throws Exception
 */
function getPathCSS($file,$filename): string
{
    return  getPathPublicAbsolute($file).'/'.$filename.'.css';
}
function getPathTemplate($file,$template){

    return $_SERVER['DOCUMENT_ROOT'].PATH_TEMPLATES.'/'.$file.'/'.$template.".phtml";
}

function autoloader($className) {
    $paths = [
        "../src/Core/",
        "../src/Model/",
        "../app/",
        "../lib/"
    ];

    foreach ($paths as $path) {
        $file = $path . $className . ".php";
        if (file_exists($file)) {
            include $file;
            return;
        }
    }
}

/*
 * inclusion des Classe
 */
function autoloadController($class_name,$path): void
{
        include '../controllers/'.$path.'/'.ucfirst($class_name) . '.php';
}