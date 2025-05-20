<?php

// app/Models/Violation.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Violation extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'date',
        'type',     // e.g. "Late", "Outside Geofence", "Mock Location"
        'notes',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}

