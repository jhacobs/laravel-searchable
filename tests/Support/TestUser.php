<?php

namespace Jhacobs\Searchable\Tests\Support;

use Illuminate\Database\Eloquent\Model;
use Jhacobs\Searchable\Searchable;

class TestUser extends Model
{
    use Searchable;

    protected $guarded = [];

    protected $table = 'test_users';

    protected $searchables = [
        'name',
        'email',
    ];
}
