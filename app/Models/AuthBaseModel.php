<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class AuthBaseModel extends Authenticatable
{
    use HasFactory, Notifiable;


    public const STATUS_INACTIVE = -1;
    public const STATUS_PENDING = 0;
    public const STATUS_ACTIVE = 1;

    public const GENDER_MALE = 1;
    public const GENDER_FEMALE = 2;
    public const GENDER_OTHER = 3;

    protected $appends = [
        'status_badge_label',
        'status_badge_color',
    ];


    public function getStatus()
    {
        return [
            self::STATUS_INACTIVE => 'Inactive',
            self::STATUS_PENDING => 'Pending',
            self::STATUS_ACTIVE => 'Active',
        ];
    }
    public function getStatusBg()
    {
        return [
            self::STATUS_INACTIVE => 'bg-warning',
            self::STATUS_PENDING => 'bg-info',
            self::STATUS_ACTIVE => 'bg-success',
        ];
    }

    public function getStatusBadgeLabelAttribute(): string {
        return $this->getStatus()[$this->status] ?? 'Unknown';
    }
    public function getStatusBadgeColorAttribute(): string {
        return $this->getStatusBg()[$this->status] ?? 'bg-secondary';
    }

    public function creater()
    {
        return $this->morphTo();
    }

    public function updater()
    {
        return $this->morphTo();
    }

    public function deleter()
    {
        return $this->morphTo();
    }


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


}
