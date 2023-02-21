<?php

abstract class AbstractController{

    protected string $file;
    protected string $page;
    protected string $base;

    function __construct(string $file, string $page, string $base)
    {
        $this->file = $file;
        $this->page = $page;
        $this->base = $base;
    }

    public function render(string $file, string $page,string $base, array $params): void
    {
        $template = getPathTemplate($file,$page);

        if(!$base){
            require_once $template;
//            echo file_get_contents($template);
        }
        else{
            require_once (getPathTemplate($file,$base));
        }
    }

    public function loadTemplate(string $file, string $page, array $params){
        return file_get_contents(getPathTemplate($file,$page));
    }
}