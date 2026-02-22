<?php

namespace App\Utils;

/**
 * @template T
 * @template E
 */
class Result
{
    /**
     * @param T|null $value
     * @param E|null $error
     */
    private function __construct(
        private readonly bool $success,
        private readonly mixed $value,
        private readonly mixed $error,
    ) {}

    /**
     * @template T
     * @param T $value
     * @return self<T, never>
     */
    public static function ok(mixed $value): self
    {
        return new self(true, $value, null);
    }

    /**
     * @template E
     * @param E $error
     * @return self<never, E>
     */
    public static function err(mixed $error): self
    {
        return new self(false, null, $error);
    }

    public function isOk(): bool
    {
        return $this->success;
    }

    public function isErr(): bool
    {
        return !$this->success;
    }

    /**
     * @return T
     */
    public function unwrap(): mixed
    {
        return $this->value;
    }

    /**
     * @return E
     */
    public function unwrapErr(): mixed
    {
        return $this->error;
    }
}
