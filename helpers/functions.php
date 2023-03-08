<?php


use App\App\App;

function asset($resource): string
{
    return App::get('config')['APP_URL'] . '/public/assets/' . $resource;
}

function config($context)
{
    return App::get('config')[$context] ?? null;
}


function redirect(string $endpoint): void
{
    header("Location: /{$endpoint}");
}

function view(string $viewName, $context = []): void
{
    extract($context);
    $filePath = str_replace('.', '/', $viewName);
    require "views/{$filePath}.php";
}

function jsonResponse(array $data): void
{
    header('Content-Type: application/json');

    echo json_encode(
        [
            'status' => http_response_code(),
            'data' => $data
        ]
    );
}

function errorResponse(string $type, string $message): void
{
    header('Content-Type: application/json');
    http_response_code(statusCode($type));
    echo json_encode(
        [
            'status' => statusCode($type),
            'message' => $message
        ]
    );
}

function noContentResponse(): void
{
    header('Content-Type: application/json');
    http_response_code();
}

function statusCode(string $type): int
{
    return match ($type) {
        'validation' => 422,
        'method' => 405,
        'not_found' => 404,
        default => 500,
    };
}