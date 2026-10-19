<?php

namespace App\Core;

final class RouteCollection
{
private array $routes = [];
public function get(string $path,array $handler,?string $title =null): self
{
    return $this->addRoute(new Route('GET',$path,$handler,$title));
}
public function post(string $path,array $handler,?string $title =null): self
{
    return $this->addRoute(new Route('POST',$path,$handler,$title));
}
public function addRoute(Route $route): self{
    $this->routes[] = $route;
    return $this;
}
public function all(): array{
    return $this->routes;
}
public function sitemapPages(): array{
    $pages = [];
    foreach ($this->routes as $route){
        if($route->isInSitemap()){
            $pages[$route->path] = ['title'=>$route->title];
        }
    }
    return $pages;
}
}