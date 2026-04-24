<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\whyChooseUsSection;
use App\Models\WhyChooseUsSectionDetail;
use Illuminate\Http\Request;

class WhyChooseUsSectionController extends Controller
{
    public function index()
    {
        $sections = whyChooseUsSection::with(relations: 'details')->get();

        return view('admin.why-choose-us-section.index', compact('sections'));
    }

    public function add()
    {
        return view('admin.why-choose-us-section.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'show_on' => 'required|in:home,about_us',
            'details.*.icon' => 'required|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'details.*.title' => 'required|string|max:255',
            'details.*.description' => 'nullable|string',
        ]);

        $section = new whyChooseUsSection;
        $section->title = $request->input('title');
        $section->subtitle = $request->input('subtitle');
        $section->description = $request->input('description');
        $section->show_on = $request->input('show_on');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $image = time().rand().'.'.$file->getClientOriginalExtension();
            $file->move('assets/admin/uploads/why_choose_us_section/', $image);
            $section->image = 'assets/admin/uploads/why_choose_us_section/'.$image;
        }

        $section->save();

        if ($request->has('features')) {
            foreach ($request->features as $index => $feature) {
                $sectionFeature = new WhyChooseUsSectionDetail;
                $sectionFeature->why_choose_us_section_id = $section->id;
                $sectionFeature->title = $feature['title'] ?? '';
                $sectionFeature->description = $feature['description'] ?? '';

                if ($request->hasFile("features.$index.icon")) {
                    $iconFile = $request->file("features.$index.icon");
                    $iconName = time().rand().'.'.$iconFile->getClientOriginalExtension();
                    $iconFile->move(public_path('assets/admin/uploads/why_choose_us_details/'), $iconName);
                    $sectionFeature->icon = 'assets/admin/uploads/why_choose_us_details/'.$iconName;
                }

                $sectionFeature->save();
            }
        }

        return redirect()->route('admin.why.choose.us.section.index')->with('notification', [
            'message' => 'Section Added Successfully!',
            'alert' => 'success',
        ]);
    }

    public function edit($id)
    {
        $section = whyChooseUsSection::with('details')->findOrFail($id);

        return view('admin.why-choose-us-section.edit', compact('section'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'show_on' => 'required|in:home,about_us',
            'features' => 'nullable|array',
            'features.*.icon' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'features.*.title' => 'required|string|max:255',
            'features.*.description' => 'nullable|string',
        ]);

        $section = whyChooseUsSection::findOrFail($id);
        $section->title = $request->input('title');
        $section->subtitle = $request->input('subtitle');
        $section->description = $request->input('description');
        $section->show_on = $request->input('show_on');

        if ($request->hasFile('image')) {
            if ($section->image && file_exists($section->image)) {
                @unlink($section->image);
            }
            $file = $request->file('image');
            $image = time().rand().'.'.$file->getClientOriginalExtension();
            $file->move('assets/admin/uploads/why_choose_us_section/', $image);
            $section->image = 'assets/admin/uploads/why_choose_us_section/'.$image;
        }

        $section->save();

        $existingIds = $section->details()->pluck('id')->toArray();
        $incomingIds = collect($request->features ?? [])
            ->filter(fn ($d) => ! empty($d['title']))
            ->pluck('id')
            ->filter()
            ->toArray();

        $deletedIds = array_diff($existingIds, $incomingIds);
        if (! empty($deletedIds)) {
            WhyChooseUsSectionDetail::whereIn('id', $deletedIds)->delete();
        }
        if ($request->has('features')) {
            foreach ($request->features as $index => $feature) {

                if (isset($feature['id']) && ! empty($feature['id'])) {
                    $sectionFeature = WhyChooseUsSectionDetail::find($feature['id']);
                    if ($sectionFeature) {
                        $sectionFeature->title = $feature['title'] ?? $sectionFeature->title;
                        $sectionFeature->description = $feature['description'] ?? $sectionFeature->description;

                        if ($request->hasFile("features.$index.icon")) {
                            if ($sectionFeature->icon && file_exists(public_path($sectionFeature->icon))) {
                                @unlink(public_path($sectionFeature->icon));
                            }
                            $iconFile = $request->file("features.$index.icon");
                            $iconName = time().rand().'.'.$iconFile->getClientOriginalExtension();
                            $iconFile->move(public_path('assets/admin/uploads/why_choose_us_details/'), $iconName);
                            $sectionFeature->icon = 'assets/admin/uploads/why_choose_us_details/'.$iconName;
                        }

                        $sectionFeature->save();
                    }
                } else {
                    $sectionFeature = new WhyChooseUsSectionDetail;
                    $sectionFeature->why_choose_us_section_id = $section->id;
                    $sectionFeature->title = $feature['title'] ?? '';
                    $sectionFeature->description = $feature['description'] ?? '';

                    if ($request->hasFile("features.$index.icon")) {
                        $iconFile = $request->file("features.$index.icon");
                        $iconName = time().rand().'.'.$iconFile->getClientOriginalExtension();
                        $iconFile->move(public_path('assets/admin/uploads/why_choose_us_details/'), $iconName);
                        $sectionFeature->icon = 'assets/admin/uploads/why_choose_us_details/'.$iconName;
                    }

                    $sectionFeature->save();
                }
            }
        }

        return redirect()->route('admin.why.choose.us.section.index')->with('notification', [
            'message' => 'Section Updated Successfully!',
            'alert' => 'success',
        ]);
    }

    public function delete($id)
    {
        $section = whyChooseUsSection::with('details')->findOrFail($id);

        foreach ($section->details as $detail) {
            if (! empty($detail->icon) && file_exists(public_path($detail->icon))) {
                @unlink(public_path($detail->icon));
            }
            $detail->delete();
        }

        // Delete section's main image
        if (! empty($section->image) && file_exists(public_path($section->image))) {
            @unlink(public_path($section->image));
        }

        $section->delete();

        return redirect()->back()->with('notification', [
            'message' => 'Section Deleted Successfully!',
            'alert' => 'success',
        ]);
    }
}
