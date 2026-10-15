<?php

declare(strict_types=1);

namespace AnixartApi;

final class Response
{
    public function __construct(
        private readonly array $payload,
        private readonly int $status = 200,
    ) {}

    public function send(): never
    {
        http_response_code($this->status);
        header('Content-Type: application/json; charset=utf-8');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, API-Version, Authorization');
        echo json_encode($this->payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        exit;
    }

    public static function json(array $payload, int $status = 200): self
    {
        return new self($payload, $status);
    }

    public static function emptyPage(): self
    {
        return self::json([
            'code' => 0,
            'content' => [],
            'current_page' => 1,
            'total_count' => 0,
            'total_page_count' => 0,
        ]);
    }
}
