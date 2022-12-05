# Laravel-slug-generator

Laravel Slug Generator with Multi Language Support.

---

## Installation

```sh
composer require sujan97825/laravel-slug-generator
```

## Configuration

**Service Provider Registration**
In `config/app.php`, add in `providers` array -

```php
'providers' => [
    // ...
    Sujan\\LaravelSlugGenerator\\SlugGeneratorServiceProvider::class,
    // ...
],
```

**Facade Class Alias**
Add in aliases array -

```php
'aliases' => Facade::defaultAliases()->merge([
    // ...
    'SlugGenerator' => Sujan\LaravelSlugGenerator\Facades\SlugGenerator::class,
    // ...
])->toArray(),
```

## Use from Controller

#### Import first the SlugGenerator facade

```php
use Sujan\LaravelSlugGenerator\Facades\SlugGenerator;
```

### Example #01- Post unique slug from title

Let's assume, we have in `Post` class, we've added `slug` column which is unique. Now, if we passed `title` and generate `slug` from that, then -

```php
use App\Models\Post;

// First time create post with title
SlugGenerator::uniqueSlug(Post::class, 'সম্পন্ন !#$%$%^ হল বঙ্গবন্ধু&**( টানেলের //? প্রথম টিউবের )()(**@%$^&*( কাজ  ', 'slug');
// Output: সম্পন্ন-হল-বঙ্গবন্ধু-টানেলের-প্রথম-টিউবের-কাজ

// Second time create post with title
SlugGenerator::uniqueSlug(Post::class, 'সম্পন্ন !#$%$%^ হল বঙ্গবন্ধু&**( টানেলের //? প্রথম টিউবের )()(**@%$^&*( কাজ  ', 'slug');
// Output: সম্পন্ন-হল-বঙ্গবন্ধু-টানেলের-প্রথম-টিউবের-কাজ-1

// Third time create post with title
SlugGenerator::uniqueSlug(Post::class, 'সম্পন্ন !#$%$%^ হল বঙ্গবন্ধু&**( টানেলের //? প্রথম টিউবের )()(**@%$^&*( কাজ  ', 'slug');
// Output: সম্পন্ন-হল-বঙ্গবন্ধু-টানেলের-প্রথম-টিউবের-কাজ-2
```

### Example #02 - Post general slug from title / Not Unique

```php
// First time create post with title
SlugGenerator::generalSlug('সম্পন্ন !#$%$%^ হল বঙ্গবন্ধু&**( টানেলের //? প্রথম টিউবের )()(**@%$^&*( কাজ  ');
// Output: সম্পন্ন-হল-বঙ্গবন্ধু-টানেলের-প্রথম-টিউবের-কাজ

// Second time create post with title
SlugGenerator::generalSlug('সম্পন্ন !#$%$%^ হল বঙ্গবন্ধু&**( টানেলের //? প্রথম টিউবের )()(**@%$^&*( কাজ  ');
// Output: সম্পন্ন-হল-বঙ্গবন্ধু-টানেলের-প্রথম-টিউবের-কাজ

```

## API Docs

### Generate method -

```php
SlugGenerator::uniqueSlug($model, $value, $field, $separator);
SlugGenerator::generalSlug($value,$separator);
```

```php
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
public function uniqueSlug(
    $model,
    $value,
    $field,
    $separator = null
): string
```

```php
/**
 * Generate a general Slug.
 *
 * @param string $value
 * @param string $separator
 *
 * @return string
 */
public function generalSlug(
    $value,
    $separator = null
): string

```
#### Publish configuration
```sh
php artisan vendor:publish --provider="Sujan\LaravelSlugGenerator\SlugGeneratorServiceProvider"
```

#### Configurations

```php
return [
    /*
    |--------------------------------------------------------------------------
    | Slug default separator.
    |--------------------------------------------------------------------------
    |
    | If no separator is passed, then this default separator will be used as slug.
    |
    */
    'separator' => '-',

    /*
    |--------------------------------------------------------------------------
    | Slug max count limit
    |--------------------------------------------------------------------------
    |
    | Default 100, slug will generated like
    | test-1, test-2, test-3 .... test-100
    |
    */
    'max_count' => 100,
];


```
### Similar Package & Inspired from
```php
https://github.com/ManiruzzamanAkash/laravel-unique-slug-generator

```

## Contribution

You're open to create any Pull request.
