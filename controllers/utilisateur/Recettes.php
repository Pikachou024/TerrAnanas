<?php

class Recettes extends AbstractController
{
    function index(){
        $this->params=['title'=>"Nos recettes à base d'ananas !"];
        $this->render($this->file,$this->page,$this->base,$this->params);
    }
}