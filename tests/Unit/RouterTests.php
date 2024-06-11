<?php

declare(strict_types=1);

namespace Shruubi\Router\Tests\Unit;

use JetBrains\PhpStorm\ArrayShape;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Shruubi\Router\Impl\InMemoryRouterImpl;
use Shruubi\Router\RouterInterface;

class RouterTests extends TestCase
{
    private RouterInterface $router;

    protected function setUp(): void
    {
        parent::setUp();
        $this->router = new InMemoryRouterImpl();
    }


    public function testRouterCanBeCreated(): void
    {
        $this->assertNotNull($this->router);
    }

    #[DataProvider('dataProvider')]
    public function testRouter(string $route, string $expectedResponse): void
    {
        $this->router->set($route, $expectedResponse);
        $this->assertEquals($expectedResponse, $this->router->get($route));
    }

    #[DataProvider('dataProvider')]
    public function testRouterWithArrayAccessInterface(string $route, string $expectedResponse): void
    {
        $this->router[$route] = $expectedResponse;
        $this->assertEquals($expectedResponse, $this->router[$route]);
    }

    /**
     * @return array<string, string[]>
     */
    public static function dataProvider(): array
    {
        return [
            'given example case' => [
                '/foo',
                'bar'
            ],
            'basic case' => [
                '/hello',
                'world'
            ],
            'non existent route' => [
                '/does-not-exist',
                ''
            ],
            'empty route' => [
                '',
                '',
            ],
            'wildcard route' => [
                '/foo/*/bar',
                'baz'
            ],
        ];
    }
}
