<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    /**
     * Create a new RoleController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!auth()->user()->hasAnyPermission(['roles.index', 'roles.create', 'roles.edit', 'roles.delete'])) {
                abort(403, 'This action is unauthorized.');
            }
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::latest()->when(request()->q, function ($query) {
            $query->where('name', 'like', '%' . request()->q . '%');
        })->paginate(5);
        
        return view('admin.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::latest()->get();
        
        return view('admin.role.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:roles',
        ]);

        $role = Role::create([
            'name' => $validatedData['name'],
        ]);

        $role->syncPermissions($request->input('permissions'));

        return redirect()->route('admin.roles.index')->with('success', 'Data Berhasil Disimpan!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Role $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permissions = Permission::latest()->get();
        
        return view('admin.role.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Role $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
{
    $validatedData = $request->validate([
        'name' => 'required|unique:roles,name,' . $role->id,
    ]);

    $role->update([
        'name' => $validatedData['name'],
    ]);

    // Pastikan izin yang disinkronkan milik guard 'web'
    $permissions = $request->input('permissions', []);
    $webGuardPermissions = Permission::whereIn('id', $permissions)->where('guard_name', 'web')->get();
    $role->syncPermissions($webGuardPermissions);

    return redirect()->route('admin.roles.index')->with('success', 'Data Berhasil Diupdate!');
}


    /**
     * Remove the specified resource from storage.
     *
     * @param Role $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
{
    // Mencabut semua izin yang dimiliki oleh peran
    $role->syncPermissions([]);

    // Menghapus peran dari database
    $role->delete();

    return response()->json(['status' => 'success']);
}
}
