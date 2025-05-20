<?php

// app/Models/Geofence.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Geofence extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'lat',
        'lng',
        'radius', // in meters
        'label',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}

