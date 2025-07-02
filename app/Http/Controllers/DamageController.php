<?php

namespace App\Http\Controllers;

use App\Models\DamageReport;
use App\Models\Damage;
use App\Models\User;
use App\Models\DamageDocumentation;
use App\Models\DamageImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class DamageController extends Controller
{
    public function addDamagesForm($reportId)
    {
        $report = DamageReport::findOrFail($reportId);
        return view('damages.report_prompt', compact('report'));
    }
   public function storeDamages(Request $request, $reportId)
{
    $validatedData = $request->validate([
        'damages' => 'required|array|min:1',
        'damages.*.name' => 'required|string|max:255',
        'damages.*.description' => 'required|string',
        'damages.*.images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $report = DamageReport::findOrFail($reportId);

    foreach ($validatedData['damages'] as $damageData) {
        $imagePaths = [];

        if (isset($damageData['images']) && is_array($damageData['images'])) {
            foreach ($damageData['images'] as $image) {
                $imagePaths[] = $image->store('damages', 'public');
            }
        }

        Damage::create([
            'damage_report_id' => $report->id,
            'name' => $damageData['name'],
            'description' => $damageData['description'],
            'image_path' => json_encode($imagePaths),
        ]);
    }

    $firstDescription = $validatedData['damages'][0]['description'] ?? null;
    if ($firstDescription) {
        session()->flash('damage_description', $firstDescription);
    }

    return redirect()->route('dashboard')
        ->with('success', 'Damage details added successfully.');
}





    // Show final damage report
    public function showReport($id)
    {
        $report = DamageReport::with('damages.images')->findOrFail($id);
        return view('damages.show-report', compact('report'));
    }

    // Edit damage documentation
    public function edit($id)
    {
        $damage = DamageDocumentation::findOrFail($id);
        return view('damages.edit', compact('damage'));
    }

    // Update damage documentation
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'type' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'notes' => 'nullable|string'
        ]);

        $damage = DamageDocumentation::findOrFail($id);
        $damage->update([
            'type' => $request->type,
            'location' => $request->location,
            'notes' => $request->notes,
            'user_id' => $damage->user_id
        ]);

        return redirect()->route('dashboard')->with('success', 'Damage report updated successfully.');
    }

    // Delete damage documentation and images
    public function destroy($id)
    {
        $damage = DamageDocumentation::findOrFail($id);

        foreach ($damage->damage_image as $image) {
            Storage::disk('public')->delete($image->image);
            $image->delete();
        }

        $damage->delete();

        return redirect()->route('dashboard')->with('success', 'Damage report deleted successfully.');
    }

    public function adminDestroy($id)
{
    $damage = Damage::findOrFail($id);

    if ($damage->image_path) {
        foreach (json_decode($damage->image_path, true) as $image) {
            \Storage::disk('public')->delete($image);
        }
    }

    $damage->delete();

    return redirect()->back()->with('success', 'Damage deleted successfully.');
}

    // Show form to add more images to a damage
    public function addImages($id)
    {
        $damage = DamageDocumentation::findOrFail($id);
        return view('damages.add-images', compact('damage'));
    }

    // Store new images for a damage
    public function storeImages(Request $request, $id)
    {
        $validatedData = $request->validate([
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $damage = DamageDocumentation::findOrFail($id);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('damages', 'public');
                DamageImage::create([
                    'user_id' => auth()->id(),
                    'damage_id' => $damage->id,
                    'image' => $imagePath
                ]);
            }
        }

        return redirect()->route('dashboard')->with('success', 'Images added to damage report successfully.');
    }

    // Delete a specific image
    public function deleteImage($id)
    {
        $image = DamageImage::findOrFail($id);

        if (Storage::disk('public')->exists($image->image)) {
            Storage::disk('public')->delete($image->image);
        }

        $image->delete();

        return back()->with('success', 'Image deleted successfully.');
    }

    // Admin: view list of all damage records
    public function index()
{
    $damages = Damage::with(['report.user'])->latest()->get();
    return view('admin.damages.index', compact('damages'));
}



    public function show($id)
{
    $damage = Damage::with('images')->findOrFail($id);
    return view('damages.view', compact('damage'));
}
public function accept(Damage $damage)
{
    $damage->update(['status' => 'accepted']);
    return redirect()->back()->with('success', 'Damage accepted.');
}

public function decline(Damage $damage)
{
    $damage->update(['status' => 'declined']);
    return redirect()->back()->with('success', 'Damage declined.');
}

public function showImages(Damage $damage)
{
    $images = json_decode($damage->image_path, true) ?? [];

    return view('government.damages.images', compact('damage', 'images'));
}

public function byHomeowner($user_id)
{
    $damages = Damage::whereHas('report', function($query) use ($user_id) {
        $query->where('user_id', $user_id);
    })->with(['report.user'])->get();

    return view('damages.index', [
        'damages' => $damages,
        'homeownerName' => User::find($user_id)->name ?? 'Unknown'
    ]);
}
}
