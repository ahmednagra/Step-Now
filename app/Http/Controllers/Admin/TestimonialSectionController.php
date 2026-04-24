<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TestimonialDetail;
use App\Models\TestimonialSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TestimonialSectionController extends Controller
{
    public function index()
    {
        $testimonials = TestimonialSection::with(relations: 'details')->get();

        return view('admin.testimonial-section.index', compact('testimonials'));
    }

    public function add()
    {
        return view('admin.testimonial-section.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'description' => 'required|string',
            'details.*.name' => 'required|string|max:255',
            'details.*.image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'details.*.designation' => 'nullable|string|max:255',
            'details.*.feedback' => 'required|string',
            'details.*.rating' => 'required|integer|min:1|max:5',
        ]);

        $testimonial = new TestimonialSection;
        $testimonial->title = $request->title;
        $testimonial->subtitle = $request->subtitle;
        $testimonial->description = $request->description;
        $testimonial->save();

        if ($request->has('details')) {
            foreach ($request->details as $detail) {
                $testimonialDetail = new TestimonialDetail;
                $testimonialDetail->testimonial_section_id = $testimonial->id;
                $testimonialDetail->name = $detail['name'];
                $testimonialDetail->designation = $detail['designation'] ?? '';
                $testimonialDetail->feedback = $detail['feedback'];
                $testimonialDetail->rating = $detail['rating'];

                if (isset($detail['image']) && $detail['image'] instanceof \Illuminate\Http\UploadedFile) {
                    $path = $detail['image']->store('public/testimonial_details');
                    $testimonialDetail->image = basename($path);
                }

                $testimonialDetail->save();
            }
        }

        return redirect()->route('admin.testimonial-section.index')->with('notification', [
            'message' => 'Testimonial Section Added Successfully!',
            'alert' => 'success',
        ]);
    }

    public function edit($id)
    {
        $testimonial = TestimonialSection::with('details')->findOrFail($id);

        return view('admin.testimonial-section.edit', compact('testimonial'));
    }

    // public function update(Request $request, $id)
    // {

    //     $request->validate([
    //         'title' => 'required|string|max:255',
    //         'subtitle' => 'required|string|max:255',
    //         'description' => 'required|string',
    //         'details.*.name' => 'required|string|max:255',
    //         'details.*.image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
    //         'details.*.designation' => 'nullable|string|max:255',
    //         'details.*.feedback' => 'required|string',
    //         'details.*.rating' => 'required|integer|min:1|max:5',
    //     ]);

    //     $testimonial = TestimonialSection::findOrFail($id);
    //     $testimonial->title = $request->title;
    //     $testimonial->subtitle = $request->subtitle;
    //     $testimonial->description = $request->description;
    //     $testimonial->save();

    //     if ($request->has('details')) {
    //         foreach ($request->details as $detail) {

    //             if (isset($detail['id'])) {
    //                 $testimonialDetail = TestimonialDetail::find($detail['id']);
    //                 if ($testimonialDetail) {
    //                     $testimonialDetail->name = $detail['name'];
    //                     $testimonialDetail->designation = $detail['designation'] ?? '';
    //                     $testimonialDetail->feedback = $detail['feedback'];
    //                     $testimonialDetail->rating = $detail['rating'];
    //                     if (isset($detail['image']) && $detail['image'] instanceof \Illuminate\Http\UploadedFile) {
    //                         if ($testimonialDetail->image && Storage::exists('public/testimonial_details/'.$testimonialDetail->image)) {
    //                             Storage::delete('public/testimonial_details/'.$testimonialDetail->image);
    //                         }
    //                         $path = $detail['image']->store('public/testimonial_details');
    //                         $testimonialDetail->image = basename($path);
    //                     }
    //                     $testimonialDetail->save();
    //                 }
    //             } else {
    //                 $testimonialDetail = new TestimonialDetail;
    //                 $testimonialDetail->testimonial_section_id = $testimonial->id;
    //                 $testimonialDetail->name = $detail['name'];
    //                 $testimonialDetail->designation = $detail['designation'] ?? '';
    //                 $testimonialDetail->feedback = $detail['feedback'];
    //                 $testimonialDetail->rating = $detail['rating'];

    //                 if (isset($detail['image']) && $detail['image'] instanceof \Illuminate\Http\UploadedFile) {
    //                     $path = $detail['image']->store('public/testimonial_details');
    //                     $testimonialDetail->image = basename($path);
    //                 }
    //                 $testimonialDetail->save();
    //             }
    //         }
    //     }

    //     return redirect()->route('admin.testimonial-section.index')->with('notification', [
    //         'message' => 'Testimonial Section Updated Successfully!',
    //         'alert' => 'success',
    //     ]);
    // }
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'description' => 'nullable|string',
            'details' => 'nullable|array',
            'details.*.name' => 'nullable|string|max:255',
            'details.*.designation' => 'nullable|string|max:255',
            'details.*.feedback' => 'nullable|string',
            'details.*.rating' => 'nullable|integer|min:1|max:5',
        ]);

        DB::beginTransaction();
        try {
            // 1️⃣ Update main record
            $section = TestimonialSection::findOrFail($id);

            $testimonial = TestimonialSection::findOrFail($id);
            $testimonial->title = $request->title;
            $testimonial->subtitle = $request->subtitle;
            $testimonial->description = $request->description;
            $testimonial->save();

            $existingIds = $section->details()->pluck('id')->toArray();
            $incomingIds = collect($request->details ?? [])
                ->filter(fn ($d) => ! empty($d['name'])) 
                ->pluck('id')
                ->filter()
                ->toArray();

            $deletedIds = array_diff($existingIds, $incomingIds);
            if (! empty($deletedIds)) {
                TestimonialDetail::whereIn('id', $deletedIds)->delete();
            }
            foreach ($request->details as $index => $detailData) {

                if (empty($detailData['name'])) {
                    continue;
                }

                if (! empty($detailData['id']) && in_array($detailData['id'], $existingIds)) {
                    // Update
                    $detail = TestimonialDetail::find($detailData['id']);
                    if ($detail) {
                        $detail->update([
                            'name' => $detailData['name'],
                            'designation' => $detailData['designation'] ?? null,
                            'feedback' => $detailData['feedback'] ?? null,
                            'rating' => $detailData['rating'] ?? null,
                        ]);
                    }
                } else {
                    // Create new
                    $testimonialDetail = new TestimonialDetail;
                    $testimonialDetail->testimonial_section_id = $testimonial->id;
                    $testimonialDetail->name = $detailData['name'];
                    $testimonialDetail->designation = $detailData['designation'] ?? '';
                    $testimonialDetail->feedback = $detailData['feedback'];
                    $testimonialDetail->rating = $detailData['rating'];

                    if (isset($detailData['image']) && $detailData['image'] instanceof \Illuminate\Http\UploadedFile) {
                        $path = $detailData['image']->store('public/testimonial_details');
                        $testimonialDetail->image = basename($path);
                    }
                    $testimonialDetail->save();
                }
            }

            DB::commit();

            return redirect()->route('admin.testimonial-section.index')->with('notification', [
                'message' => 'Testimonial Section Updated Successfully!',
                'alert' => 'success',
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Error: '.$e->getMessage());
        }
    }

    public function delete($id)
    {
        $testimonial = TestimonialSection::with('details')->findOrFail($id);

        foreach ($testimonial->details as $detail) {
            if ($detail->image && Storage::exists('public/testimonial_details/'.$detail->image)) {
                Storage::delete('public/testimonial_details/'.$detail->image);
            }
            $detail->delete();
        }

        $testimonial->delete();

        return redirect()->route('admin.testimonial-section.index')->with('notification', [
            'message' => 'Testimonial Section Deleted Successfully!',
            'alert' => 'success',
        ]);
    }
}
