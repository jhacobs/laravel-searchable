<?php

namespace Jhacobs\Searchable;

use Illuminate\Database\Eloquent\Builder;

trait Searchable
{
    public function scopeSearch(Builder $query, ?string $field): Builder
    {
        return $query->when($field, function (Builder $query, string $field) {
            return $query->whereLike($this->getSearchables(), $field);
        });
    }

    protected function getSearchables(): array
    {
        return $this->searchables ?? [];
    }
}
