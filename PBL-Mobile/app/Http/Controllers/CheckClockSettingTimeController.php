<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\CheckClockSettingTime;
use Illuminate\Http\Request;

class CheckClockSettingTimeController extends Controller
{
    public function index()
    {
        return response()->json(CheckClockSettingTime::with('clocks')->get(), 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'ck_settings_id' => 'required',
            'day' => 'required|date',
            'clock_in' => 'required',
            'clock_out' => 'required',
            'break_start' => 'required',
            'break_end' => 'required',
        ]);

        // generate UUID
        $data['id'] = (string) Str::uuid();

        $setting = CheckClockSettingTime::create($data);
        return response()->json($setting, 201);
    }

    public function show($id)
    {
        $setting = CheckClockSettingTime::with('clocks')->findOrFail($id);
        return response()->json($setting, 200);
    }

    public function update(Request $request, $id)
    {
        $setting = CheckClockSettingTime::findOrFail($id);
        $setting->update($request->all());
        return response()->json($setting, 200);
    }

    public function destroy($id)
    {
        $setting = CheckClockSettingTime::findOrFail($id);
        $setting->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
