<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceCategoryController extends Controller
{
    public function index()
    {
        $services = ServiceCategory::all();
        return view('admin.service-category.index', compact('services'));
    }

    public function add()
    {
        return view('admin.service-category.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'thumbnail' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'description' => 'required|string',
            'icon' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'order_no' => 'required|integer',
            'status' => 'required|in:publish,draft',
            'isfeature' => 'required|in:featured,unfeatured',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'font_awesome_icon' => 'nullable|string|max:255',
        ]);

        $service = new ServiceCategory();
        $service->title = $request->title;

        // unique slug
        $slug = Str::slug($request->title);
        $count = ServiceCategory::where('slug', $slug)->count();
        $service->slug = $count ? $slug . '-' . time() : $slug;

        $service->description = $request->description;
        $service->order_no = $request->order_no ?? 0;
        $service->status = $request->status;
        $service->isfeature = $request->isfeature;
        $service->meta_title = $request->meta_title;
        $service->meta_description = $request->meta_description;
        $service->font_awesome_icon = $request->font_awesome_icon;

        // handle uploads
        if ($request->hasFile('icon')) {
            $file = $request->file('icon');
            $icon = time() . rand() . '.' . $file->getClientOriginalExtension();
            $file->move('assets/admin/uploads/service_category/', $icon);
            $service->icon = $icon;
        }

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $thumbnail = time() . rand() . '.' . $file->getClientOriginalExtension();
            $file->move('assets/admin/uploads/service_category/', $thumbnail);
            $service->thumbnail = $thumbnail;
        }

        if ($request->hasFile('banner_image')) {
            $file = $request->file('banner_image');
            $image = time() . rand() . '.' . $file->getClientOriginalExtension();
            $file->move('assets/admin/uploads/service_category/', $image);
            $service->banner_image = $image;
        }

        $service->save();

        return redirect()->route('admin.service.category.index')
            ->with('notification', ['message' => 'Service Category Added Successfully!', 'alert' => 'success']);
    }

    public function edit($id)
    {
        $service = ServiceCategory::findOrFail($id);
        return view('admin.service-category.edit', compact('service'));
    }

    public function update(Request $request, $id)
    {
        $service = ServiceCategory::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'description' => 'required|string',
            'icon' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'order_no' => 'required|integer',
            'status' => 'required|in:publish,draft',
            'isfeature' => 'required|in:featured,unfeatured',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'font_awesome_icon' => 'nullable|string|max:255',
        ]);

        $service->title = $request->title;

        // unique slug (ignore current record)
        $slug = Str::slug($request->title);
        $count = ServiceCategory::where('slug', $slug)
            ->where('id', '!=', $id)
            ->count();
        $service->slug = $count ? $slug . '-' . time() : $slug;

        $service->description = $request->description;
        $service->order_no = $request->order_no ?? 0;
        $service->status = $request->status;
        $service->isfeature = $request->isfeature;
        $service->meta_title = $request->meta_title;
        $service->meta_description = $request->meta_description;
        $service->font_awesome_icon = $request->font_awesome_icon;

        // handle uploads
        if ($request->hasFile('icon')) {
            if ($service->icon && file_exists('assets/admin/uploads/service_category/' . $service->icon)) {
                @unlink('assets/admin/uploads/service_category/' . $service->icon);
            }
            $file = $request->file('icon');
            $icon = time() . rand() . '.' . $file->getClientOriginalExtension();
            $file->move('assets/admin/uploads/service_category/', $icon);
            $service->icon = $icon;
        }

        if ($request->hasFile('thumbnail')) {
            if ($service->thumbnail && file_exists('assets/admin/uploads/service_category/' . $service->thumbnail)) {
                @unlink('assets/admin/uploads/service_category/' . $service->thumbnail);
            }
            $file = $request->file('thumbnail');
            $thumbnail = time() . rand() . '.' . $file->getClientOriginalExtension();
            $file->move('assets/admin/uploads/service_category/', $thumbnail);
            $service->thumbnail = $thumbnail;
        }

        if ($request->hasFile('banner_image')) {
            if ($service->banner_image && file_exists('assets/admin/uploads/service_category/' . $service->banner_image)) {
                @unlink('assets/admin/uploads/service_category/' . $service->banner_image);
            }
            $file = $request->file('banner_image');
            $image = time() . rand() . '.' . $file->getClientOriginalExtension();
            $file->move('assets/admin/uploads/service_category/', $image);
            $service->banner_image = $image;
        }

        $service->save();

        return redirect()->route('admin.service.category.index')
            ->with('notification', ['message' => 'Service Category Updated Successfully!', 'alert' => 'success']);
    }

public function delete($id)
{
    $category = ServiceCategory::findOrFail($id);

    if ($category->services->count() === 0) {
        if ($category->icon && file_exists('assets/admin/uploads/service_category/' . $category->icon)) {
            @unlink('assets/admin/uploads/service_category/' . $category->icon);
        }
        if ($category->thumbnail && file_exists('assets/admin/uploads/service_category/' . $category->thumbnail)) {
            @unlink('assets/admin/uploads/service_category/' . $category->thumbnail);
        }
        if ($category->banner_image && file_exists('assets/admin/uploads/service_category/' . $category->banner_image)) {
            @unlink('assets/admin/uploads/service_category/' . $category->banner_image);
        }

        $category->delete();

        $notification = [
            'message' => 'Service Category Deleted Successfully!',
            'alert'   => 'success',
        ];
    } else {
        $notification = [
            'message' => 'First Delete Services of this Category!',
            'alert'   => 'warning',
        ];
    }

    return back()->with('notification', $notification);
}

}
