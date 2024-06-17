<?php

namespace App\Http\Services;

use App\Models\User;
use App\Http\Resources\BlogResource;
use App\Models\Blog;

class BlogService
{
    public static function blogWithPagination(User|null $user = null, $limit = 20)
    {
        $blogs = ( $user !== null ) ? $user->blogs() : new Blog();
        return BlogResource::collection( $blogs->paginate($limit) )->toJson();
    }
}
