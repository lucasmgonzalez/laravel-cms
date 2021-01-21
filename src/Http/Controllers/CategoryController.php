<?php
namespace CMS\Http\Controllers;

use CMS\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function all(Request $request)
    {
        $with = $request->has('with') ? $request->get('with') : [];

        return Category::with($with)->all();
    }

    public function retrieve(Request $request, $id)
    {
        $with = $request->has('with') ? $request->get('with') : [];

        return Category::with($with)->find($id);
    }
}