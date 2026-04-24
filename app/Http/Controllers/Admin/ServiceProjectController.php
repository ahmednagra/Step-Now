<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Service, ServiceProject, ServiceFeature};
use Illuminate\Http\RedirectResponse;

class ServiceProjectController extends Controller
{
    public function add($id)
    {
        $service_project = ServiceProject::all();
        $services = Service::where('status', 'publish')->get();

        return view('admin.service-project.add', compact('service_project', 'services'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'thumbnail' => 'required|image|mimes:jpg,jpeg,png',
            'image_gallery.*' => 'required|image|mimes:jpg,jpeg,png',
            'isfeature' => 'required|in:featured,unfeatured',
            'show_on_home' => 'required|string|max:255',
            'service_id' => 'required|exists:services,id',
        ]);

        $service_project = new ServiceProject();
        $service_project->title = $request->title;
        $service_project->description = $request->description;
        $service_project->service_id = $request->service_id;
        $service_project->show_on_home = $request->show_on_home;
        $service_project->isfeature = $request->isfeature;

        if ($request->hasFile('thumbnail')) {
            $thumb = $request->file('thumbnail');
            $thumbName = time() . '_thumb.' . $thumb->getClientOriginalExtension();
            $thumb->move(public_path('assets/admin/uploads/service_project/thumbnail/'), $thumbName);
            $service_project->thumbnail = 'assets/admin/uploads/service_project/thumbnail/' . $thumbName;
        }

        if ($request->hasFile('image_gallery')) {
            $galleryPaths = [];
            foreach ($request->file('image_gallery') as $gallery) {
                $galleryName = time() . '_' . uniqid() . '.' . $gallery->getClientOriginalExtension();
                $gallery->move(public_path('assets/admin/uploads/service_project/gallery/'), $galleryName);
                $galleryPaths[] = 'assets/admin/uploads/service_project/gallery/' . $galleryName;
            }
            $service_project->image_gallery = json_encode($galleryPaths);
        }
        $service_project->save();

        return back()->with('notification', ['alert' => 'success', 'message' => 'Service project Added successfully']);
    }

    public function edit($id)
    {
        $service_project = ServiceProject::findOrFail($id);
        $services = Service::where('status', 'publish')->get();

        return view('admin.service-project.edit', compact('service_project', 'services'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png',
            'image_gallery.*' => 'nullable|image|mimes:jpg,jpeg,png',
            'isfeature' => 'required|in:featured,unfeatured',
            'show_on_home' => 'required|string|max:255',
            'service_id' => 'required|exists:services,id',
        ]);

        $service_project = ServiceProject::findOrFail($id);

        $service_project->title = $request->title;
        $service_project->description = $request->description;
        $service_project->service_id = $request->service_id;
        $service_project->show_on_home = $request->show_on_home;
        $service_project->isfeature = $request->isfeature;

        if ($request->hasFile('thumbnail')) {
            if ($service_project->thumbnail && file_exists(public_path($service_project->thumbnail))) {
                @unlink(public_path($service_project->thumbnail));
            }
            $thumb = $request->file('thumbnail');
            $thumbName = time() . '_thumb.' . $thumb->getClientOriginalExtension();
            $thumb->move(public_path('assets/admin/uploads/service_project/thumbnail/'), $thumbName);
            $service_project->thumbnail = 'assets/admin/uploads/service_project/thumbnail/' . $thumbName;
        }

        if ($request->hasFile('image_gallery')) {
            if ($service_project->image_gallery) {
                $oldGallery = json_decode($service_project->image_gallery, true);
                if (is_array($oldGallery)) {
                    foreach ($oldGallery as $img) {
                        if (file_exists(public_path($img))) {
                            @unlink(public_path($img));
                        }
                    }
                }
            }

            $galleryPaths = [];
            foreach ($request->file('image_gallery') as $gallery) {
                $galleryName = time() . '_' . uniqid() . '.' . $gallery->getClientOriginalExtension();
                $gallery->move(public_path(path: 'assets/admin/uploads/service_project/gallery/'), $galleryName);
                $galleryPaths[] = 'assets/admin/uploads/service_project/gallery/' . $galleryName;
            }
            $service_project->image_gallery = json_encode($galleryPaths);
        }
        $service_project->save();

        return redirect()->route('admin.service.project.add', $service_project->id)->with('notification', ['alert' => 'success', 'message' => 'Service project Updated successfully']);
    }
    public function delete($id)
    {
        $project = ServiceProject::findOrFail($id);

        if ($project->thumbnail && file_exists(public_path($project->thumbnail))) {
            @unlink(public_path($project->thumbnail));
        }

        if ($project->image_gallery) {
            $galleries = json_decode($project->image_gallery, true);
            if (is_array($galleries)) {
                foreach ($galleries as $img) {
                    if (file_exists(public_path($img))) {
                        @unlink(public_path($img));
                    }
                }
            }
        }

        $project->delete();

        return back()->with('notification', [
            'message' => 'Service Project Deleted Successfully!',
            'alert' => 'success',
        ]);
    }

}
