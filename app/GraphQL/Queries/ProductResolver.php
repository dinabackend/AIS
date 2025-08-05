<?php
namespace App\GraphQL\Queries;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;

class ProductResolver
{
    public function index($root, array $args)
    {
        $query = Product::query();

        $query->when($args['filter']['categories'], function (Builder $query) use ($args) {
            $query->whereHas('categories', function ($q) use ($args) {
                $q->whereIn('category_id', $args['filter']['categories']);
            });
        });

        // Возвращаем отфильтрованные продукты с отношениями
        return $query->paginate(18);
    }
}
