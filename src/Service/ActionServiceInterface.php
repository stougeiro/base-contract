<?php declare(strict_types=1);

namespace Sourcerer\Contract\Service;


interface ActionServiceInterface
{
    /**
     * @param array<string, mixed> $input
     * @return ResultInterface
     */
    public function handle(array $input): ResultInterface;
}
