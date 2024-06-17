<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(string $id, StoreCommentRequest $request)
    {

        $blog = auth()->user()->blogs()->where('id', $id)->first();

        $blog->comments()->create([
            'body' => $request->body,
            'user_id' => auth()->user()->id
        ]);
    }
}
