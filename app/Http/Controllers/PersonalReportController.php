<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\DamageReport;

class PersonalReportController extends Controller
{
    public function create()
    {
        return view('personal.create');
    }

    public function store(Request $request)
{
    $data = $request->validate([
        'full_name' => 'required|string',
        'phone_number' => 'required|string',
        'email' => 'required|email',
        'city' => 'required|string',
        'street' => 'required|string',
        'building_name' => 'required|string',
        'floor_number' => 'nullable|string',
    ]);

    $data['user_id'] = auth()->id();
    $data['report_date'] = now();

    $report = DamageReport::create($data);

    return redirect()->route('dashboard')->with('success', 'Personal information saved.');
}

public function edit($id)
{
    $personalInfo = DamageReport::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
    return view('personal.edit', compact('personalInfo'));
}

public function update(Request $request, $id)
{
    $personalInfo = DamageReport::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

    $data = $request->validate([
        'full_name' => 'required|string',
        'phone_number' => 'required|string',
        'email' => 'required|email',
        'city' => 'required|string',
        'street' => 'required|string',
        'building_name' => 'required|string',
        'floor_number' => 'nullable|string',
    ]);

    $personalInfo->update($data);

    return redirect()->route('dashboard')->with('success', 'Personal information updated successfully.');
}


}