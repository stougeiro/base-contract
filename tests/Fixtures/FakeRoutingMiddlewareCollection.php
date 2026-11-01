<?php declare(strict_types=1);

namespace Tests\Fixtures;

use Sourcerer\Contract\Http\RoutingMiddlewareCollectionInterface;


final class FakeRoutingMiddlewareCollection implements RoutingMiddlewareCollectionInterface
{
    /** @var list<array{module: string, file: string}> */
    public array $loaded = [];


    public function load(string $module, string $file): void
    {
        $this->loaded[] = ['module' => $module, 'file' => $file];
    }

    /**
     * @return array<int, \STDW\Contract\Http\MiddlewareInterface>
     */
    public function forController(string $controller): array
    {
        return [];
    }
}
