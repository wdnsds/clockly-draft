<?php

namespace Database\Seeders;

use App\Models\Geofence;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class GeofenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Geofence::create([
            'id'         => 1,
            'employee_id' => 1,          // must match your seeded Employee
            'lat'        => -6.9829991,        // from your JSON mock
            'lng'        => 110.4071045,
            'radius'     => 30,                // in meters
            'label'      => 'DPMPTSP',
        ]);
    }
}
