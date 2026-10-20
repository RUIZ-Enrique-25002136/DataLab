<?php

    namespace App\View;

    class Card extends Component
    {
        public function __construct(
            private readonly string $children = [],
            private readonly string $class = 'card',
        ){}

        public function render(): string
        {
            return '<div class="' . $this->e($this->class) . '">'
                . $this->renderAll($this->children)
                . '</div';
        }
    }
