<?php declare(strict_types=1);

namespace Sourcerer\Contract\Http;

use Sourcerer\Contract\Module\ModuleProviderInterface;

use STDW\Contract\Http\MiddlewareInterface;


/**
 * Middlewares of the application by module scope: the module level ('*') and
 * the controller level (the exact controller key), declared by each module in
 * its own middleware map.
 */
interface RoutingMiddlewareCollectionInterface
{
    /**
     * Registers the middleware map of a module.
     *
     * The map keys are '*' (the whole module) or a controller FQCN of the
     * module; the values are lists of middleware classes.
     *
     * @param class-string<ModuleProviderInterface> $module The module provider class.
     * @param string $file The file returning the map.
     * @return void
     */
    public function load(string $module, string $file): void;

    /**
     * The module and controller level middlewares of a controller, ready to
     * run: the module ones ('*') come before the controller ones.
     *
     * @param string $controller
     * @return array<int, MiddlewareInterface>
     */
    public function forController(string $controller): array;
}
