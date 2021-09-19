# Laravel searchable

![Packagist Version](https://img.shields.io/packagist/v/jhacobs/laravel-searchable)
![GitHub PHP Workflow](https://github.com/jhacobs/laravel-searchable/actions/workflows/php.yml/badge.svg)

Search through models with laravel searchable


## Installation

You can install the package via composer

```bash
  composer require jhacobs/laravel-searchable
```

## Usage/Examples

### Prepare your models

Add the `Searchable` trait to the model you want to search through.

```php
namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;
use Jhacobs\Searchable\Searchable;

class User extends Model
{
    use Searchable;
}
```

Then add the fields you want to be searchable to the `$searchables` property.

```php
namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;
use Jhacobs\Searchable\Searchable;

class User extends Model
{
    use Searchable;

    protected $searchables = [
        'name',
        'email'
    ];
}
```

### Searching models

You can search through your models by using the search scope.

```php
User::search('Henk')
    ->get();
```
## Running Tests

To run tests, run the following command

```bash
  composer test
```


## License

[MIT](https://choosealicense.com/licenses/mit/)

