<?php

namespace App\Http\Controllers;

use App\Models\DamageDocumentation;
use App\Models\DamageImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DamageController extends Controller
{
    public function create()
    {
        return view('damages.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'type' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'notes' => 'nullable|string',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $damage = DamageDocumentation::create([
            'user_id' => auth()->id(),
            'type' => $request->type,
            'location' => $request->location,
            'notes' => $request->notes
        ]);

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

        return redirect()->route('dashboard')->with('success', 'Damage report created successfully.');
    }

    public function edit($id)
    {
        $damage = DamageDocumentation::findOrFail($id);
        return view('damages.edit', compact('damage'));
    }

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
        $validatedData['user_id'] = $damage->user_id;

        return redirect()->route('dashboard')->with('success', 'Damage report updated successfully.');
    }

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

    public function addImages($id)
    {
        $damage = DamageDocumentation::findOrFail($id);
        return view('damages.add-images', compact('damage'));
    }

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

    public function deleteImage($id)
    {
        $image = DamageImage::findOrFail($id);
        
        // Delete the image file from storage
        if (Storage::disk('public')->exists($image->image)) {
            Storage::disk('public')->delete($image->image);
        }
        
        // Delete the image record
        $image->delete();
        
        return back()->with('success', 'Image deleted successfully.');
    }
}