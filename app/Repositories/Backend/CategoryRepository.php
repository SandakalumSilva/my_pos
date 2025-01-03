<?php

namespace App\Repositories\Backend;

use App\Interfaces\Backend\CategoryInterface;
use App\Models\Category;
use Illuminate\Support\Carbon;

class CategoryRepository implements CategoryInterface
{

    public function allCategory()
    {
        $categories = Category::latest()->get();
        return view('backend.category.all_category', compact('categories'));
    }

    public function storeCategory($request)
    {
        Category::create([
            'category_name' => $request->category_name,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => "category Inserted Successfully",
            'alert-type' => 'success'
        );

        return redirect()->route('all.category')->with($notification);
    }

    public function editCategory($id)
    {
        $category = Category::findOrFail($id);
        return  view('backend.category.edit_category', compact('category'));
    }

    public function updateCategory($request)
    {
        $category_id = $request->id;

        Category::findOrFail($category_id)->update([
            'category_name' => $request->category_name,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => "category Updated Successfully",
            'alert-type' => 'success'
        );

        return redirect()->route('all.category')->with($notification);
    }

    public function deleteCategory($id)
    {
        Category::findOrFail($id)->delete();

        $notification = array(
            'message' => "category Deleted Successfully",
            'alert-type' => 'success'
        );

        return redirect()->route('all.category')->with($notification);
    }
}
