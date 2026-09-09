<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // READ - Show all admins
    public function index()
    {
        $admins = Admin::all();

        return view('admin.index', compact('admins'));
    }

    // CREATE - Show create form
    public function create()
    {
        return view('admin.create');
    }

    // CREATE - Save admin
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:admins,email'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        Admin::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        return redirect()
            ->route('admins.index')
            ->with('success', 'Admin created successfully.');
    }

    // UPDATE - Show edit form
    public function edit(Admin $admin)
    {
        return view('admin.edit', compact('admin'));
    }

    // UPDATE - Save changes
    public function update(Request $request, Admin $admin)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:admins,email,' . $admin->id],
            'password' => ['nullable', 'string', 'min:8'],
        ]);

        $admin->name = $validated['name'];
        $admin->email = $validated['email'];

        if (!empty($validated['password'])) {
            $admin->password = bcrypt($validated['password']);
        }

        $admin->save();

        return redirect()
            ->route('admins.index')
            ->with('success', 'Admin updated successfully.');
    }

    // DELETE - Delete admin
    public function destroy(Admin $admin)
    {
        $admin->delete();

        return redirect()
            ->route('admins.index')
            ->with('success', 'Admin deleted successfully.');
    }
}
