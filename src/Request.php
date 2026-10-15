<?php

declare(strict_types=1);

namespace AnixartApi;

final class Request
{
    public function __construct(
        public readonly string $method,
        public readonly string $path,
        public readonly array $query,
        public readonly string $body,
    ) {}

    public static function fromGlobals(): self
    {
        $uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';

        return new self(
            $_SERVER['REQUEST_METHOD'] ?? 'GET',
            rtrim($uri, '/') ?: '/',
            $_GET,
            file_get_contents('php://input') ?: '',
        );
    }
}
