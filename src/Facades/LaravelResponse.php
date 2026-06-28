<?php

namespace Fbpkg\LaravelResponse\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Fbpkg\LaravelResponse\LaravelResponse success(string $message = 'OK', int $status = 200)
 * @method static \Fbpkg\LaravelResponse\LaravelResponse error(string $message = 'Error', int $status = 500)
 * @method static \Fbpkg\LaravelResponse\LaravelResponse data(mixed $data)
 * @method static \Fbpkg\LaravelResponse\LaravelResponse errors(array $errors)
 * @method static \Fbpkg\LaravelResponse\LaravelResponse validation(\Illuminate\Validation\Validator $validator)
 * @method static \Fbpkg\LaravelResponse\LaravelResponse alert(string $type, ?string $message = null)
 * @method static \Illuminate\Http\JsonResponse send()
 *
 * @see \Fbpkg\LaravelResponse\LaravelResponse
 */
class LaravelResponse extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'laravel-response';
    }
}