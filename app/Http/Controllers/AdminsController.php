<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminsController extends Controller
{
    public function show()
    {
        $data['admins'] = User::role('User')->paginate(10);

        return view('pages.admins.admins', $data);
    }

    public function create()
    {
        return view('pages.admins.create');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'username' => ['required','max:255', 'min:2',  Rule::unique('users'),],
            'firstname' => ['max:100'],
            'lastname' => ['max:100'],
            'email' => ['required', 'email', 'max:255',  Rule::unique('users'),],
            'address' => ['max:100'],
            'city' => ['max:100'],
            'country' => ['max:100'],
            'postal' => ['max:100'],
            'about' => ['max:255'],
            'password' => ['required','min:5','max:255'],
        ]);

        $admin = User::create([
            'username' => $request->get('username'),
            'firstname' => $request->get('firstname'),
            'lastname' => $request->get('lastname'),
            'email' => $request->get('email') ,
            'address' => $request->get('address'),
            'city' => $request->get('city'),
            'country' => $request->get('country'),
            'postal' => $request->get('postal'),
            'about' => $request->get('about'),
            'password' => $request->get('password'),
            'subscription' => 'premium',
        ]);

        $admin->syncRoles('User');

        return back()->with('succes', 'New admin added successfully!');
    }

    public function edit($username)
    {
        $data['admin'] = User::whereUsername($username)->first();

        return view('pages.admins.create', $data);
    }


    public function update(Request $request)
    {
        $attributes = $request->validate([
            'firstname' => ['max:100'],
            'lastname' => ['max:100'],
            'address' => ['max:100'],
            'city' => ['max:100'],
            'country' => ['max:100'],
            'postal' => ['max:100'],
            'about' => ['max:255']
        ]);

        $userData = [
            'firstname' => $request->get('firstname'),
            'lastname' => $request->get('lastname'),
            'address' => $request->get('address'),
            'city' => $request->get('city'),
            'country' => $request->get('country'),
            'postal' => $request->get('postal'),
            'about' => $request->get('about'),
        ];

        if ($request->filled('password')) {
            $userData['password'] = bcrypt($request->get('password'));
        }

        $user = User::whereUsername($request->get('username'))->update($userData);

        return back()->with('succes', 'Admin details succesfully updated!');
    }

    public function delete($username)
    {
        $admin = User::whereUsername($username)->first();


        if (!$admin) {
            return back()->with('error', 'Admin not found!');
        }

        $admin->delete();

        return back()->with('succes', 'Admin deleted succesfully!');
    }
}
