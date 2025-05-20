<?php

// app/Models/Attendance.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'check_in',
        'check_out',
        'working_hours',
        'location',
        'mocked',
        'photo_url',
        'type',
        'timestamp',
        'latitude',
        'longitude',
        'address'
    ];

    protected $casts = [
        'check_in' => 'datetime',
        'check_out' => 'datetime',
        'mocked' => 'boolean',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}

