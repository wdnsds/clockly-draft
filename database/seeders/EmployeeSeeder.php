<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Employee::create([
            'name' => 'Alice Johnson',
            'username' => 'alice',
            'email' => 'alice@clockly.test',
            'password' => Hash::make('password'),
            'avatar_url' => null,
        ]);

        Employee::create([
            'name' => 'Bob Smith',
            'username' => 'bob',
            'email' => 'bob@clockly.test',
            'password' => Hash::make('password'),
            'avatar_url' => null,
        ]);
    }
}
