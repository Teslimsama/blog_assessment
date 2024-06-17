<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Filter\BlogFilter;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\BlogResource;

class HomeController extends Controller
{
    public function __invoke(Request $request)
    {
        if ($request->has('query')) {
            $q = $request->get('query');

            $blogs = BlogResource::collection(
                Blog::where('title', 'like', '%' . $q)
                    ->orWhere('body', 'like', '%' . $q . '%')->paginate(20)
            );
        } else {
            $blogs = BlogResource::collection(
                Blog::paginate(20)
            );
        }

        return view('home', [
            'blogs' => $blogs
        ]);
    }
}
