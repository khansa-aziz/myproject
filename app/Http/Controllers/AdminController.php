<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $roles = \App\Models\Role::where('status', 1)->get();

        return view('admin.create', compact('roles'));
    }

    // CREATE - Save admin
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:admins,email'],
            'password' => ['required', 'string', 'min:8'],
            'role_id' => ['required', 'exists:roles,id'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('admins', 'public');
        }

        Admin::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role_id' => $validated['role_id'],
            'image' => $imagePath,
        ]);

        return redirect()
            ->route('admins.index')
            ->with('success', 'Admin created successfully.');
    }

    // UPDATE - Show edit form
    public function edit(Admin $admin)
    {
        $roles = \App\Models\Role::where('status', 1)->get();

        return view('admin.edit', compact('admin', 'roles'));
    }

    // UPDATE - Save changes
    public function update(Request $request, Admin $admin)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'unique:admins,email,' . $admin->id,
            ],
            'password' => ['nullable', 'string', 'min:8'],
            'role_id' => ['required', 'exists:roles,id'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $admin->name = $validated['name'];
        $admin->email = $validated['email'];
        $admin->role_id = $validated['role_id'];

        if (!empty($validated['password'])) {
            $admin->password = bcrypt($validated['password']);
        }

        // New image upload
        if ($request->hasFile('image')) {

            // Delete old image
            if ($admin->image) {
                Storage::disk('public')->delete($admin->image);
            }

            // Store new image
            $admin->image = $request->file('image')->store('admins', 'public');
        }

        $admin->save();

        return redirect()
            ->route('admins.index')
            ->with('success', 'Admin updated successfully.');
    }

    // DELETE - Delete admin
    public function destroy(Admin $admin)
    {
        // Delete admin image from storage
        if ($admin->image) {
            Storage::disk('public')->delete($admin->image);
        }

        $admin->delete();

        return redirect()
            ->route('admins.index')
            ->with('success', 'Admin deleted successfully.');
    }

    // AJAX - Toggle status
    public function toggleStatus(Admin $admin)
    {
        $admin->status = $admin->status === 1 ? 0 : 1;
        $admin->save();

        return response()->json([
            'success' => true,
            'status' => $admin->status,
            'message' => $admin->status === 1
                ? 'Admin activated successfully.'
                : 'Admin deactivated successfully.',
        ]);
    }
}