<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function index()
    {
        return Attendance::where('employee_id', Auth::id())->latest()->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type'       => 'required|in:checkin,checkout',
            'timestamp'  => 'required|date',
            'photo_url'  => 'nullable|string',
            'location'   => 'nullable|string',
            'mocked'     => 'boolean',
            'latitude'   => 'required',
            'longitude'  => 'required',
            'address'  => 'required|string',
        ]);

        $employeeId = Auth::id();

        $attendance = Attendance::where('employee_id', $employeeId)->latest()->first();

        if ($validated['type'] === 'checkin') {
            $record = Attendance::create([
                'type' => $validated['type'],
                'employee_id'  => $employeeId,
                'check_in'     => $validated['timestamp'],
                'photo_url' => $validated['photo_url'] ?? null,
                'location'     => $validated['location'] ?? null,
                'mocked'       => $validated['mocked'] ?? false,
                'timestamp' => now(),
                'latitude'     => $validated['latitude'],
                'longitude'    => $validated['longitude'],
                'address'      => $validated['address'],
            ]);
            return response()->json(['message' => 'Checked in', 'data' => $record]);
        }

        if ($attendance && !$attendance->check_out) {
            $attendance->update([
                'check_out'     => $validated['timestamp'],
                'working_hours' => now()->parse($attendance->check_in)->diffInMinutes($validated['timestamp']) / 60,
            ]);
            return response()->json(['message' => 'Checked out', 'data' => $attendance]);
        }

        return response()->json(['error' => 'Check-in not found'], 400);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
