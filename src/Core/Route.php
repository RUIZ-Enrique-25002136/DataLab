<?php

namespace App\Core;

final class Route
{
    public function __construct(
        public readonly string $method,
        public readonly string $path,
        public readonly array $handler,
        public readonly ?string $title = null,
    ) {}
    public function isInSitemap(): bool{
        return $this->method === 'GET' && $this->title !== null;
    }
}