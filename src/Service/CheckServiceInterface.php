<?php declare(strict_types=1);

namespace Sourcerer\Contract\Service;


interface CheckServiceInterface
{
    /**
     * @param array<string, mixed> $input
     * @return bool
     */
    public function check(array $input): bool;
}
