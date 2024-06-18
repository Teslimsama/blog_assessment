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
        // Ensure the user is authenticated
        $user = auth()->user();

        if (!$user) {
            // Return an appropriate response if the user is not authenticated
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Fetch the blog post by its ID
        $blog = Blog::find($id);

        // Check if the blog post exists
        if (!$blog) {
            // Return an appropriate response if the blog post is not found
            return response()->json(['error' => 'Blog not found'], 404);
        }

        // Create a new comment for the blog post
        $blog->comments()->create([
            'body' => $request->body,
            'user_id' => $user->id
        ]);

        return back()->with('success', 'Comment Inserted Successfully');
    }
}
