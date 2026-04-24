<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Group, Page};
use App\Models\Procedure;
use Illuminate\Http\Request;

class ProcedureController extends Controller
{
    public function index($slug)
    {
        $page = Page::where('slug', $slug)->first();
        $procedures = Procedure::where('page_id', $page->id)->orderBy('order_no')->get();
        return view('admin.page.partials.procedure_list', compact('slug', 'procedures'));
    }

    public function add($slug)
    {
        return view('admin.page.partials.procedure_add', compact('slug'));
    }

    public function store(Request $request, $slug)
    {
        $request->validate([
            'title' => 'required|string',
            'subtitle' => 'nullable|string',
            'description' => 'nullable|string',
            'order_no' => 'nullable|integer|min:0',
            'status' => 'required|in:active,inactive',
            'image' => 'nullable',
        ]);
        // Create new Procedure
        $page = Page::where('slug', $slug)->first();
        $procedure = new Procedure();
        $procedure->page_id = $page->id;
        $procedure->title = $request ->title;
        $procedure->subtitle = $request->subtitle;
        $procedure->description = $request-> description;
        // Handle Image Upload

         if ($request->hasFile('image')) {
            $filename = time() . '_' . uniqid() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('assets/admin/uploads/procedure/'), $filename);
            $imagePath = 'assets/admin/uploads/procedure/' . $filename;
            $procedure->image = $imagePath;
        }

        $procedure->order_no = $request->order_no ?? 0;
        $procedure->status = $request->status;
        $procedure->save();
        
        return redirect()->route('admin.procedures.index', ['slug' => $slug])->with('notification', ['alert' => 'success', 'message' => 'Procedure added Successfully!']);
    }
    public function edit($id)
    {
        $procedure = Procedure::findOrFail($id);
        $slug = $procedure->page->slug;
        return view('admin.page.partials.procedure_edit', compact('procedure', 'slug'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'subtitle' => 'nullable|string',
            'description' => 'nullable|string',
            'order_no' => 'nullable|integer|min:0',
            'status' => 'required|in:active,inactive',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $procedure = Procedure::findOrFail($id);
        $procedure->title = $request ->title;
        $procedure->subtitle = $request->subtitle;
        $procedure->description = $request-> description;
         $procedure->order_no = $request->order_no ?? 0;
        $procedure->status = $request->status;
        // Handle Image Upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($procedure->image) {
                @unlink(public_path($procedure->image));
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $image = time() . rand() . '.' . $extension;
            $file->move(public_path('assets/admin/uploads/procedure/'), $image);
            $procedure->image = 'assets/admin/uploads/procedure/' . $image;
        }
       
        $procedure->save();
        
        
        return redirect()->route('admin.procedures.index', ['slug' => $procedure->page->slug])->with('notification', ['alert' => 'success', 'message' => 'Procedure updated Successfully!']);
    }

    public function delete($id)
    {
        $procedure = Procedure::findOrFail($id);
        // Delete associated image
        if ($procedure->image) {
            @unlink(public_path($procedure->image));
        }
        $procedure->delete();
        return redirect()->back()->with('notification', ['alert' => 'success', 'message' => 'Procedure deleted Successfully!']);
    }
}