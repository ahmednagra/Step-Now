<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceElement;
use App\Models\ServiceElementFeature;
use App\Models\Service;
use App\Models\ServiceSetting;
use Illuminate\Http\Request;

class ServiceElementController extends Controller
{
    public function index($slug)
    {
        $service = Service::where('slug', $slug)->first();
        $elements = ServiceElement::where('service_id', $service->id)->get();

        return view('admin.service.partials.element_list', compact('elements', 'slug'));
    }

    public function add($slug)
    {
        return view('admin.service.partials.element_add', compact('slug'));
    }

    public function store(Request $request, $slug)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:2048',
            'features.*.title' => 'nullable|string',
            'features.*.description' => 'nullable|string',
            'features.*.order_no' => 'nullable|integer',
        ]);

        $service = Service::where('slug', $slug)->first();
        $element = new ServiceElement();

        // Direct assignment, no translations
        $element->title = $request->input('title');
        $element->subtitle = $request->input('subtitle');
        $element->description = $request->input('description');
        $element->service_id = $service->id;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = time() . rand() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/admin/uploads/element/thumb/'), $imageName);
            $element->image = 'assets/admin/uploads/element/thumb/' . $imageName;
        }

        if ($request->hasFile('icon')) {
            $file = $request->file('icon');
            $iconName = time() . rand() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/admin/uploads/element/icons/'), $iconName);
            $element->icon = 'assets/admin/uploads/element/icons/' . $iconName;
        }

        $element->save();

        if ($request->has('features')) {
            foreach ($request->input('features') as $feature) {
                $elementFeature = new ServiceElementFeature();
                $elementFeature->service_element_id = $element->id;
                $elementFeature->title = $feature['title'] ?? '';
                $elementFeature->description = $feature['description'] ?? '';
                $elementFeature->order_no = $feature['order'] ?? 0;
                $elementFeature->save();
            }
        }

        $lastOrder = ServiceSetting::where('service_id', $service->id)->max('order_no');
        $orderNo   = $lastOrder ? $lastOrder + 1 : 1;

        ServiceSetting::create([
            'service_id'      => $service->id,
            'reference_id'   => $element->id,
            'reference_type' => ServiceElement::class,
            'order_no'       => $orderNo,
        ]);

        return redirect()->route('admin.service.element.index', $slug)->with('notification', [
            'message' => 'Service ServiceElement Added Successfully!',
            'alert' => 'success',
        ]);
    }

    public function edit($id)
    {
        $element = ServiceElement::with('features')->findOrFail($id);
        $slug = $element->service->slug;
        return view('admin.service.partials.element_edit', compact('element', 'slug'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:2048',
            'features.*.id' => 'nullable|integer|exists:element_features,id',
            'features.*.title' => 'nullable|string',
            'features.*.description' => 'nullable|string',
            'features.*.order_no' => 'nullable|integer',
        ]);

        $element = ServiceElement::findOrFail($id);
        $element->title = $validated['title'];
        $element->subtitle = $validated['subtitle'];
        $element->description = $validated['description'];

        if ($request->hasFile('image')) {
            $this->deleteFileIfExists($element->image);
            $element->image = $this->uploadFile($request->file('image'), 'element/thumb');
        }

        if ($request->hasFile('icon')) {
            $this->deleteFileIfExists($element->icon);
            $element->icon = $this->uploadFile($request->file('icon'), 'element/icons');
        }

        $this->updateFeatures($request->input('features'), $element);
        $element->save();

        return redirect()->route('admin.service.element.index', $element->service->slug)->with('notification', [
            'message' => 'Service ServiceElement Updated Successfully!',
            'alert' => 'success',
        ]);
    }

    private function uploadFile($file, $folder)
    {
        $fileName = time() . rand() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path("assets/admin/uploads/{$folder}/"), $fileName);
        return "assets/admin/uploads/{$folder}/" . $fileName;
    }

    private function deleteFileIfExists($filePath)
    {
        if ($filePath && file_exists(public_path($filePath))) {
            unlink(public_path($filePath));
        }
    }

    private function updateFeatures($features, $element)
    {
        if ($features) {
            $existingFeatureIds = $element->features->pluck('id')->toArray();

            foreach ($features as $featureData) {
                if (isset($featureData['id']) && $featureData['id']) {
                    $feature = ServiceElementFeature::find($featureData['id']);

                    if ($feature) {
                        $feature->title = $featureData['title'] ?? '';
                        $feature->description = $featureData['description'] ?? '';
                        $feature->order_no = $featureData['order'] ?? 0;
                        $feature->save();
                    }

                    $existingFeatureIds = array_diff($existingFeatureIds, [$featureData['id']]);
                } else {
                    $feature = new ServiceElementFeature(['service_element_id' => $element->id]);
                    $feature->title = $featureData['title'] ?? '';
                    $feature->description = $featureData['description'] ?? '';
                    $feature->order_no = $featureData['order'] ?? 0;
                    $feature->save();
                }
            }

            ServiceElementFeature::whereIn('id', $existingFeatureIds)->delete();
        }
    }

    public function delete($id)
    {
        $element = ServiceElement::findOrFail($id);

        $element->features()->delete();

        if ($element->image && file_exists(public_path($element->image))) {
            unlink(public_path($element->image));
        }

        if ($element->icon && file_exists(public_path($element->icon))) {
            unlink(public_path($element->icon));
        }
        ServiceSetting::where('reference_id', $element->id)
            ->where('reference_type', ServiceElement::class)
            ->delete();

        $settings = ServiceSetting::where('service_id', $element->service_id)
            ->orderBy('order_no')
            ->get();

        $order = 1;
        foreach ($settings as $setting) {
            $setting->update(['order_no' => $order++]);
        }

        $element->delete();

        return redirect()->back()->with('notification', [
            'message' => 'Service ServiceElement Deleted Successfully!',
            'alert' => 'success',
        ]);
    }
}
