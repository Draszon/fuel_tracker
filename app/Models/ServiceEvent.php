<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceEvent extends Model
{
    protected $fillable = ['service_type_id', 'date', 'current_km', 'price'];

    public function serviceType(): BelongsTo {
        return $this->belongsTo(ServiceType::class, 'service_type_id', 'id');
    }
}
