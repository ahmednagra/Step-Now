<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\GD\Driver;

class UserController extends Controller
{
    public function index()
    {
        $users = User::select('id', 'icon', 'name', 'email', 'phone_no', 'status')->get();
        return view("admin.user.index", compact("users"));
    }

    public function add()
    {
        return view("admin.user.add");
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'status' => 'required|in:approved,pending,blocked',
            'user_type' => 'required|in:admin,user',
            'icon' => 'nullable|mimes:jpg,jpeg,png|max:2048',
            'address' => 'nullable|string',
            'phone_no' => 'nullable|string',
            'whatsapp_no' => 'nullable|string',
        ]);

        $user = new User();

        if ($request->hasFile('icon')) {
            $file = $request->file('icon');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . rand() . '.' . $extension;
            $path = 'admin/user/profile/' . $filename;

            $file->move(public_path('admin/user/profile/'), $filename);

            $user->icon = $path; // Full path to use with asset()
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->status = $request->status;
        $user->user_type = $request->user_type;
        $user->address = $request->address;
        $user->phone_no = $request->phone_no;
        $user->whatsapp_no = $request->whatsapp_no;

        $user->save();

        return redirect()->route('admin.user.index')->with('notification', [
            'alert' => 'success',
            'message' => 'User added successfully!'
        ]);
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view("admin.user.edit", compact("user"));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'status' => 'required|in:approved,pending,blocked',
            'user_type' => 'required|in:admin,user',
            'icon' => 'nullable|mimes:jpg,jpeg,png|max:2048',
            'address' => 'nullable|string',
            'phone_no' => 'nullable|string',
            'whatsapp_no' => 'nullable|string',
            'password' => 'nullable|min:6'
        ]);

        $user = User::find($id);

        if ($request->hasFile('icon')) {
        if ($user->icon && file_exists(public_path('admin/user/profile/' . $user->icon))) {
                unlink(public_path('admin/user/profile/' . $user->icon));
            }

            $file = $request->file('icon');
            $extension = $file->getClientOriginalExtension();
            $icon = time() . rand() . '.' . $extension;
            $file->move('admin/user/profile/', $icon);
            $user->icon =  $icon;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_no = $request->phone_no;
        $user->whatsapp_no = $request->whatsapp_no;
        $user->user_type = $request->user_type;
        $user->address = $request->address;
        $user->status = $request->status;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('admin.user.index')->with('notification', [
            'alert' => 'success',
            'message' => 'User Updated Successfully!'
        ]);
    }


    public function delete($id)
    {
        $user = User::find($id);

        if ($user->id == 1) {

            $notification = [
                'alert' => 'warning',
                'message' => 'You Can not Delete Admin!'
            ];
            return redirect()->back()->with('notification', $notification);

        } elseif ($user->id == Auth::user()->id) {

            $notification = [
                'alert' => 'warning',
                'message' => 'You Can not Delete Your User!'
            ];
            return redirect()->back()->with('notification', $notification);

        } else {

            @unlink('admin/user/profile/' . $user->icon);

            $user->delete();
            $notification = [
                'alert' => 'success',
                'message' => 'User Deleted Successfully!'
            ];
            return redirect()->back()->with('notification', $notification);

        }
    }

    public function makependingUser($id)
    {
        $user = User::find($id);

        if ($user->id == 1) {

            $notification = [
                'alert' => 'warning',
                'message' => 'You Can not change Status of Admin!'
            ];
            return redirect()->back()->with('notification', $notification);

        } else {

            $user->status = 'pending';
            $user->save();
            $notification = [
                'alert' => 'success',
                'message' => 'User Maked Pending Successfully!'
            ];
            return redirect()->back()->with('notification', $notification);

        }

    }

    public function makeapprovedUser($id)
    {
        $user = User::find($id);

        if ($user->id == 1) {

            $notification = [
                'alert' => 'warning',
                'message' => 'You Can not change Status of Admin!'
            ];
            return redirect()->back()->with('notification', $notification);

        } else {

            $user->status = 'approved';
            $user->save();
            $notification = [
                'alert' => 'success',
                'message' => 'User Maked Approved Successfully!'
            ];
            return redirect()->back()->with('notification', $notification);

        }

    }

    public function makeblockedUser($id)
    {
        $user = User::find($id);

        if ($user->id == 1) {

            $notification = [
                'alert' => 'warning',
                'message' => 'You Can not change Status of Admin!'
            ];
            return redirect()->back()->with('notification', $notification);

        } else {

            $user->status = 'blocked';
            $user->save();
            $notification = [
                'alert' => 'success',
                'message' => 'User Maked Blocked Successfully!'
            ];
            return redirect()->back()->with('notification', $notification);

        }
    }

    public function pendingUsers()
    {
        $users = User::where('status', 'pending')->get();
        return view("admin.user.pendingUsers", compact("users"));
    }

    public function approvedUsers()
    {
        $users = User::where('status', 'approved')->get();
        return view("admin.user.approvedUsers", compact("users"));
    }

    public function blockedUsers()
    {
        $users = User::where('status', 'blocked')->get();
        return view("admin.user.blockedUsers", compact("users"));
    }

    public function blockedUser()
    {
        return view('admin.user.block');
    }

    public function pendingUser()
    {
        return view('admin.user.pending');
    }

    public function editProfile()
    {
        $user = User::where('id', Auth::user()->id)->first();
        return view('user.partials.editProfile', compact('user'));
    }
}
