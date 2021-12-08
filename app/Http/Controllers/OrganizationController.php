<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Organization;
use App\User;
use App\Role;
use Hash;

class OrganizationController extends Controller
{
    public function index()
    {
        $organizations = Organization::all();
        return view('organizations.index', compact('organizations'));
    }

    public function add()
    {
        return view('organizations.add');
    }

    public function submit_add(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:organizations,email',
            'phone' => 'required',
            'website' => 'required',
            'logo' => 'required',
        ]);

        $file = $request->file('logo');

        $organization = new Organization;
        $organization->name = $request->name;
        $organization->phone = $request->phone;
        $organization->email = $request->email;
        $organization->website = $request->website;
        $organization->logo = $request->file('logo')->move('uploads/logo', $file->getClientOriginalName());
        if ($organization->save()) {
            $request->session()->flash('message', 'Data berhasil tersimpan!');
            return redirect('organization');
        }
    }

    public function edit($id)
    {
        $organization = Organization::where('id', $id)->first();
        return view('organizations.edit', compact('organization'));
    }

    public function submit_edit(Request $request)
    {
        $organization = Organization::where('id', $request->id)->first();
        if ($organization !== null) {
            $organization->name = $request->name;
            $organization->phone = $request->phone;
            $organization->email = $request->email;
            $organization->website = $request->website;

            if ($request->logo != ''){
                $organization->logo = $request->file('logo')->move('uploads/logo', $request->file('logo')->getClientOriginalName());
            }
            if ($organization->save()) {
                $request->session()->flash('message', 'Data berhasil terubah!');
                return redirect('organization');
            }
        }
    }

    public function delete(Request $request, $id)
    {
        $organization = Organization::where('id', $id)->first();
        if ($organization !== null) {
            if (Organization::destroy($id)) {
                if ($organization->logo !== null) {
                    $logo = public_path().'/'.$organization->logo;
                    if (file_exists($logo)) {
                        unlink($logo);
                    }
                }
                foreach ($organization->users as $key => $user) {
                    User::destroy($user->id);
                    if ($user->avatar !== null) {
                        $avatar = public_path().'/'.$user->avatar;
                        if (file_exists($avatar)) {
                            unlink($avatar);
                        }
                    }
                }
                $request->session()->flash('message', 'Data berhasil terhapus!');
                return redirect('organization');
            }
        }
    }
}
