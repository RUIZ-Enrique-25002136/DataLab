<?php

    namespace App\View;

    class Card extends Component
    {
        public function __construct(
            private readonly array  $children = [],
            private readonly string $class = 'card',
        ){}

        public function render(): string
        {
            $class = $this->e($this->class);
            return '<div class="' . $class . '">'
                . $this->renderAll($this->children)
                . '</div';
        }
    }
