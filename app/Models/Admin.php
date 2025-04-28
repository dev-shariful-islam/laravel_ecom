<?php

namespace App\Models;

use App\Models\AuthBaseModel;
use Spatie\Permission\Traits\HasRoles;

class Admin extends AuthBaseModel
{
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'status',
        'gender',
        'role_id',

        'created_by',
        'updated_by',
        'deleted_by',

        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'status'  => 'integer',
        ];
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
