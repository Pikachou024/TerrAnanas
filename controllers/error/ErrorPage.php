<?php

class ErrorPage extends AbstractController
{
    function page404(){
        $params['title']="TerrAnanas - error 404";
        $this->render($this->file, $this->page, $this->base, $params);
    }

    function page403(){
        $params['title']="TerrAnanas - error 403";
        $this->render($this->file, $this->page, $this->base, $params);
    }
}