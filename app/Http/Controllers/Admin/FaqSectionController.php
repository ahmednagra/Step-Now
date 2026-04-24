<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\FaqDetail;
use Illuminate\Http\Request;
use App\Models\FaqSection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FaqSectionController extends Controller
{
    public function index()
    {
        $faq_section = FaqSection::with('details')->get();
        return view('admin.faq-section.index', compact('faq_section'));

    }

    public function add()
    {
        return view('admin.faq-section.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'details.*.question' => 'required|string|max:255',
            'details.*.answer' => 'required|string|max:255',
        ]);



        $faq_section = new FaqSection();
        $faq_section->title = $request->input('title');
        $faq_section->subtitle = $request->input('subtitle');
        $faq_section->description = $request->input('description');
        $faq_section->save();

        if ($request->has('details')) {
            foreach ($request->details as $detail) {
                $faq_section_detail = new FaqDetail();
                $faq_section_detail->faq_section_id = $faq_section->id;
                $faq_section_detail->question = $detail['question'] ?? '';
                $faq_section_detail->answer = $detail['answer'] ?? '';


                $faq_section_detail->save();
            }
        }


        return redirect()->route('admin.faq-section.index')->with('notification', [
            'message' => 'Faq Section Added Successfully!',
            'alert' => 'success',
        ]);
    }

    public function edit($id)
    {
        $faqSection = FaqSection::with('details')->findOrFail($id);
        return view('admin.faq-section.edit', compact('faqSection'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'description' => 'required|string',
            'details.*.question' => 'required|string|max:255',
            'details.*.answer' => 'required|string|max:255|',
        ]);

        $faq_section = FaqSection::with('details')->findOrFail($id);
        $faq_section->title = $request->input('title');
        $faq_section->subtitle = $request->input('subtitle');
        $faq_section->description = $request->input('description');
        $faq_section->save();

if ($request->has('details')) {
    foreach ($request->details as $detail) {
        $faq_section_detail = new FaqDetail();
        $faq_section_detail->faq_section_id = $faq_section->id;
        $faq_section_detail->question = $detail['question'] ?? '';

        if (isset($detail['answer']) && $detail['answer'] instanceof \Illuminate\Http\UploadedFile) {
            $path = $detail['answer']->store('faq_answers', 'public');
            $faq_section_detail->answer = $path;
        } else {
            $faq_section_detail->answer = $detail['answer'] ?? '';
        }

        $faq_section_detail->save();
    }
}

        return redirect()->route('admin.faq-section.index')->with('notification', [
            'message' => 'Faq Section Updated Successfully!',
            'alert' => 'success',
        ]);
    }

    public function delete($id)
    {
        $faq_section = FaqSection::findOrFail($id);
            FaqDetail::where('faq_section_id', $faq_section->id)->delete();

        $faq_section->delete();

        return redirect()->back()->with('notification', [
            'message' => 'Faq Section Deleted Successfully!',
            'alert' => 'success',
        ]);
    }

}
