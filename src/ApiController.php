<?php

declare(strict_types=1);

namespace AnixartApi;

final class ApiController
{
    public function signIn(Request $request, array $matches): Response
    {
        return Response::json([
            'code' => 0,
            'profile' => ['id' => 1, 'login' => 'demo'],
            'profileToken' => ['token' => bin2hex(random_bytes(24))],
        ]);
    }

    public function profile(Request $request, array $matches): Response
    {
        return Response::json(['code' => 0, 'profile' => ['id' => 1, 'login' => 'demo']]);
    }

    public function release(Request $request, array $matches): Response
    {
        return Response::json(['code' => 0, 'release' => ['id' => (int) $matches[1]]]);
    }

    public function types(Request $request, array $matches): Response
    {
        return Response::json(['code' => 0, 'types' => []]);
    }

    public function sources(Request $request, array $matches): Response
    {
        return Response::json(['code' => 0, 'sources' => []]);
    }

    public function episodes(Request $request, array $matches): Response
    {
        return Response::json(['code' => 0, 'episodes' => []]);
    }

    public function target(Request $request, array $matches): Response
    {
        return Response::json(['code' => 0, 'episode' => null]);
    }

    public function action(Request $request, array $matches): Response
    {
        return Response::json(['code' => 0]);
    }

    public function search(Request $request, array $matches): Response
    {
        return Response::json(['code' => 0, 'related' => null, 'releases' => []]);
    }

    public function page(Request $request, array $matches): Response
    {
        return Response::emptyPage();
    }
}
