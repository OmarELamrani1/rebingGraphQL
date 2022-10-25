<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations\Quest;

use App\Models\Quest;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

class CreateQuestMutation extends Mutation
{
    protected $attributes = [
        'name' => 'createQuest',
        'description' => 'Creates a quest'
    ];

    public function type(): Type
    {
        return GraphQL::type('Quest');
    }

    public function args(): array
    {
        return [
            'title' => [
                'name' => 'title',
                'type' => Type::nonNull(Type::string()),
            ],

            'description' => [
                'name' => 'description',
                'type' => Type::nonNull(Type::string()),
            ],

            'reward' => [
                'name' => 'reward',
                'type' => Type::nonNull(Type::int()),
            ],

            'category_id' => [
                'name' => 'category_id',
                'type' => Type::nonNull(Type::int()),
                'rules' => ['exists:categories,id']
            ],
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $quest = new Quest();
        $quest->fill($args);
        $quest->save();

        return $quest;
    }
}
