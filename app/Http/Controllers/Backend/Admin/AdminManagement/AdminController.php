<?php

namespace App\Http\Controllers\Backend\Admin\AdminManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminRequest;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
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
        $data['admins'] = Admin::latest()->get();
        return view('backend.admin.admin_management.admin.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.admin.admin_management.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminRequest $request)
    {
        $request_data = $request->validated();
        if($request->hasFile('image'))  {
            $image = $request->file('image');
            $image_name = time().'_'.$image->getClientOriginalName();
            $path = $image->storeAs('admin/images', $image_name, 'public');
            $request_data['image'] = $path;
        }
        $request_data['created_by'] = admin()->id;
        Admin::create($request_data);
        return redirect()->route('am.admin.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
