<?php

declare(strict_types=1);

namespace App\GraphQL\Queries\Quest;

use App\Models\Quest;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

class QuestQuery extends Query
{
    protected $attributes = [
        'name' => 'quest/Quest',
        'description' => 'A query'
    ];

    public function type(): Type
    {
        return GraphQL::type('Quest');
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
        return Quest::findOrFail($args['id']);
    }
}
