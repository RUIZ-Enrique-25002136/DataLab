<?php

/**
 * @var string $title
 * @var array{id: int, email: string}|null $user
 * @var array<string, array{action: string, title: string, sitemap: bool}> $pages
 * @var string $currentPath
 */

use App\View\Card;
use App\View\Head;
use App\View\ItemList;
use App\View\Layout;
use App\View\Link;

$links = [];
foreach ($pages as $url => $page) {
    $links[] = new Link($page['title'], $url, '');
}

return new Layout($title, $user, [
        new Card([
                new Head('Plan du site'),
                new ItemList($links),
                new Link("Retour a l'accueil", '/', 'btn btn-secondary'),
        ], 'card mentions-card')
], $currentPath);