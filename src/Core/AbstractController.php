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
        require_once (getPathTemplate($file,$base));
    }

}