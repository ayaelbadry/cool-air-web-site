<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    //
     public function index()
    {
      // dd('if you arrive here');
     
        $categories = Category::all();
        return view('admin.categories.index',compact('categories'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
 public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => [
            'required',
            Rule::unique('categories')->where(function ($query) use ($request) {
                return $query->where('name', $request->name)
                             ->where('type', $request->type);
            }),
        ],
            'type'=>'required'
        ]);

        $category = Category::create([
            'name' => $request->name,
            'type'=> $request->type,
        ]);

      if ($request->expectsJson()) {
        return response()->json($category);
    }

    return redirect()->route('categories.index');
}


    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:100'
        ]);

        $category = Category::findOrFail($id);
        $category->update([
            'name' => $request->name
        ]);

        return redirect()->route('categories.index');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('categories.index');
    }
}
