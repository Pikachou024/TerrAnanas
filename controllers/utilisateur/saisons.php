<?php

class Saisons extends AbstractController
{
    function saisons(){
        $this->params=['title'=>"Calendrier des fruits et légumes"];
        $this->render($this->file,$this->page,$this->base,$this->params);
    }

}