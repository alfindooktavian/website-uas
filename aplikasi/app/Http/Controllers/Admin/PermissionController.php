<?php

// app/Http/Controllers/Admin/PermissionController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:permissions.index')->only('index');
    }

    public function index(Request $request)
    {
        $permissions = Permission::latest()
            ->when($request->q, function ($query) use ($request) {
                return $query->where('name', 'like', '%' . $request->q . '%');
            })
            ->paginate(5);

        return view('admin.permission.index', compact('permissions'));
    }
}
