<?php

namespace App\Models;

use Spatie\Permission\Models\Role as  SpatieRole;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends SpatieRole
{

    protected $table = 'roles';

    protected $fillable = ['name','guard_name', 'created_by', 'updated_by', 'deleted_by'];

    use SoftDeletes;
    public function createdBy()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(Admin::class, 'updated_by');
    }

    public function deletedBy()
    {
        return $this->belongsTo(Admin::class, 'deleted_by');
    }

    public function admins(){
        return $this->hasMany(Admin::class, 'role_id');
    }
}
