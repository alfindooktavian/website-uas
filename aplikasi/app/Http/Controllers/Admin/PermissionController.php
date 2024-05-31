<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;

class PermissionController extends Controller
{
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('can:permissions.index');
    }

    /**
     * Display a listing of the permissions.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $query = Permission::latest();

        if ($request->filled('q')) {
            $query->where('name', 'like', '%' . $request->input('q') . '%');
        }

        $permissions = $query->paginate(5);

        return view('admin.permission.index', compact('permissions'));
    }
}
