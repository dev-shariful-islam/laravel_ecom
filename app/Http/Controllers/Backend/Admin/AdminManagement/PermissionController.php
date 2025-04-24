<?php

namespace App\Http\Controllers\Backend\Admin\AdminManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PermissionRequest;
use App\Models\Admin;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
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
        $data['permissions'] = Permission::with('createdBy')->latest()->get();
        return view('backend.admin.admin_management.permission.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.admin.admin_management.permission.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PermissionRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = admin()->id;
        $data['guard_name'] = 'admin';
        Permission::create($data);
        session()->flash('success', 'Permission Created Successfully');
        return redirect()->route('am.permission.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
        return view('backend.admin.admin_management.permission.details', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        return view('backend.admin.admin_management.permission.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PermissionRequest $request, Permission $permission)
    {
        $data = $request->validated();
        $data['updated_by'] = admin()->id;
        $permission->update($data);
        return redirect()->route('am.permission.index')->with('success', 'Permission Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        $permission->update(['deleted_by' => admin()->id]);
        $permission->delete();
        return redirect()->route('am.permission.index')->with('success', 'Permission Deleted Successfully');
    }
}
