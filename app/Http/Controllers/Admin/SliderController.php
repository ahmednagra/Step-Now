<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;

class SliderController extends Controller
{
    public function index(Request $request)
    {
        $sliders = Slider::orderBy('serial_no', 'DESC')->get();
        return view('admin.slider.index', compact('sliders'));
    }

    // Add slider Category
    public function add(){
        return view('admin.slider.add');
    }

    // Store slider Category
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'sub_title' => 'nullable|max:255',
            'image' => 'required|max:1024|mimes:jpeg,jpg,png,webp',
            'serial_no' => 'required|numeric|min:1',
            'button_title' => 'max:255|nullable',
            'button_url' => 'max:255|nullable'
        ]);

        $slider = new Slider();

        if($request->hasFile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $image = time().rand().'.'.$extension;
            $file->move('assets/admin/img/slider', $image);

            $slider->image = 'assets/admin/img/slider/' . $image;
        }

        $slider->status = $request->status;
        $slider->title = $request->title;
        $slider->sub_title = $request->sub_title;
        $slider->serial_no = $request->serial_no;
        $slider->button_title = $request->button_title;
        $slider->button_url = $request->button_url;
        $slider->save();


        $notification = array(
            'message' => 'Slider Added Successfully!',
            'alert' => 'success'
        );
        return redirect("slider")->with('notification', $notification);
    }

    // slider Category Delete
    public function destroy($id){

        $slider = Slider::find($id);
        @unlink($slider->image);
        $slider->delete();

        $notification = array(
            'message' => 'Slider Deleted Successfully!',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification', $notification);
    }

    // slider Category Edit
    public function edit($id){

        $slider = Slider::find($id);
        return view('admin.slider.edit', compact('slider'));

    }

    // Update slider Category
    public function update(Request $request, $id){

        $id = $request->id;
        $request->validate([
            'title' => 'required|max:255',
            'sub_title' => 'nullable|max:255',
            'image' => 'nullable|max:1024|mimes:jpeg,jpg,png,webp',
            'serial_no' => 'required|numeric|min:1',
            'button_title' => 'max:255|nullable',
            'button_url' => 'max:255|nullable'
        ]);

        $slider = Slider::find($id);

        if($request->hasFile('image')){

            @unlink($slider->image);

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $image = time().rand().'.'.$extension;
            $file->move('assets/admin/img/slider/', $image);

            $slider->image = 'assets/admin/img/slider/' . $image;
        }

        $slider->status = $request->status;
        $slider->title = $request->title;
        $slider->sub_title = $request->sub_title;
        $slider->serial_no = $request->serial_no;
        $slider->button_title = $request->button_title;
        $slider->button_url = $request->button_url;
        $slider->save();

        $notification = array(
            'message' => 'Slider Updated Successfully!',
            'alert' => 'success'
        );
        return redirect('slider')->with('notification', $notification);
    }

}
