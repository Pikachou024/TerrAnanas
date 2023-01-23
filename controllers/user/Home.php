<?php

class Home extends AbstractController
{

    function index(){
        $params['title']="TerrAnanas - Fournisseur de fruit et legumes";
        $this->render($this->file,$this->page,$this->base,$params);
    }

}