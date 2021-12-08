<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;

// declare model
use App\User;
use App\Organization;
use App\Roles;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('user.index', compact('users'));
    }

    public function create()
    {
        $organizations = Organization::all();
        $roles = Roles::all();
        return view('user.create', compact('organizations', 'roles'));
    }

    public function create_proses(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required',
            'password' => 'required|string|min:6',
            'avatar' => 'required',
        ]);
        $user = new User;
        if ($request->role_id === "3") {
            $user->organization_id = 0;
        }else {
            $user->organization_id = $request->org_id;
        }
        $user->role_id = $request->role_id;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->avatar = $request->file('avatar')->move('uploads/avatar');
        if ($user->save()) {
            $request->session()->flash('message', 'Data berhasil tersimpan!');
            return redirect('user');
        }
    }

    public function update($id)
    {
        $organizations = Organization::all();
        $roles = Roles::all();
        $user = User::where('id', $id)->first();
        return view('user.update', compact('organizations', 'roles', 'user'));
    }

    public function update_proses(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        if ($user !== null) {
            $user->organization_id = $request->org_id;
            $user->role_id = $request->role_id;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            if ($request->password !== null) {
                $user->password = Hash::make($request->password);
            }else {
                $user->password = $user->password;
            }
            if ($user->save()) {
                $request->session()->flash('message', 'Data berhasil terupdate!');
                return redirect('user');
            }
        }
    }

    public function destroy(Request $request, $id)
    {
        $user = User::where('id', $id)->first();
        if ($user !== null) {
            if (User::destroy($id)) {
                if ($user->avatar !== null) {
                    $avatar = public_path().'/'.$user->avatar;
                    if (file_exists($avatar)) {
                        unlink($avatar);
                    }
                }
                $request->session()->flash('message', 'Data berhasil terhapus!');
                return redirect('user');
            }
        }
    }
}
