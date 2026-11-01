![PHP](https://img.shields.io/badge/PHP-%20^8.2-777BB4)
![PHPStan-Level](https://img.shields.io/badge/PHPStan-Level%209-224488)
![License](https://img.shields.io/badge/License-MIT-777)

# Base Contract

Contracts and abstract bases shared by modular HTTP runtimes and their modules.
This package defines only the boundaries; it does not provide a kernel, router,
views or transport implementation.

## ✨ Features

- `ModuleProviderInterface` and `ModuleProviderAbstract` for application modules;
- `ControllerInterface` and `ControllerAbstract`, including the standard
  `OPTIONS`/`Allow` behaviour;
- `RoutingMiddlewareCollectionInterface` for module and controller middleware maps;
- `HttpException`, an exception that already carries an HTTP status and headers;
- `ErrorRendererInterface` for application-specific error response rendering;
- `ResultInterface`, `ActionServiceInterface` and `CheckServiceInterface`;
- `LogInterface`.

Concrete kernels, routers, views and transport-specific code belong to each
runtime.

---

## 📦 Installation

Install via Composer:

```bash
composer require stougeiro/base-contract
```

### Requirements

- PHP 8.2 or newer.

---

## 🚀 Usage

This package has no runtime. The snippets below are implementation suggestions;
the runtime is responsible for instantiating providers and dispatching controllers.

### Module provider

```php
use Sourcerer\Contract\Module\ModuleProviderAbstract;

final class BlogModule extends ModuleProviderAbstract
{
    public function configure(): void
    {
        $this->routes(__DIR__ . '/routes.php');
        $this->middlewares(__DIR__ . '/middlewares.php');
    }
}
```

### Controller

```php
use Sourcerer\Contract\Http\ControllerAbstract;
use STDW\Contract\Http\ResponseInterface;

final class HealthController extends ControllerAbstract
{
    /** @var list<string> */
    protected array $allowed = ['get'];

    public function get(): ResponseInterface
    {
        return $this->response->withBody('ok');
    }
}
```

`OPTIONS` is always answered by `ControllerAbstract`, with `204 No Content` and
the `Allow` header. A verb outside `$allowed` raises a `405` `HttpException`.

---

## 🧠 Why?

Modules need to declare routes, controllers and middlewares without depending on
a concrete runtime. Keeping these contracts in a separate package:

- keeps modules dependent only on the boundaries they actually use;
- allows the same module to run on different HTTP runtimes (FPM, Swoole, ...);
- leaves transport, kernel, views and bootstrapping to each runtime;
- avoids circular dependencies between modules, runtimes and applications.

---

## 🤝 Contributions

Contributions are welcome. Feel free to open issues or submit pull requests.

<br>

[<img src="https://cdn.buymeacoffee.com/buttons/v2/default-yellow.png" width="170"/>](https://www.buymeacoffee.com/stougeiro)
