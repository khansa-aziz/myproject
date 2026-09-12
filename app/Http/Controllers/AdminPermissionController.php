<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\AdminPermission;

class AdminPermissionController extends Controller
{
    public function index()
    {
        $admins = Admin::all();

        return view('admin.permissions.index', compact('admins'));
    }

    public function save(Request $request)
    {
        $request->validate([
            'admin_id' => 'required|exists:admins,id',
            'permissions' => 'required|array',
        ]);

        foreach ($request->permissions as $module => $permission) {
            AdminPermission::updateOrCreate(
                [
                    'admin_id' => $request->admin_id,
                    'module' => $module,
                ],
                [
                    'permission' => $permission,
                ]
            );
        }

        return redirect()
            ->route('permissions.index')
            ->with('success', 'Permissions updated successfully.');
    }

   public function getPermissions(int $adminId)
    {
        $permissions = AdminPermission::where('admin_id', $adminId)
            ->pluck('permission', 'module');

        return response()->json($permissions);
    }
}