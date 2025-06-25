<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contract;
use App\Models\Work;
use App\Models\WorkImage;
use Illuminate\Support\Facades\Storage;


class ContractController extends Controller
{
public function show($id)
{
    $contract = Contract::with(['provider', 'homeowner', 'appointment.service'])->find($id);

    if (!$contract) {
        return redirect()->route('provider.appointments')->with('error', 'Contract not found.');
    }

    return view('contracts.show', compact('contract'));
}

public function showByAppointment($appointmentId)
{
    $contract = Contract::with(['provider', 'homeowner', 'appointment.service'])
        ->where('appointment_id', $appointmentId)
        ->first();

    if (!$contract) {
        return redirect()->route('provider.appointments')->with('error', 'Contract not found.');
    }

    return view('contracts.show', compact('contract'));
}
public function storeWork(Request $request, $id)
{
    $workData = $request->input('work');

    foreach ($workData as $index => $work) {
        $newWork = Work::create([
            'contract_id' => $id,
            'description' => $work['description'],
            'cost' => $work['cost'],
            'start_date' => $work['start_date'],
            'end_date' => $work['end_date'],
        ]);

        // Handle images for this work
        if ($request->hasFile("work.{$index}.pictures")) {
            foreach ($request->file("work.{$index}.pictures") as $image) {
                $path = $image->store('work_pictures', 'public');
                WorkImage::create([
                    'work_id' => $newWork->id,
                    'image_path' => $path
                ]);
            }
        }
    }

    return redirect()->back()->with('success', 'Work(s) added successfully!');
}

public function destroyWork($contractId, $workId)
{
    $work = Work::where('contract_id', $contractId)->findOrFail($workId);
    $work->images()->delete(); // Delete related images
    $work->delete();

    return redirect()->back()->with('success', 'Work deleted successfully.');
}

public function editWork($contractId, $workId)
{
    $contract = Contract::findOrFail($contractId);
    $work = Work::where('contract_id', $contractId)->findOrFail($workId);

    return view('contracts.edit-work', compact('contract', 'work'));
}

public function updateWork(Request $request, $contractId, $workId)
{
    $work = Work::where('contract_id', $contractId)->findOrFail($workId);

    $work->update([
        'description' => $request->description,
        'cost' => $request->cost,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
    ]);

    if ($request->hasFile('pictures')) {
        foreach ($request->file('pictures') as $image) {
            $path = $image->store('work_pictures', 'public');
            $work->images()->create(['image_path' => $path]);
        }
    }

    return redirect()->route('contract.view', $contractId)->with('success', 'Work updated successfully.');
}
public function destroyWorkImage($id)
{
    $image = WorkImage::findOrFail($id);
    Storage::disk('public')->delete($image->image_path);
    $image->delete();

    return back()->with('success', 'Image deleted successfully.');
}

public function updateStatus(Request $request, $id)
{
    $contract = Contract::findOrFail($id);
    $contract->status = $request->input('status');
    $contract->save();

    return back()->with('success', 'Contract status updated!');
}
}
