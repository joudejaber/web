<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contract;
use App\Models\Work;
use App\Models\WorkImage;
use App\Notifications\ContractUpdated;
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
public function showcontractnotification($id)
{
    $contract = Contract::with(['provider', 'homeowner', 'appointment.service'])->find($id);

    if (!$contract) {
        return redirect()->route('provider.appointments')->with('error', 'Contract not found.');
    }

    return view('appointments.notification-contract', compact('contract'));
}

public function showByAppointment($appointmentId)
{
    $contract = Contract::with(['provider', 'homeowner', 'appointment.service'])
        ->where('appointment_id', $appointmentId)
        ->firstOrFail();

    // Redirect if contract not found
    if (!$contract) {
        return redirect()->back()->with('error', 'Contract not found.');
    }

    // Show different views based on role
    if (auth()->user()->role_id == 2) {
        // Service Provider view (editable)
        return view('contracts.show', compact('contract'));
    } else {
        // Homeowner view (read-only)
        return view('appointments.show-contract', compact('contract'));
    }
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

    // 🔔 Notify homeowner
    $contract = Contract::findOrFail($id);
    $homeowner = $contract->homeowner;
    $homeowner->notify(new ContractUpdated($contract));

    return redirect()->back()->with('success', 'Work(s) added successfully!');
}


public function destroyWork($contractId, $workId)
{
    $work = Work::where('contract_id', $contractId)->findOrFail($workId);

    // Delete associated images
    $work->images()->each(function ($image) {
        \Storage::disk('public')->delete($image->image_path);
        $image->delete();
    });

    $work->delete();

    // 🔔 Notify homeowner after work is deleted
    $contract = Contract::findOrFail($contractId);
    $homeowner = $contract->homeowner;
    $homeowner->notify(new ContractUpdated($contract));

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

    // 🔔 Notify homeowner
    $contract = $work->contract;
    $homeowner = $contract->homeowner;
    $homeowner->notify(new ContractUpdated($contract));

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
    

    // 🔔 Notify homeowner after status change
    $homeowner = $contract->homeowner;
    $homeowner->notify(new ContractUpdated($contract));

    return back()->with('success', 'Contract status updated!');
}



}
