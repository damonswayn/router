<?php

declare(strict_types=1);

namespace Shruubi\Router\Tests\Unit;

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


    public function testXeroRouterCanBeCreated(): void
    {
        $this->assertNotNull($this->router);
    }

    public function testXeroRouterCanSetAResponseForARoute(): void
    {
        $this->router->set('/hello', 'hello world');
        $this->assertEquals('hello world', $this->router->get('/hello'));
    }

    public function testXeroRouterCanSetAResponseForMultipleRoute(): void
    {
        $this->router->set('/hello', 'hello world');
        $this->assertEquals('hello world', $this->router->get('/hello'));

        $this->router->set('/person', 'bob dole');
        $this->assertEquals('bob dole', $this->router->get('/person'));
    }

    /**
     * @return void
     * @test
     */
    public function givenAXeroRouter_WhenIRequestTheRouteSlashFoo_ThenIExpectToGetBarAsAResponse(): void
    {
        $this->router->set('/foo', 'bar');
        $this->assertEquals('bar', $this->router->get('/foo'));
    }
}
