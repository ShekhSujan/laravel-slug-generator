<?php

namespace Sujan\LaravelSlugGenerator\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Akash\LaravelUniqueSlug\UniqueSlug
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
