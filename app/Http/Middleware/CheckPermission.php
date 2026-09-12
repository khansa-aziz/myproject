<?php

namespace App\Http\Middleware;

use App\Models\AdminPermission;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    public function handle(
        Request $request,
        Closure $next,
        string $module,
        string $requiredPermission = 'read'
    ): Response {

        // Logged-in admin ki ID session se lo
        $adminId = session('admin_id');

        // Agar admin login nahi hai
        if (!$adminId) {
            return redirect()->route('login');
        }

        // Database se admin ki permission check karo
        $permission = AdminPermission::where('admin_id', $adminId)
            ->where('module', $module)
            ->value('permission');

        // Permission nahi hai ya none hai
        if (!$permission || $permission === 'none') {
            abort(403, 'You do not have permission to access this module.');
        }

        // Read permission
        if ($requiredPermission === 'read') {

            if (!in_array($permission, ['read', 'read_write'])) {
                abort(403);
            }
        }

        // Read & Write permission
        if ($requiredPermission === 'read_write') {

            if ($permission !== 'read_write') {
                abort(403);
            }
        }

        return $next($request);
    }
}