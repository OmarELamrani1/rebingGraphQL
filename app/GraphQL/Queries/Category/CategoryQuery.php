<?php

declare(strict_types=1);

namespace App\GraphQL\Queries\Category;

use App\Models\Category;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

class CategoryQuery extends Query
{
    protected $attributes = [
        'name' => 'category',
        // 'name' => 'category/Category',
        // 'description' => 'A query'
    ];

    public function type(): Type
    {
        return GraphQL::type('Category');
        // return Type::listOf(Type::string());
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::int(),
                'rules' => ['required']
            ]
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        return Category::findOrFail($args['id']);

        /** @var SelectFields $fields */
        // $fields = $getSelectFields();
        // $select = $fields->getSelect();
        // $with = $fields->getRelations();

        // return [
            // 'The category/Category works',
        // ];
    }
}
