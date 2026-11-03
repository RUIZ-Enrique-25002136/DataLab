<?php

namespace App\View;

class Meta extends Component
{
    public function __construct(
        private readonly String $httpequiv,
        private readonly String $charset,
        private readonly String $name,
        private readonly String $content,
    ){}

    public function render(): String
    {
        $httpequiv = $this->e($this->httpequiv);
        $charset = $this->e($this->charset);
        $name = $this->e($this->name);
        $content = $this->e($this->content);

        return "<meta charset={$charset}" . " http-equiv={$httpequiv}" . " name={$name} content={$content}>";
    }
}