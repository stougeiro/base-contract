<?php declare(strict_types=1);

namespace Tests\Fixtures;

use STDW\Contract\Http\Router\RouteCollectionInterface;


final class FakeRouteCollection implements RouteCollectionInterface
{
    /** @var list<string> */
    public array $loaded = [];


    public function load(string $file): void
    {
        $this->loaded[] = $file;
    }

    public function generate(string $name, array $vars = []): string
    {
        return $name;
    }

    /**
     * @return array<string, mixed>
     */
    public function all(): array
    {
        return [];
    }
}
