<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\CheckClock;
use Illuminate\Http\Request;

class CheckClockController extends Controller
{
    public function index()
    {
        return response()->json(CheckClock::with(['user', 'setting'])->get(), 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            // 'id' => 'required',
            // 'user_id' => 'required',
            'check_clock_type' => 'required|integer',
            'check_clock_time' => 'required',
            'deleted_at'       => 'nullable|string',
        ]);

        // generate UUID
        $data['id'] = (string) Str::uuid();

        // set otomatis
        $data['user_id'] = 1; // dummy sementara

        $clock = CheckClock::create($data);
        return response()->json($clock, 201);
    }

    public function show($id)
    {
        $clock = CheckClock::with(['user', 'setting'])->findOrFail($id);
        return response()->json($clock, 200);
    }

    public function update(Request $request, $id)
    {
        $clock = CheckClock::findOrFail($id);
        $clock->update($request->all());
        return response()->json($clock, 200);
    }

    public function destroy($id)
    {
        $clock = CheckClock::findOrFail($id);
        $clock->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
