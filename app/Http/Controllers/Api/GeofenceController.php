<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Geofence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GeofenceController extends Controller
{
    public function index()
    {
        return Geofence::where('employee_id', Auth::id())->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'lat'    => 'required|numeric',
            'lng'    => 'required|numeric',
            'radius' => 'required|numeric|min:1',
            'label'  => 'nullable|string',
        ]);

        $record = Geofence::create([
            'employee_id' => Auth::id(),
            ...$validated
        ]);

        return response()->json(['message' => 'Geofence saved', 'data' => $record]);
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
