<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceBlock;
use App\Models\ServiceBlockFeature;
use App\Models\ServiceSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceBlockController extends Controller
{
    public function index($slug)
    {
        $service = Service::where('slug', $slug)->firstOrFail();
        $blocks = ServiceBlock::where('service_id', $service->id)->with('features')->get();

        return view('admin.service.partials.block_list', compact('blocks', 'slug'));
    }

    public function add($slug)
    {
        return view('admin.service.partials.block_add', compact('slug'));
    }

    public function store(Request $request, $slug)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'type' => 'required|in:L-2-R,R-2-L',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:2048',
            'features.*.title' => 'nullable|string',
            'features.*.order_no' => 'nullable|integer',
        ]);

        DB::beginTransaction();
        $service = Service::where('slug', $slug)->firstOrFail();

        $block = new ServiceBlock();
        $block->title = $request->title;
        $block->subtitle = $request->subtitle;
        $block->description = $request->description;
        $block->type = $request->type;
        $block->service_id = $service->id;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = time() . rand() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/admin/uploads/service/block/thumb/'), $imageName);
            $block->image = 'assets/admin/uploads/service/block/thumb/' . $imageName;
        }

        if ($request->hasFile('icon')) {
            $file = $request->file('icon');
            $iconName = time() . rand() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/admin/uploads/service/block/icons/'), $iconName);
            $block->icon = 'assets/admin/uploads/service/block/icons/' . $iconName;
        }

        $block->save();

        if ($request->has('features')) {
            foreach ($request->input('features') as $feature) {
                $blockFeature = new ServiceBlockFeature();
                $blockFeature->service_block_id = $block->id;
                $blockFeature->title = $feature['title'] ?? '';
                $blockFeature->order_no = $feature['order'] ?? 0;
                $blockFeature->save();
            }
        }

        // Optional ServiceSetting (if you have ordering like BlogSetting)
        if (class_exists(ServiceSetting::class)) {
            $lastOrder = ServiceSetting::where('service_id', $service->id)->max('order_no');
            $orderNo = $lastOrder ? $lastOrder + 1 : 1;

            ServiceSetting::create([
                'service_id' => $service->id,
                'reference_id' => $block->id,
                'reference_type' => ServiceBlock::class,
                'order_no' => $orderNo,
            ]);
        }

        DB::commit();

        return redirect()->route('admin.service.block.index', $service->slug)->with('notification', [
            'message' => 'Service Block Added Successfully!',
            'alert' => 'success',
        ]);
    }

    public function edit($id)
    {
        $block = ServiceBlock::with('features')->findOrFail($id);
        $slug = $block->service->slug;

        return view('admin.service.partials.block_edit', compact('block', 'slug'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'type' => 'required|in:L-2-R,R-2-L',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:2048',
            'features.*.title' => 'nullable|string',
            'features.*.order_no' => 'nullable|integer',
        ]);

        $block = ServiceBlock::findOrFail($id);
        $block->title = $request->title;
        $block->subtitle = $request->subtitle;
        $block->description = $request->description;
        $block->type = $request->type;

        if ($request->hasFile('image')) {
            if ($block->image && file_exists(public_path($block->image))) {
                unlink(public_path($block->image));
            }

            $file = $request->file('image');
            $imageName = time() . rand() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/admin/uploads/service/block/thumb/'), $imageName);
            $block->image = 'assets/admin/uploads/service/block/thumb/' . $imageName;
        }

        if ($request->hasFile('icon')) {
            if ($block->icon && file_exists(public_path($block->icon))) {
                unlink(public_path($block->icon));
            }

            $file = $request->file('icon');
            $iconName = time() . rand() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/admin/uploads/service/block/icons/'), $iconName);
            $block->icon = 'assets/admin/uploads/service/block/icons/' . $iconName;
        }

        $block->save();

        // Replace existing features
        $block->features()->delete();
        if ($request->has('features')) {
            foreach ($request->input('features') as $featureData) {
                $feature = new ServiceBlockFeature();
                $feature->service_block_id = $block->id;
                $feature->title = $featureData['title'] ?? '';
                $feature->order_no = $featureData['order'] ?? 0;
                $feature->save();
            }
        }

        return redirect()->route('admin.service.block.index', $block->service->slug)->with('notification', [
            'message' => 'Service Block Updated Successfully!',
            'alert' => 'success',
        ]);
    }

    public function delete($id)
    {
        DB::beginTransaction();
        $block = ServiceBlock::findOrFail($id);
        $block->features()->delete();

        if ($block->image && file_exists(public_path($block->image))) {
            unlink(public_path($block->image));
        }

        if ($block->icon && file_exists(public_path($block->icon))) {
            unlink(public_path($block->icon));
        }

        $block->delete();

        if (class_exists(ServiceSetting::class)) {
            ServiceSetting::where('reference_id', $block->id)
                ->where('reference_type', ServiceBlock::class)
                ->delete();

            $settings = ServiceSetting::where('service_id', $block->service_id)
                ->orderBy('order_no')
                ->get();

            $order = 1;
            foreach ($settings as $setting) {
                $setting->update(['order_no' => $order++]);
            }
        }

        DB::commit();

        return redirect()->back()->with('notification', [
            'message' => 'Service Block Deleted Successfully!',
            'alert' => 'success',
        ]);
    }
}
