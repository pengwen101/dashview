<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DashboardGroup extends Model
{
    protected $fillable = [
        'name',
    ];

    public function dashboards()
    {
        return $this->hasMany(Dashboard::class, 'group_id');
    }
}
