<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Services\HttpResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreBlogCommentRequest;
use App\Http\Resources\BlogCommentResource;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
        $blog = auth()->user()->blogs()->where('id', $id)->first();

        if ($blog === null) {
            return HttpResponse::send([
                'data' => null,
                'message' => 'Blog Not Found',
            ], 404);
        }


        return HttpResponse::send([
            'data' => BlogCommentResource::collection($blog->comments()->get()),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogCommentRequest $request, string $id)
    {
        $blog = auth()->user()->blogs()->where('id', $id)->first();

        if ($blog === null) {
            return HttpResponse::send([
                'data' => null,
                'message' => 'Blog Not Found',
            ], 404);
        }

        $comment = $blog->comments()->create([
            'user_id' => auth()->user()->id,
            'body' => $request->body
        ]);

        return HttpResponse::send([
            'data' => new BlogCommentResource($comment),
            'message' => 'Comment Inserted Successfully'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, string $commentId)
    {


        $blog = auth()->user()->blogs()->where('id', $id)->first();

        if ($blog === null) {
            return HttpResponse::send([
                'data' => null,
                'message' => 'Blog Not Found',
            ], 404);
        }

        $comment = $blog->comments()->where([
            'id' => $commentId
        ])->first();

        if ($comment === null) {
            return HttpResponse::send([
                'data' => null,
                'message' => 'Comment not found'
            ], 404);
        }

        return HttpResponse::send([
            'data' => new BlogCommentResource($comment),
            'message' => ''
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id, string $commentId)
    {
        $blog = auth()->user()->blogs()->where('id', $id)->first();

        if ($blog === null) {
            return HttpResponse::send([
                'data' => null,
                'message' => 'Blog Not Found',
            ], 404);
        }

        $comment = $blog->comments()->where([
            'id' => $commentId
        ])->first();

        if ($comment === null) {
            return HttpResponse::send([
                'data' => null,
                'message' => 'Comment not found'
            ], 404);
        }

        $comment->update([
            'body' => $request->body
        ]);

        return HttpResponse::send([
            'data' => new BlogCommentResource( $comment ),
            'message' => 'Comment Updated Successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, string $commentId)
    {
        $blog = auth()->user()->blogs()->where('id', $id)->first();

        if ($blog === null) {
            return HttpResponse::send([
                'data' => null,
                'message' => 'Blog Not Found',
            ], 404);
        }

        $comment = $blog->comments()->where([
            'id' => $commentId
        ])->first();

        if ($comment === null) {
            return HttpResponse::send([
                'data' => null,
                'message' => 'Comment not found'
            ], 404);
        }

        $comment->delete();

        return HttpResponse::send([
            'data' => null,
            'message' => 'Comment Deleted Successfully'
        ], 201);
    }
}
