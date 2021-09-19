<?php

namespace Jhacobs\Searchable\Tests;

use Jhacobs\Searchable\Tests\Support\TestUser;

class SearchableTest extends TestCase
{
    /** @test */
    public function it_could_search_for_specific_rows_in_a_model(): void
    {
        TestUser::create([
            'name' => 'Test',
            'email' => 'janjansen@example.com',
        ]);

        TestUser::create([
            'name' => 'Henk',
            'email' => 'henk@example.com',
        ]);

        $results = TestUser::search('Henk')->get();

        self::assertSame('Henk', $results->first()->name);
        self::assertSame('henk@example.com', $results->first()->email);
        self::assertSame(1, $results->count());
    }

    /** @test */
    public function it_could_not_search_for_attributes_that_are_not_in_the_searchables_of_the_model(): void
    {
        TestUser::create([
            'name' => 'Test',
            'email' => 'janjansen@example.com',
            'password' => 'password',
        ]);

        TestUser::create([
            'name' => 'Henk',
            'email' => 'henk@example.com',
            'password' => 'test',
        ]);

        $results = TestUser::search('password')->get();

        self::assertSame(0, $results->count());
    }
}
