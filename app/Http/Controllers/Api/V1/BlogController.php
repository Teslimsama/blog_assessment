<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Services\HttpResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\BlogResource;
use App\Http\Requests\Api\V1\StoreBlogRequest;
use App\Http\Requests\Api\V1\UpdateBlogRequest;

class BlogController extends Controller
{
    public function index()
    {
        return HttpResponse::send([
            'data' => BlogResource::collection( auth()->user()->blogs()->get() )
        ]);
    }

    public function show(string  $id)
    {
        $blog = auth()->user()->blogs()->where('id', $id)->first();

        if ( $blog === null ) {
            return HttpResponse::send([
                'data' => null,
                'message' => 'Blog Not Found',
            ], 404);
        }
        return HttpResponse::send([
            'data' => new BlogResource( $blog ),
            'message' => ''
        ], 200);
    }

    public function store(StoreBlogRequest $request)
    {
        $blog = auth()->user()->blogs()->create([
            'title' => $request->title,
            'body' => $request->body
        ]);

        $blog->thumbnail()->create([
            'url' => $request->featured_image
        ]);

        return HttpResponse::send([
            'data' => $blog,
            'message' => 'New Blog Post Created'
        ], 202);
    }

    public function destroy(string $id)
    {

        $blog = auth()->user()->blogs()->where('id', $id)->first();

        if ( $blog === null ) {
            return HttpResponse::send([
                'data' => null,
                'message' => 'Blog Not Found',
            ], 404);
        }

        $blog->delete();
        return HttpResponse::send([
            'data' => null,
            'message' => 'Blog Deleted Successfully'
        ], 200);

    }

    public function update(UpdateBlogRequest $request, string $id)
    {

        $blog = auth()->user()->blogs()->where('id', $id)->first();

        if ( $blog === null ) {
            return HttpResponse::send([
                'data' => null,
                'message' => 'Blog Not Found',
            ], 404);
        }

        $blog->update([
            'title' => $request->title ?? $blog->title,
            'body' => $request->body ?? $blog->body
        ]);

        if ( $request->has('featured_image') && $request->featured_image !== null ) {
            $blog->thumbnail()->delete();
            $blog->thumbnail()->create([
                'url' => $request->featured_image
            ]);
        }

        return HttpResponse::send([
            'data' => $blog,
            'message' => 'Blog Updated Successfully'
        ], 202);
    }
}
