<?php

namespace App\Http\Controllers;

use App\Http\Resources\BlogCommentResource;
use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Resources\BlogResource;

class BlogController extends Controller
{

    public function index()
    {
        // Since this is a simple application we will redirect to the home page where all blog post are showned
        return redirect()->to(route('home'));
    }

    public function show(Blog $blog)
    {

        $nextBlog = Blog::where('id', '>', $blog->id)->first();
        $prevBlog = Blog::where('id', '<', $blog->id)->first();
        return view('blog.show', [
            'blog' => new BlogResource($blog),
            'comments' => BlogCommentResource::collection($blog->comments()->get()),
            'next_blog_id' => ( $nextBlog !== null ) ? $nextBlog->id : null,
            'prev_blog_id' => ( $prevBlog !== null ) ? $prevBlog->id : null,
        ]);
    }
}
