<?php

namespace App\View;

final class Paragraph extends Component
{
    public function __construct(
        public array $children = [],
        public string $class = '',
    ){}
    public function render(): string
    {
        $html = '';
        $class = $this->e($this->class);
        $html = $this->renderAll($this->children);
        return '<p>' . $class . $html . '</p>';
    }
}