<?php

namespace App\Http\Controllers\Backend\Admin\AdminManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleRequest;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['roles'] = Role::with('createdBy')->latest()->get();
        return view('backend.admin.admin_management.role.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.admin.admin_management.role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = admin()->id;
        $data['guard_name'] = 'admin';
        Role::create($data);
        session()->flash('success', 'Role Created Successfully');
        return redirect()->route('am.role.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return view('backend.admin.admin_management.role.details', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        return view('backend.admin.admin_management.role.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, Role $role)
    {
        $data = $request->validated();
        $data['updated_by'] = admin()->id;
        $role->update($data);
        session()->flash('success', 'Role Updated Successfully');
        return redirect()->route('am.role.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->update(['deleted_by' => admin()->id]);
        $role->delete();
        session()->flash('success', 'Role Deleted Successfully');
        return redirect()->route('am.role.index');
    }
}
