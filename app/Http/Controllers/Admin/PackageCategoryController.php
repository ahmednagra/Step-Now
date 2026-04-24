<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PackageCategory;
use App\Http\Controllers\Controller;

class PackageCategoryController extends Controller
{
        public function index()
    {
        $categories = PackageCategory::latest()->paginate(10);
        return view('admin.package-category.index', compact('categories'));
    }

    public function add()
    {
        return view('admin.package-category.add');
    }

    // Store new category
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|unique:package_categories,slug',
            'title' => 'required|string',
            'sub_title' => 'nullable|string',
            'description' => 'nullable|string',
            'order_no' => 'required|integer',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:active,inactive',
        ]);

        $category = new PackageCategory();
        $category->name = $request->name;
        $category->slug = $request->slug ?? Str::slug($request->name);
        $category->title = $request->title;
        $category->sub_title = $request->sub_title;
        $category->description = $request->description;
        $category->order_no = $request->order_no;
        $category->status = $request->status;

        if ($request->hasFile('icon')) {

            $file = $request->file('icon');
            $extension = $file->getClientOriginalExtension();
            $icon = time() . rand() . '.' . $extension;
            $file->move('assets/admin/uploads/package-category/icon/', $icon);

            $category->icon = $icon;
        }
        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $image = time() . rand() . '.' . $extension;
            $file->move('assets/admin/uploads/package-category/image/', $image);

            $category->image = $image;
        }

        $category->save();

        return redirect()->route('admin.package-category.index')->with('success', 'Category created successfully.');
    }

    // Show edit form
    public function edit($id)
    {
        $category = PackageCategory::findOrFail($id);
        return view('admin.package-category.edit', compact('category'));
    }

    // Update category
    public function update(Request $request, $id)
    {
        $category = PackageCategory::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|unique:package_categories,slug,' . $category->id,
            'title' => 'required|string',
            'sub_title' => 'nullable|string',
            'description' => 'nullable|string',
            'order_no' => 'required|integer',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:active,inactive',
        ]);

        $category->name = $request->name;
        $category->slug = $request->slug ?? Str::slug($request->name);
        $category->title = $request->title;
        $category->sub_title = $request->sub_title;
        $category->description = $request->description;
        $category->order_no = $request->order_no;
        $category->status = $request->status;

        if ($request->hasFile('icon')) {

            @unlink('assets/admin/uploads/package-category/icon/' . $category->icon);

            $file = $request->file('icon');
            $extension = $file->getClientOriginalExtension();
            $icon = time() . rand() . '.' . $extension;
            $file->move('assets/admin/uploads/package-category/icon/', $icon);

            $category->icon = $icon;
        }


        if ($request->hasFile('image')) {

            @unlink('assets/admin/uploads/package-category/image/' . $category->image);

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $image = time() . rand() . '.' . $extension;
            $file->move('assets/admin/uploads/package-category/image/', $image);

            $category->image = $image;
        }


        $category->save();

        return redirect()->route('admin.package-category.index')->with('success', 'Category updated successfully.');
    }

    // Soft delete
    public function delete($id)
    {
        $category = PackageCategory::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.package-category.index')->with('success', 'Category deleted successfully.');
    }

}
