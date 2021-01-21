<?php
namespace CMS\Http\Controllers;

use CMS\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function all(Request $request)
    {
        $with = $request->has('with') ? $request->get('with') : [];

        return Post::with($with)->all();
    }

    public function retrieve(Request $request, $id)
    {
        $with = array_merge($request->has('with') ? $request->get('with') : [], ['blocks']);

        return Post::with($with)->find($id);
    }
}