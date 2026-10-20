<?php
    namespace App\View;
    class Head extends Component
    {
        public function __construct(
            private readonly string $text,
            private readonly int $level = 1,
        ){}

        public function render(): string
        {
            $level = $this->level;
            return "<h{$level}>" . $this->e($this->text) . "</h{$level}>";
        }
    }