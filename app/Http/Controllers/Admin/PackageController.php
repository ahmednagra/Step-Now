<?php

namespace App\Http\Controllers\Admin;

use App\Models\Package;
use Illuminate\Http\Request;
use App\Models\PackageDetail;
use App\Models\PackageCategory;
use App\Http\Controllers\Controller;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::with(['details' => function ($q) {
            $q->orderBy('order_no');
        }])->get();

        return view('admin.packages.index', compact('packages'));
    }

    public function add()
    {
        $package_categories = PackageCategory::where('status', 'active')->get();
        return view('admin.packages.add', compact('package_categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'destination' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'package_category_id' => 'required|exists:package_categories,id',

            'subtitle' => 'nullable|string|max:255',
            'amount' => 'required|numeric|min:0',
            'discount_percentage' => 'nullable|numeric|min:0|max:100',
            'discounted_amount' => 'nullable|numeric|min:0|lte:amount',
            'status' => 'required|in:active,inactive',
            'publish' => 'required|in:draft,published',
            'icon' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
            'details' => 'nullable|array',
            'details.*.title' => 'required_with:details|string|max:255',
            'details.*.order_no' => 'nullable|integer|min:0',
        ]);

        $data = $request->only([
            'title',
            'destination',
            'subtitle',
            'amount',
            'package_category_id',
            'discount_percentage',
            'discounted_amount',
            'status',
            'publish'
        ]);

        if ($request->hasFile('icon')) {
            $file = $request->file('icon');
            $ext =      $file->getClientOriginalExtension();
            $icon = time() . rand() . '.' . $ext;
            $file->move(public_path('assets/admin/uploads/package/'), $icon);
            $data['icon'] = $icon;
        }

        $package = Package::create($data);

        if ($request->has('details')) {
            foreach ($request->details as $detail) {
                $package->details()->create([
                    'title' => $detail['title'],
                    'status' => $detail['status'] ?? 'included',
                    'order_no' => $detail['order_no'] ?? 0,
                ]);
            }
        }

        return redirect()->route('admin.package.index')->with('success', 'Package created successfully.');
    }

    public function edit($id)
    {
        $package = Package::with(['details' => function ($query) {
            $query->orderBy('order_no');
        }])->findOrFail($id);

        $details = $package->details;
        $package_categories = PackageCategory::where('status', 'active')->get();

        return view('admin.packages.edit', compact('package', 'details', 'package_categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'package_category_id' => 'required|exists:package_categories,id',

            'subtitle' => 'nullable|string|max:255',
            'amount' => 'required|numeric|min:0',
            'discount_percentage' => 'nullable|numeric|min:0|max:100',
            'discounted_amount' => 'nullable|numeric|min:0|lte:amount',
            'status' => 'required|in:active,inactive',
            'publish' => 'required|in:draft,published',
            'icon' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
            'details' => 'nullable|array',
            'details.*.title' => 'required_with:details|string|max:255',
            'details.*.order_no' => 'nullable|integer|min:0',
        ]);

        $package = Package::findOrFail($id);

        // Collect basic package data
        $data = $request->only([
            'title',
            'destination',
            'subtitle',
            'amount',
            'discount_percentage',
            'package_category_id',
            'discounted_amount',
            'status',
            'publish'
        ]);

        // Handle icon upload
        if ($request->hasFile('icon')) {
            if ($package->icon && file_exists(public_path('assets/admin/uploads/package/' . $package->icon))) {
                unlink(public_path('assets/admin/uploads/package/' . $package->icon));
            }
            $file = $request->file('icon');
            $ext = $file->getClientOriginalExtension();
            $icon = time() . rand() . '.' . $ext;
            $file->move(public_path('assets/admin/uploads/package/'), $icon);
            $data['icon'] = $icon;
        }

        // Update package
        $package->update($data);

        // Delete and reinsert package_details (you can optimize to update instead if needed)
        $package->details()->delete();

        if ($request->has('details')) {
            foreach ($request->details as $detail) {
                $package->details()->create([
                    'title' => $detail['title'],
                    'status' => $detail['status'] ?? 'included',
                    'order_no' => $detail['order_no'] ?? 0,
                ]);
            }
        }

        return redirect()->route('admin.package.index')->with('success', 'Package updated successfully.');
    }

    public function delete($id)
    {
        $package = Package::findOrFail($id);

        // Soft delete the package and cascade soft delete the details
        $package->delete();

        return redirect()->route('admin.package.index')->with('success', 'Package deleted successfully.');
    }
}
