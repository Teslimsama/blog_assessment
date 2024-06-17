<?php
namespace App\Http\Filter;
use Illuminate\Http\Request;
use App\Http\Filter\ApiFilter;

class BlogFilter extends ApiFilter
{
    // Allowed Parms
    protected $allowedParms = [
        'title' => ['eq', 'like'],
        'body' => ['like']
    ];


    // Operator Map
    protected $operatorMap = [
        'eq' => '=',
        'neq' => '!=',
        'lt' => '<',
        'gt' => '>',
        'gte' => '>=',
        'like' => 'like',
        'lte' => '<='
    ];




}
