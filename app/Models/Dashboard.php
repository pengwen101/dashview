<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model
{
    protected $fillable = [
        'name',
        'description',
        'link',
        'group_id',
        'is_active',
    ];

    public function group()
    {
        return $this->belongsTo(DashboardGroup::class, 'group_id');
    }
}
