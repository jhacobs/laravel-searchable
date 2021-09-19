<?php

namespace Jhacobs\Searchable;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class WhereLike
{
    public static function register(): void
    {
        Builder::macro('whereLike', function ($attributes, $searchTerm) {
            $this->where(static function (Builder $query) use ($attributes, $searchTerm) {
                foreach (Arr::wrap($attributes) as $attribute) {
                    $query->when(
                      Str::contains($attribute, '.') && count(explode('.', $attribute)) === 3,
                      static function (Builder $query) use ($attribute, $searchTerm) {
                          [$relationName, $relationAttribute, $secondRelationAttribute] = explode('.', $attribute);

                          $query->orWhereHas(
                            $relationName . '.' . $relationAttribute,
                            static function (Builder $query) use ($secondRelationAttribute, $searchTerm) {
                                $query->where($secondRelationAttribute, 'LIKE', "%{$searchTerm}%");
                            }
                          );
                      }
                    );

                    $query->when(
                      Str::contains($attribute, '.') && count(explode('.', $attribute)) === 2,
                      static function (Builder $query) use ($attribute, $searchTerm) {
                          [$relationName, $relationAttribute] = explode('.', $attribute);

                          $query->orWhereHas(
                            $relationName,
                            static function (Builder $query) use ($relationAttribute, $searchTerm) {
                                $query->where($relationAttribute, 'LIKE', "%{$searchTerm}%");
                            }
                          );
                      }
                    );

                    $query->when(
                      ! Str::contains($attribute, '.'),
                      static function (Builder $query) use ($attribute, $searchTerm) {
                          $query->orWhere($attribute, 'LIKE', "%{$searchTerm}%");
                      }
                    );
                }
            });

            return $this;
        });
    }
}
