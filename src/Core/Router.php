<?php
namespace App\Core;
use App\Core\Response;
final class Router
{
    /**
     * @param array $routes    List of [method, path, [Class::class, 'action']]
     * @param array $factories [Class::class => fn() => new Class(...)]
     * @param View  $view      Used to render the 404 page
     */
    public function __construct(
        private RouteCollection $routes,
        private array $factories,
        private View $view,
    ) {}

    /**
     * Trouve la route correspondante, appelle son contrôleur, renvoie la Response.
     */
    public function dispatch(Request $request): Response
    {
        $allowedMethods = [];

        foreach ($this->routes->all() as $route) {
            if ($route->path !== $request->getPath()) {
                continue;
            }
            if($route->method === $request->getMethod()) {
                [$class,$action] = $route->handler;
                $controller = ($this->factories[$class])();
                return $controller->$action($request);
            }
            $allowedMethods[] = $route->method;   // le chemin existe, mais pas pour cette méthode
        }

        if ($allowedMethods !== []) {
            return $this->view
                ->render('405', [
                    'title' => 'Méthode non autorisée',
                    'path'  => $request->getPath(),
                ], 405)
                ->withHeader('Allow', implode(', ', array_unique($allowedMethods)));
        }

        return $this->view->render('404', [
            'title' => 'Page introuvable',
            'path'  => $request->getPath(),
        ], 404);
    }}