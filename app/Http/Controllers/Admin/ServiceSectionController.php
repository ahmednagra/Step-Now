<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceSection;
use App\Models\ServiceSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceSectionController extends Controller
{
    public function index($slug)
    {
        $service = Service::where('slug', $slug)->firstOrFail();
        $sections = ServiceSection::where('service_id', $service->id)->get();

        return view('admin.service.partials.service_section_list', compact('sections', 'slug'));
    }

    public function add($slug)
    {
        return view('admin.service.partials.service_section_add', compact('slug'));
    }

    public function store(Request $request, $slug)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'subtitle'    => 'required|string|max:255',
            'type'        => 'required|in:L-2-R,R-2-L',
            'description' => 'required|string',
            'image'       => 'required|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        DB::beginTransaction();

        $service = Service::where('slug', $slug)->firstOrFail();
        $section = new ServiceSection();
        $section->service_id   = $service->id;
        $section->title       = $request->title;
        $section->subtitle    = $request->subtitle;
        $section->description = $request->description;
        $section->type        = $request->type;

        // Handle Image Upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = time() . rand() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/admin/uploads/ServiceSection/thumb/'), $imageName);
            $section->image = 'assets/admin/uploads/ServiceSection/thumb/' . $imageName;
        }

        $section->save();

        $lastOrder = ServiceSetting::where('service_id', $service->id)->max('order_no');
        $orderNo   = $lastOrder ? $lastOrder + 1 : 1;

        ServiceSetting::create([
            'service_id'      => $service->id,
            'reference_id'   => $section->id,
            'reference_type' => ServiceSection::class,
            'order_no'       => $orderNo,
        ]);

        DB::commit();

        return redirect()->route('admin.service.section.index', $slug)
            ->with('notification', [
                'message' => 'Service Section Added Successfully!',
                'alert'   => 'success',
            ]);
    }

    public function edit($id)
    {
        $section = ServiceSection::findOrFail($id);
        $slug    = $section->service->slug;

        return view('admin.service.partials.service_section_edit', compact('section', 'slug'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'subtitle'    => 'required|string|max:255',
            'image'       => 'nullable|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'type'        => 'required|in:L-2-R,R-2-L',
            'description' => 'required|string',
        ]);

        DB::beginTransaction();

        $section = ServiceSection::findOrFail($id);
        $section->title       = $request->title;
        $section->subtitle    = $request->subtitle;
        $section->description = $request->description;
        $section->type        = $request->type;

        // Handle new image upload
        if ($request->hasFile('image')) {
            if ($section->image && file_exists(public_path($section->image))) {
                unlink(public_path($section->image));
            }

            $file = $request->file('image');
            $imageName = time() . rand() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/admin/uploads/ServiceSection/thumb/'), $imageName);
            $section->image = 'assets/admin/uploads/ServiceSection/thumb/' . $imageName;
        }

        $section->save();

        DB::commit();

        return redirect()->route('admin.service.section.index', $section->service->slug)
            ->with('notification', [
                'message' => 'Service Section Updated Successfully!',
                'alert'   => 'success',
            ]);
    }

    public function delete($id)
    {
        DB::beginTransaction();

        $section = ServiceSection::findOrFail($id);

        if ($section->image && file_exists(public_path($section->image))) {
            unlink(public_path($section->image));
        }

        $section->delete();

        ServiceSetting::where('reference_id', $section->id)
            ->where('reference_type', ServiceSection::class)
            ->delete();

        $settings = ServiceSetting::where('service_id', $section->service_id)
            ->orderBy('order_no')
            ->get();

        $order = 1;
        foreach ($settings as $setting) {
            $setting->update(['order_no' => $order++]);
        }

        DB::commit();

        return back()->with('notification', [
            'message' => 'Service Section Deleted Successfully!',
            'alert'   => 'success',
        ]);
    }
}
