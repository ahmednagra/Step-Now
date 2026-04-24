<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceFeature;
use App\Models\ServiceFeatureDetail;
use App\Models\ServiceSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceFeatureController extends Controller
{
    public function index($slug)
    {
        $service = Service::where('slug', $slug)->firstOrFail();
        $features = ServiceFeature::where('service_id', $service->id)->get();

        return view('admin.service.partials.feature_list', compact('features', 'slug'));
    }

    public function add($slug)
    {
        return view('admin.service.partials.feature_add', compact('slug'));
    }

    public function store(Request $request, $slug)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'details.*.icon' => 'required|string|max:255',
            'details.*.title' => 'nullable|string|max:255',
            'details.*.description' => 'nullable|string',
        ]);

        DB::beginTransaction();

        $service = Service::where('slug', $slug)->firstOrFail();

        $section = new ServiceFeature;
        $section->service_id = $service->id;
        $section->title = $request->input('title');
        $section->subtitle = $request->input('subtitle');
        $section->description = $request->input('description');

        if ($request->hasFile('image')) {
            $section->image = $this->uploadFile($request->file('image'), 'service_feature');
        }

        $section->save();

        if ($request->has('features')) {
            foreach ($request->features as $feature) {
                $sectionFeature = new ServiceFeatureDetail;
                $sectionFeature->service_feature_id = $section->id;
                $sectionFeature->title = $feature['title'] ?? '';
                $sectionFeature->description = $feature['description'] ?? '';
                if (isset($feature['icon']) && $feature['icon'] instanceof \Illuminate\Http\UploadedFile) {
                    $sectionFeature->icon = $this->uploadFile($feature['icon'], 'feature_details');
                }
                $sectionFeature->save();
            }
        }
        $lastOrder = ServiceSetting::where('service_id', $service->id)->max('order_no');
        $orderNo = $lastOrder ? $lastOrder + 1 : 1;
        ServiceSetting::create([
            'service_id' => $service->id,
            'reference_id' => $section->id,
            'reference_type' => ServiceFeature::class,
            'order_no' => $orderNo,
        ]);
        DB::commit();

        return redirect()->route('admin.service.feature.index', $slug)->with('notification', [
            'message' => 'Service Feature Added Successfully!',
            'alert' => 'success',
        ]);
    }

    public function edit($id)
    {
        $feature = ServiceFeature::with('details')->findOrFail($id);
        $slug = $feature->service->slug;

        return view('admin.service.partials.feature_edit', compact('feature', 'slug'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'details.*.icon' => 'nullable|string|max:255',
            'details.*.title' => 'required|string|max:255',
            'details.*.description' => 'required|string',
        ]);

        $section = ServiceFeature::findOrFail($id);
        $section->title = $request->input('title');
        $section->subtitle = $request->input('subtitle');
        $section->description = $request->input('description');

        if ($request->hasFile('image')) {
            $this->deleteFileIfExists($section->image);
            $section->image = $this->uploadFile($request->file('image'), 'service_feature');
        }

        $section->save();

        if ($request->has('features')) {
            foreach ($request->features as $feature) {
                if (isset($feature['id'])) {
                    $sectionFeature = ServiceFeatureDetail::find($feature['id']);
                    if ($sectionFeature) {
                        $sectionFeature->title = $feature['title'] ?? $sectionFeature->title;
                        $sectionFeature->description = $feature['description'] ?? $sectionFeature->description;

                        if (isset($feature['icon']) && $feature['icon'] instanceof \Illuminate\Http\UploadedFile) {
                            $this->deleteFileIfExists($sectionFeature->icon);
                            $sectionFeature->icon = $this->uploadFile($feature['icon'], 'feature_details');
                        }

                        $sectionFeature->save();
                    }
                } else {
                    $sectionFeature = new ServiceFeatureDetail;
                    $sectionFeature->service_feature_id = $section->id;
                    $sectionFeature->title = $feature['title'] ?? '';
                    $sectionFeature->description = $feature['description'] ?? '';

                    if (isset($feature['icon']) && $feature['icon'] instanceof \Illuminate\Http\UploadedFile) {
                        $sectionFeature->icon = $this->uploadFile($feature['icon'], 'feature_details');
                    }

                    $sectionFeature->save();
                }
            }
        }
        return redirect()->route('admin.service.feature.index', $section->service->slug)->with('notification', [
            'message' => 'Service Feature Updated Successfully!',
            'alert' => 'success',
        ]);
    }

    public function delete($id)
    {
        $section = ServiceFeature::findOrFail($id);

        foreach ($section->details as $detail) {
            $this->deleteFileIfExists($detail->icon);
            $detail->delete();
        }

        $this->deleteFileIfExists($section->image);

        ServiceSetting::where('reference_id', $section->id)
            ->where('reference_type', ServiceFeature::class)
            ->delete();

        $settings = ServiceSetting::where('service_id', $section->service_id)
            ->orderBy('order_no')
            ->get();

        $order = 1;
        foreach ($settings as $setting) {
            $setting->update(['order_no' => $order++]);
        }

        $section->delete();

        return redirect()->back()->with('notification', [
            'message' => 'Service Feature Deleted Successfully!',
            'alert' => 'success',
        ]);
    }

    private function uploadFile($file, $folder)
    {
        $fileName = time().rand().'.'.$file->getClientOriginalExtension();
        $file->move(public_path("assets/admin/uploads/{$folder}/"), $fileName);

        return "assets/admin/uploads/{$folder}/".$fileName;
    }

    private function deleteFileIfExists($filePath)
    {
        if ($filePath && file_exists(public_path($filePath))) {
            unlink(public_path($filePath));
        }
    }
}
