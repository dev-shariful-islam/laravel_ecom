<?php

namespace App\Http\Controllers\Backend\Admin\AdminManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminRequest;
use App\Models\Admin;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('permission:admin-list')->only('index');
        $this->middleware('permission:admin-create')->only('create', 'store');
        $this->middleware('permission:admin-edit')->only('edit', 'update');
        $this->middleware('permission:admin-delete')->only('destroy');
        $this->middleware('permission:admin-details')->only('show');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['admins'] = Admin::with('createdBy')->latest()->get();
        return view('backend.admin.admin_management.admin.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['roles'] = Role::orderBy('name')->get();
        return view('backend.admin.admin_management.admin.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminRequest $request)
    {
        $request_data = $request->validated();
        DB::transaction(function () use ($request_data, $request) {
            if($request->hasFile('image'))  {
                $image = $request->file('image');
                $image_name = time().'_'.$image->getClientOriginalName();
                $path = $image->storeAs('admin/images', $image_name, 'public');
                $request_data['image'] = $path;
            }
            $request_data['created_by'] = admin()->id;
            $admin = Admin::create($request_data);
            $role = Role::findOrFail($request->role_id);
            $admin->assignRole($role->name);
        });
        return redirect()->route('am.admin.index')->with('success', 'Admin Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        $admin->load(['createdBy', 'updatedBy']);
        return view('backend.admin.admin_management.admin.details', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        $roles = Role::orderBy('name')->get();
        return view('backend.admin.admin_management.admin.edit', compact('admin', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminRequest $request, Admin $admin)
    {

        $data = $request->validated();

        DB::transaction(function () use ($data, $request, $admin) {
            if($request->hasFile('image'))  {
                $image = $request->file('image');
                $image_name = time().'_'.$image->getClientOriginalName();
                $path = $image->storeAs('admin/images', $image_name, 'public');
                $data['image'] = $path;
                if($admin->image) {
                    Storage::disk('public')->delete($admin->image);
                }
            }
            $data['password'] = $request->password ? $request->password : $admin->password;
            $data['updated_by'] = admin()->id;
            $admin->update($data);
            $role = Role::findOrFail($request->role_id);
            $admin->syncRoles($role->name);
        });
        return redirect()->route('am.admin.index')->with('success', 'Admin Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        $admin->update(['deleted_by' => admin()->id]);
        $admin->delete();
        return redirect()->route('am.admin.index');
    }

    public function recycle_bin()
    {
        $data['admins'] = Admin::with('deletedBy')->onlyTrashed()->latest()->get();
        return view('backend.admin.admin_management.admin.trash', $data);
    }

    public function restore_data($id)
    {
        $admin = Admin::withTrashed()->findOrFail($id);
        $admin->update(['deleted_by' => null, 'updated_by' => admin()->id]);
        $admin->restore();
        return redirect()->route('am.admin.index');
    }

    public function force_delete($id)
    {
        $admin = Admin::withTrashed()->findOrFail($id);
        if($admin->image) {
            Storage::disk('public')->delete($admin->image);
        }
        $admin->forceDelete();
        return redirect()->route('am.admin.index');
    }
}
