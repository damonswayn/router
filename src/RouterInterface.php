<?php

declare(strict_types=1);

namespace Shruubi\Router;
use ArrayAccess;

/**
 * Interface RouterInterface
 * @package Shruubi\Router
 * @implements ArrayAccess<string, string>
 */
interface RouterInterface extends ArrayAccess
{
    public function set(string $route, string $response): void;

    public function get(string $route): string;
}