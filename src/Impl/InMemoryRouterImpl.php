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
        // create a tree of routes
        $tree = $this->data;

        // handle the case where the route is empty
        if ($route === '') {
            $this->data[''] = $response;
            return;
        }

        $routeParts = explode('/', $route);

        // ignore the first empty string
        if ($routeParts[0] === '') {
            array_shift($routeParts);
        }

        // current is our pointer to the current node in the tree
        $current = &$tree;
        foreach ($routeParts as $routePart) {
            if ($routePart === '*') {
                $current['*'] = [];
                $current = &$current['*'];
            } else {
                $current[$routePart] = [];
                $current = &$current[$routePart];
            }
        }

        // because current is just a pointer, set it to response and update the in memory tree
        $current = $response;
        $this->data = $tree;
    }

    public function get(string $route): string
    {
        // handle the case where the route is empty
        if ($route === '') {
            return $this->data[''];
        }

        // ignore the first empty string
        $routeParts = explode('/', $route);
        if ($routeParts[0] === '') {
            array_shift($routeParts);
        }

        $current = $this->data;
        foreach ($routeParts as $routePart) {
            if (array_key_exists($routePart, $current)) {
                $current = $current[$routePart];
            } elseif (array_key_exists('*', $current)) {
                $current = $current['*'];
            } else {
                // if we can't find anything, then return an empty-string
                return '';
            }
        }

        return $current;
    }
}
