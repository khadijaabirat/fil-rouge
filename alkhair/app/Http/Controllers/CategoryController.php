<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
class CategoryController extends Controller
{
   public function index()
    {
        $categories = Category::all();
        return view('admin.categories', compact('categories'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        Category::create([
            'name' => $request->name
        ]);

        return back()->with('success', 'La catégorie a été ajoutée avec succès.');
    }




     public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories_edit', compact('category'));
    }



     public function update(Request $request, $id)
    {
         $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
        ]);

        $category = Category::findOrFail($id);
        $category->update([
            'name' => $request->name
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'La catégorie a été modifiée avec succès.');
    }


    public function destroy($id)
    {
        $category = Category::findOrFail($id);

         if ($category->projects()->count() > 0) {
            return back()->with('error', 'Impossible de supprimer cette catégorie car elle est utilisée par des projets.');
        }

        $category->delete();

        return back()->with('success', 'La catégorie a été supprimée.');
    }
}
