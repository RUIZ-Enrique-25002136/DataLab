<?php

    namespace App\View;

    class ItemList extends Component
    {
        public function __construct(
            public readonly array $items = [],
        ){}

        public function render(): string
        {
            $html = '';
            foreach ($this->items as $item) {
                $html .= '<li>' . $this.rederAll($item) . '</li>';
            }
            return '<ul>' . $html . '</ul>';
        }
    }