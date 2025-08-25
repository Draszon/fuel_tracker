<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ServiceType extends Model
{
    protected $fillable = ['name', 'interval_km', 'interval_time_month', ];

    public function serviceEvents():HasMany {
        return $this->hasMany(ServiceEvent::class, 'service_type_id', 'id');
    }
}
