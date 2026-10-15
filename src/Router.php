<?php

declare(strict_types=1);

namespace AnixartApi;

final class Router
{
    /** @var list<array{method:string, pattern:string, handler:callable}> */
    private array $routes = [];

    public function get(string $pattern, callable $handler): self
    {
        return $this->add('GET', $pattern, $handler);
    }

    public function post(string $pattern, callable $handler): self
    {
        return $this->add('POST', $pattern, $handler);
    }

    public function any(string $pattern, callable $handler): self
    {
        return $this->add('*', $pattern, $handler);
    }

    public function dispatch(Request $request): Response
    {
        foreach ($this->routes as $route)
        {
            if ($route['method'] !== '*' && $route['method'] !== $request->method) {
                continue;
            }

            if (preg_match($route['pattern'], $request->path, $matches)) {
                return ($route['handler'])($request, $matches);
            }
        }

        return Response::json(['code' => 0]);
    }

    private function add(string $method, string $pattern, callable $handler): self
    {
        $this->routes[] = compact('method', 'pattern', 'handler');
        return $this;
    }
}
