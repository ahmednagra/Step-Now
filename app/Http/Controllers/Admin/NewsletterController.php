<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function index()
    {
        $newsletters = Newsletter::all();
        return view('admin.newsletter.index', compact('newsletters'));
    }

    public function add()
    {
        return view('admin.newsletter.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:newsletters,email',
            'status' => 'required|in:0,1',

        ]);

        $newsletter = new Newsletter();
        $newsletter->email = $request->email;
        $newsletter->status = $request->status;

        $newsletter->save();

        $notification = array(
            'message' => 'Newsletter Added Successfully!',
            'alert' => 'success',
        );


        return redirect()->route('admin.newsletter.index')->with('notification', $notification);
    }

    public function edit($id)
    {
        $newsletter = Newsletter::findOrFail($id);
        return view('admin.newsletter.edit', compact('newsletter'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'email' => 'required|email|unique:newsletters,email,' . $id,
            'status' => 'required|in:0,1',

        ]);

        $newsletter = Newsletter::find($id);
        $newsletter->email = $request->email;
        $newsletter->status = $request->status;
        $newsletter->save();

        $notification = array(
            'message' => 'Newsletter Updated Successfully!',
            'alert' => 'success',
        );


        return redirect()->route('admin.newsletter.index')->with('notification', $notification);
    }

    public function delete($id)
    {
        $newsletter = Newsletter::find($id);

        $newsletter->delete();

        $notification = array(
            'message' => 'Newsletter Deleted Successfully!',
            'alert' => 'success',
        );

        return back()->with('notification', $notification);
    }
}
