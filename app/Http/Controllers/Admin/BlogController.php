<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Http\Resources\BlogResource;
use App\Http\Services\BlogService;
use App\Models\Blog;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index()
    {
        return view('admin.blog.index', [
            'blogs' => BlogService::blogWithPagination(auth()->user())
        ]);
    }

    public function create()
    {
        return view('admin.blog.create', [
            'blog' => new Blog()
        ]);
    }

    public function show(Blog $blog)
    {

        return view('admin.blog.show', compact('blog'));
    }


    /**
     * Store Blog
     *
     * @param StoreBlogRequest $request
     * @return void
     */
    public function store(StoreBlogRequest $request)
    {
        $featuredImage = $request->file('featured_image');

        $uploadedFile = Storage::putFile('public/uploads', $featuredImage);


        $blog = auth()->user()->blogs()->create([
            'title' => $request->title,
            'body' => $request->body
        ]);

        $blog->thumbnail()->create(['url' => url( str_replace( 'public', 'storage', $uploadedFile ) )]);

        return redirect()->route('blog.admin.index')
            ->with('success', 'Blog Created Successfully');
    }


    public function edit(Blog $blog)
    {
        return view('admin.blog.edit', compact('blog'));
    }

    public function update( UpdateBlogRequest $request, string $id)
    {
        $blog = auth()->user()->blogs()->where('id', $id)->first();

        $blog->update([
            'title' => $request->title,
            'body' => $request->body
        ]);



        if ($request->has('featured_image') && $request->featured_image !== null) {

            $oldFeaturedImage = ($blog->thumbnail() !== null) ? $blog->thumbnail()->url : null;

            if ($oldFeaturedImage !== null) {
                $oldFeaturedImage = explode('uploads/');
                $oldFeaturedImage = $oldFeaturedImage[1];
                Storage::delete('public/uploads/' . $oldFeaturedImage);
            }

            $featuredImage = $request->file('featured_image');

            $uploadedFile = Storage::putFile('public/uploads', $featuredImage);
            $blog->thumbnail()->create(['url' => url(str_replace('public', 'storage', $uploadedFile))]);
        }



        return redirect()->route('blog.admin.index')
        ->with('success', 'Blog Updated Successfully');
    }

    public function destroy( Blog $blog ) {
        $blog->delete();

        return redirect()->to(route('blog.admin.index'));
    }

}
