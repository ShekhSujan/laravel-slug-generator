<?php

namespace Sujan\LaravelSlugGenerator\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Sujan\LaravelSlugGenerator\SlugGenerator
 */
class SlugGenerator extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'laravel-slug-generator';
    }
}
