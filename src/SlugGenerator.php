<?php

namespace Sujan\LaravelSlugGenerator;

class SlugGenerator
{
    /**
     * Generate a Unique Slug.
     *
     * @param object $model
     * @param string $value
     * @param string $field
     * @param string $separator
     *
     * @return string
     * @throws \Exception
     */
    public function uniqueSlug($model, $value, $field, $separator = null): string
    {
        $separator = empty($separator) ? config('laravel-slug-generator.separator') : $separator;
        $id = 0;

        $slug = preg_replace("/[~`{}.'\"\!\@\#\$\%\^\&\*\(\)\_\=\+\/\?\>\<\,\[\]\:\;\|\\\]/", '', $value);
        $slug = strtolower(trim(preg_replace("/[\/_|+ -]+/", $separator, $slug), $separator));

        // Get any that could possibly be related.
        // This cuts the queries down by doing it once.
        $allSlugs = $this->getRelatedSlugs($slug, $id, $model, $field);

        // If we haven't used it before then we are all good.
        if (!$allSlugs->contains("$field", $slug)) {
            return $slug;
        }

        // Just append numbers like a savage until we find not used.
        for ($i = 1; $i <= config('laravel-slug-generator.max_count'); $i++) {
            $newSlug = $slug . $separator . $i;
            if (!$allSlugs->contains("$field", $newSlug)) {
                return $newSlug;
            }
        }

        throw new \Exception('Can not create a unique slug');
    }
    public function generalSlug($value, $separator = null): string
    {
        $separator = empty($separator) ? config('laravel-slug-generator.separator') : $separator;

        $slug = preg_replace("/[~`{}.'\"\!\@\#\$\%\^\&\*\(\)\_\=\+\/\?\>\<\,\[\]\:\;\|\\\]/", '', $value);
        $slug = strtolower(trim(preg_replace("/[\/_|+ -]+/", $separator, $slug), $separator));
        if ($slug) {
            return $slug;
        }
        throw new \Exception('Can not create a slug');
    }

    private function getRelatedSlugs($slug, $id, $model, $field)
    {
        if (empty($id)) {
            $id = 0;
        }

        return $model::select("$field")
            ->where("$field", 'like', $slug . '%')
            ->where('id', '<>', $id)
            ->get();
    }
}
