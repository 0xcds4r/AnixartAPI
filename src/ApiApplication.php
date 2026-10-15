<?php

declare(strict_types=1);

namespace AnixartApi;

require_once __DIR__ . '/Request.php';
require_once __DIR__ . '/Response.php';
require_once __DIR__ . '/Router.php';
require_once __DIR__ . '/ApiController.php';

final class ApiApplication
{
    private readonly Router $router;
    private readonly ApiController $controller;

    public function __construct()
    {
        $this->router = new Router();
        $this->controller = new ApiController();

        $this->registerRoutes();
    }

    public function run(): never
    {
        $request = Request::fromGlobals();

        if ($request->method === 'OPTIONS') {
            Response::json([], 204)->send();
        }

        $this->router->dispatch($request)->send();
    }

    private function registerRoutes(): void
    {
        $c = $this->controller;

        $this->router
            ->post('#^/auth/signIn$#', [$c, 'signIn'])
            ->get('#^/profile/\d+$#', [$c, 'profile'])
            ->get('#^/release/(\d+)$#', [$c, 'release'])
            ->get('#^/episode/target/[^/]+/[^/]+/[^/]+$#', [$c, 'target'])
            ->post('#^/episode/(watch|unwatch)/#', [$c, 'action'])
            ->get('#^/episode/[^/]+$#', [$c, 'types'])
            ->get('#^/episode/[^/]+/[^/]+$#', [$c, 'sources'])
            ->get('#^/episode/[^/]+/[^/]+/[^/]+$#', [$c, 'episodes'])
            ->post('#^/search/releases/\d+$#', [$c, 'search'])
            ->any('#^/discover/#', [$c, 'page'])
            ->any('#^/history/add/[^/]+/[^/]+/[^/]+$#', [$c, 'action'])
            ->any('#^/profile/list/#', [$c, 'page'])
            ->any('#^/favorite/#', [$c, 'page'])
            ->any('#^/history/#', [$c, 'page']);
    }
}
