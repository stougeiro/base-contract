<?php declare(strict_types=1);

use Sourcerer\Contract\Http\RoutingMiddlewareCollectionInterface;
use STDW\Container\Container;
use STDW\Contract\Http\Router\RouteCollectionInterface;
use Tests\Fixtures\FakeRouteCollection;
use Tests\Fixtures\FakeRoutingMiddlewareCollection;
use Tests\Fixtures\Provider;

test('module provider registers routes through the collection', function () {
    $container = new Container();
    $routes = new FakeRouteCollection();
    $container->singleton(RouteCollectionInterface::class, fn () => $routes);

    $provider = new Provider($container);
    $provider->registerRoutes('/routes/provider.php');

    expect($routes->loaded)->toBe(['/routes/provider.php']);
});

test('module provider registers middlewares through the collection', function () {
    $container = new Container();
    $middlewares = new FakeRoutingMiddlewareCollection();
    $container->singleton(RoutingMiddlewareCollectionInterface::class, fn () => $middlewares);

    $provider = new Provider($container);
    $provider->registerMiddlewares('/middlewares/provider.php');

    expect($middlewares->loaded)->toBe([
        ['module' => Provider::class, 'file' => '/middlewares/provider.php'],
    ]);
});
