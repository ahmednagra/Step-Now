<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Page, Service, ServiceCategory, ServiceFeature, ServiceSetting};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\GD\Driver;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return view('admin.service.index', compact('services'));
    }

    public function add()
    {
        $service_categories = ServiceCategory::where('status', 'publish')->get();
        return view('admin.service.add', compact('service_categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'service_category_id' => 'required|exists:service_categories,id',
            'icon' => 'nullable|mimes:jpeg,png,jpg,gif|max:2048',
            'thumbnail' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',

            'banner_image' => 'required|mimes:jpeg,png,jpg,gif|max:2048',
            'order_no' => 'required|integer',
            'status' => 'required|string|in:publish,draft',
            'isfeature' => 'required|in:featured,unfeatured',
            'font_awesome_icon' => 'nullable|string|max:255',
            'service_title' => 'required|string|max:255',
            'service_subtitle' => 'required|string|max:255',

            'banner_title' => 'required|string|max:255',
            'banner_subtitle' => 'required|string|max:255',
            'short_description' => 'required|string',
            'description' => 'required|string',
            'other_description' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_image' => 'nullable|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        DB::beginTransaction();

        // Generate and check slug
        $slug = Str::slug($request->name);
        $originalSlug = $slug;
        $count = 1;
        while (Service::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        $service = new Service();
        $service->name = $request->name;
        $service->slug = $slug;
        $service->service_category_id = $request->service_category_id;
        $service->order_no = $request->order_no;
        $service->status = $request->status;
        $service->isfeature = $request->isfeature;
        $service->font_awesome_icon = $request->font_awesome_icon;
        $service->service_title = $request->service_title;
        $service->service_subtitle = $request->service_subtitle;

        $service->banner_title = $request->banner_title;
        $service->banner_subtitle = $request->banner_subtitle;
        $service->short_description = $request->short_description;

        $service->description = $request->description;

        $service->other_description = $request->other_description;
        $service->meta_title = $request->meta_title;
        $service->meta_keywords = $request->meta_keywords;
        $service->meta_description = $request->meta_description;

        if ($request->hasFile('icon')) {
            $icon = $request->file('icon');
            $iconName = time() . '_icon.' . $icon->getClientOriginalExtension();
            $icon->move(public_path('assets/admin/uploads/service/icon/'), $iconName);
            $service->icon = 'assets/admin/uploads/service/icon/' . $iconName;
        }
        if ($request->hasFile('thumbnail')) {
            $thumb = $request->file('thumbnail');
            $thumbName = time() . '_thumb.' . $thumb->getClientOriginalExtension();
            $thumb->move(public_path('assets/admin/uploads/service/thumbnail/'), $thumbName);
            $service->thumbnail = 'assets/admin/uploads/service/thumbnail/' . $thumbName;
        }

        if ($request->hasFile('banner_image')) {
            $banner = $request->file('banner_image');
            $bannerName = time() . '_banner.' . $banner->getClientOriginalExtension();
            $banner->move(public_path('assets/admin/uploads/service/banner/'), $bannerName);
            $service->banner_image = 'assets/admin/uploads/service/banner/' . $bannerName;
        }

        if ($request->hasFile('meta_image')) {
            $meta = $request->file('meta_image');
            $metaName = time() . '_meta.' . $meta->getClientOriginalExtension();
            $meta->move(public_path('assets/admin/uploads/service/meta/'), $metaName);
            $service->meta_image = 'assets/admin/uploads/service/meta/' . $metaName;
        }

        $service->save();

        DB::commit();

        return redirect()->route('admin.service.index')->with('notification', [
            'message' => 'Service Added Successfully!',
            'alert' => 'success',
        ]);
    }

    public function edit($slug)
    {
        $service = Service::where('slug', $slug)->firstOrFail();

        $service_categories = ServiceCategory::where('status', 'publish')->get();

        return view('admin.service.edit', compact('service', 'service_categories', 'slug'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(rules: [
            'name' => 'required|string|max:255',
            'service_category_id' => 'required|integer|exists:service_categories,id',
            'icon' => 'nullable|mimes:jpeg,png,jpg,gif|max:2048',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'banner_image' => 'nullable|mimes:jpeg,png,jpg,gif|max:2048',
            'order_no' => 'required|integer',
            'status' => 'required|string|in:publish,draft',
            'isfeature' => 'required|in:featured,unfeatured',
            'font_awesome_icon' => 'nullable|string|max:255',
            'service_title' => 'required|string|max:255',
            'service_subtitle' => 'required|string|max:255',
            'banner_title' => 'required|string|max:255',
            'banner_subtitle' => 'required|string|max:255',
            'short_description' => 'required|string',
            'description' => 'required|string',
            'other_description' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_image' => 'nullable|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $service = Service::findOrFail($id);

        DB::beginTransaction();

        if ($service->name !== $request->name) {
            $newSlug = Str::slug($request->name);
            $originalSlug = $newSlug;
            $count = 1;

            while (Service::where('slug', $newSlug)->where('id', '!=', $id)->exists()) {
                $newSlug = $originalSlug . '-' . $count;
                $count++;
            }

            $service->slug = $newSlug;
        }

        $service->name = $request->name;
        $service->service_category_id = $request->service_category_id;
        $service->order_no = $request->order_no;
        $service->status = $request->status;
        $service->isfeature = $request->isfeature;
        $service->font_awesome_icon = $request->font_awesome_icon;
        $service->service_title = $request->service_title;
        $service->service_subtitle = $request->service_subtitle;
        $service->banner_title = $request->banner_title;
        $service->banner_subtitle = $request->banner_subtitle;
        $service->short_description = $request->short_description;
        $service->description = $request->description;
        $service->other_description = $request->other_description;
        $service->meta_title = $request->meta_title;
        $service->meta_keywords = $request->meta_keywords;
        $service->meta_description = $request->meta_description;

        if ($request->hasFile('icon')) {
            if ($service->icon && file_exists(public_path($service->icon))) {
                @unlink(public_path($service->icon));
            }

            $icon = $request->file('icon');
            $iconName = time() . '_icon.' . $icon->getClientOriginalExtension();
            $icon->move(public_path('assets/admin/uploads/service/icon/'), $iconName);
            $service->icon = 'assets/admin/uploads/service/icon/' . $iconName;
        }

        if ($request->hasFile('thumbnail')) {
            if ($service->thumbnail && file_exists(public_path($service->thumbnail))) {
                @unlink(public_path($service->thumbnail));
            }

            $thumb = $request->file('thumbnail');
            $thumbName = time() . '_thumb.' . $thumb->getClientOriginalExtension();
            $thumb->move(public_path('assets/admin/uploads/service/thumbnail/'), $thumbName);
            $service->thumbnail = 'assets/admin/uploads/service/thumbnail/' . $thumbName;
        }

        if ($request->hasFile('banner_image')) {
            if ($service->banner_image && file_exists(public_path($service->banner_image))) {
                @unlink(public_path($service->banner_image));
            }

            $banner = $request->file('banner_image');
            $bannerName = time() . '_banner.' . $banner->getClientOriginalExtension();
            $banner->move(public_path('assets/admin/uploads/service/banner/'), $bannerName);
            $service->banner_image = 'assets/admin/uploads/service/banner/' . $bannerName;
        }

        if ($request->hasFile('meta_image')) {
            if ($service->meta_image && file_exists(public_path($service->meta_image))) {
                @unlink(public_path($service->meta_image));
            }

            $meta = $request->file('meta_image');
            $metaName = time() . '_meta.' . $meta->getClientOriginalExtension();
            $meta->move(public_path('assets/admin/uploads/service/meta/'), $metaName);
            $service->meta_image = 'assets/admin/uploads/service/meta/' . $metaName;
        }

        $service->save();

        DB::commit();

        return redirect()->back()->with('notification', [
            'message' => 'Service Updated Successfully!',
            'alert' => 'success',
        ]);
    }
    public function delete($id)
    {
        $service = Service::findOrFail($id);

        if ($service->serviceSections->count() === 0) {

            if ($service->icon && file_exists(public_path($service->icon))) {
                @unlink(public_path($service->icon));
            }
            if ($service->thumbnail && file_exists(public_path($service->thumbnail))) {
                @unlink(public_path($service->thumbnail));
            }
            if ($service->banner_image && file_exists(public_path($service->banner_image))) {
                @unlink(public_path($service->banner_image));
            }
            if ($service->meta_image && file_exists(public_path($service->meta_image))) {
                @unlink(public_path($service->meta_image));
            }

            $service->delete();

            $notification = [
                'message' => 'Service Deleted Successfully!',
                'alert'   => 'success',
            ];
        } else {
            $notification = [
                'message' => 'First Delete Service Sections!',
                'alert'   => 'warning',
            ];
        }

        return back()->with('notification', $notification);
    }

    public function setting($slug)
    {
        $service = Service::where('slug', $slug)->first();
        $service_sections = ServiceSetting::where('service_id', $service->id)
            ->with('reference')
            ->orderBy('order_no', 'ASC')
            ->get();

        return view('admin.service.partials.setting', compact('service_sections', 'slug'));
    }

    public function updateSetting(Request $request, $slug)
    {
        $service = Service::where('slug', $slug)->firstOrFail();
        $order = $request->input('order', []);

        foreach ($order as $index => $id) {
            ServiceSetting::where('id', $id)
                ->where('service_id', $service->id)
                ->update(['order_no' => $index + 1]);
        }

        return back()->with('notification', [
            'message' => 'Settings updated Successfully!',
            'alert' => 'success',
        ]);
    }
}
