<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function editProfile()
    {
        $user = User::where('id', Auth::user()->id)->first();

        return view('admin.user.editProfile', compact('user'));
    }

    public function updateProfile(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'nullable',
            'icon' => 'nullable',
        ]);

        $user = User::find(Auth::user()->id);

        if ($request->hasFile('icon')) {

            @unlink('admin/user/profile/'.$user->icon);

            $file = $request->file('icon');
            $extension = $file->getClientOriginalExtension();
            $icon = time().rand().'.'.$extension;
            $file->move('admin/user/profile/thumb/', $icon);
            $user->icon = $icon;

            $imgManager = new ImageManager(new Driver);

            $thumb_icon = $imgManager->read('admin/user/profile/thumb/'.$icon);
            $thumb_icon->cover(200, 200);
            $thumb_icon->save(public_path('admin/user/profile/'.$icon));

            @unlink('admin/user/profile/thumb/'.$icon);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_no = $request->phone_no;
        $user->whatsapp_no = $request->whatsapp_no;
        $user->address = $request->address;

        $user->save();

        $notification = [
            'alert' => 'success',
            'message' => 'Profile Updated Successfully!',
        ];

        return redirect()->back()->with('notification', $notification);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        $user = Auth::user();

        if (Hash::check($request->old_password, $user->password)) {
            $user->password = bcrypt($request->password);
            $user->save();

            return redirect()->back()->with('notification', [
                'alert' => 'success',
                'message' => 'Password Updated Successfully!',
            ]);
        } else {
            return redirect()->back()->with('notification', [
                'alert' => 'warning',
                'message' => 'Current password does not match!',
            ]);
        }
    }
}
