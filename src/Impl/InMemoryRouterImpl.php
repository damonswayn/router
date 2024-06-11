<?php

declare(strict_types=1);

namespace Shruubi\Router\Impl;

use Shruubi\Router\RouterInterface;

class InMemoryRouterImpl implements RouterInterface
{
    private array $data;

    /**
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->data = $data;
    }


    public function set(string $route, string $response): void
    {
        $this->data[$route] = $response;
    }

    public function get(string $route): string
    {
        if (!array_key_exists($route, $this->data)) {
            return '';
        }

        return $this->data[$route];
    }
}