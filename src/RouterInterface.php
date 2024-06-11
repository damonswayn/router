<?php

declare(strict_types=1);

namespace Shruubi\Router;
interface RouterInterface
{
    public function set(string $route, string $response): void;

    public function get(string $route): string;
}