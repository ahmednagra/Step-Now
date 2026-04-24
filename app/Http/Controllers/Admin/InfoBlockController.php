<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\InfoBlock;
use App\Models\InfoBlockFeature;
use Illuminate\Http\Request;

class InfoBlockController extends Controller
{
    public function index()
    {
        $blocks = InfoBlock::all();

        return view('admin.info-block.index', compact('blocks'));
    }

    public function add()
    {
        return view('admin.info-block.add');
    }

    public function store(Request $request)
    {

        // dd($request->all());
        try{
            $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'description' => 'required|string',
            'image1' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'image3' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'text1' => 'nullable|string|max:255',
            'text2' => 'nullable|string|max:255',
            'text3' => 'nullable|string|max:255',
            'features' => 'nullable|array',
            'features.*.icon' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:2048',
            'features.*.title' => 'required|string|max:255',
            'features.*.description' => 'nullable|string',
            // 'show_on' => 'required|in:home,about_us'
        ]);
        }catch(\Exception $e)
        {
            dd($e->getMessage());
        }

        $blocks = new InfoBlock;
        $blocks->title = $request->input('title');
        $blocks->subtitle = $request->input('subtitle');
        $blocks->description = $request->input('description');
        $blocks->description2 = $request->input('description2');
        $blocks->text1 = $request->input('text1');
        $blocks->text2 = $request->input('text2');
        $blocks->text3 = $request->input('text3');
        $blocks->show_on = 'home';

        if ($request->hasFile('image1')) {
            $blocks->image1 = $this->uploadFile($request->file('image1'), 'info_blocks');
        }
        if ($request->hasFile('image2')) {
            $blocks->image2 = $this->uploadFile($request->file('image2'), 'info_blocks');
        }
        if ($request->hasFile('image3')) {
            $blocks->image3 = $this->uploadFile($request->file('image3'), 'info_blocks');
        }

        $blocks->save();

        if ($request->has('features')) {
            foreach ($request->features as $feature) {
                $blockFeature = new InfoBlockFeature;
                $blockFeature->info_block_id = $blocks->id;
                $blockFeature->title = $feature['title'] ?? '';
                $blockFeature->description = $feature['description'] ?? '';

                if (isset($feature['icon']) && $feature['icon'] instanceof \Illuminate\Http\UploadedFile) {
                    $blockFeature->icon = $this->uploadFile($feature['icon'], 'info_block_features');
                }

                $blockFeature->save();
            }
        }

        return redirect()->route('admin.info-block.index')->with('notification', [
            'message' => 'Info Block Added Successfully!',
            'alert' => 'success',
        ]);
    }

    public function edit($id)
    {
        $info_block = InfoBlock::with('features')->findOrFail($id);

        return view('admin.info-block.edit', compact('info_block'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'description' => 'required|string',
            'image1' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'image3' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'text1' => 'nullable|string|max:255',
            'text2' => 'nullable|string|max:255',
            'text3' => 'nullable|string|max:255',
            'features' => 'nullable|array',
            'features.*.icon' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:2048',
            'features.*.title' => 'nullable|string|max:255',
            'features.*.description' => 'nullable|string',
            'show_on' => 'required|in:home,about_us'
        ]);

        $block = InfoBlock::findOrFail($id);
        $block->title = $request->input('title');
        $block->subtitle = $request->input('subtitle');
        $block->description = $request->input('description');
        $block->text1 = $request->input('text1');
        $block->text2 = $request->input('text2');
        $block->text3 = $request->input('text3');
        $block->show_on = $request->input('show_on');

        // Update images
        if ($request->hasFile('image1')) {
            $this->deleteFileIfExists($block->image1);
            $block->image1 = $this->uploadFile($request->file('image1'), 'info_blocks');
        }
        if ($request->hasFile('image2')) {
            $this->deleteFileIfExists($block->image2);
            $block->image2 = $this->uploadFile($request->file('image2'), 'info_blocks');
        }
        if ($request->hasFile('image3')) {
            $this->deleteFileIfExists($block->image3);
            $block->image3 = $this->uploadFile($request->file('image3'), 'info_blocks');
        }

        if ($request->has('features')) {
            $block->features()->delete();
            foreach ($request->features as $feature) {
                $blockFeature = new InfoBlockFeature;
                $blockFeature->info_block_id = $block->id;
                $blockFeature->title = $feature['title'] ?? '';
                $blockFeature->description = $feature['description'] ?? '';
                if (isset($feature['icon']) && $feature['icon'] instanceof \Illuminate\Http\UploadedFile) {
                    $blockFeature->icon = $this->uploadFile($feature['icon'], 'info_block_features');
                }
                $blockFeature->save();
            }
        }
        $block->save();

        return redirect()->route('admin.info-block.index')->with('notification', [
            'message' => 'Info Block Updated Successfully!',
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

    public function delete($id)
    {
        $block = InfoBlock::findOrFail($id);

        foreach ($block->features as $feature) {
            if ($feature->icon && file_exists(public_path($feature->icon))) {
                unlink(public_path($feature->icon));
            }
            $feature->delete();
        }

        $this->deleteFileIfExists($block->image1);
        $this->deleteFileIfExists($block->image2);
        $this->deleteFileIfExists($block->image3);

        $block->delete();

        return redirect()->back()->with('notification', [
            'message' => 'Info Block Deleted Successfully!',
            'alert' => 'success',
        ]);
    }
}
