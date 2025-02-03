<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index()
{
    $services = Service::all(); 
    return view('services.index', compact('services'));
}
    public function allServices()
{
    $services = Service::with('provider')->get();
    return view('services.index', compact('services'));
}
    public function create(){
        return view('services.create');
    }
    public function store(Request $request){
        
        if (Service::where('user_id', auth()->id())->exists()) {
            return back()->with('error', 'You can only have one service.');
        }
        $request->validate([
            'name'=> 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'type'=>'required|string',
        ]);
        
        if (!Storage::exists('public/services')) {
            Storage::makeDirectory('public/services');
        }
        $imagePath = $request->file('image')->store('services', 'public');

        $service = new Service();
        $service->name = $request->name;
        $service->type = $request->type;
        $service->image = $imagePath;
        $service->user_id = auth()->id();
        $save= $service->save();
        if (!$save) {
            return back()->with('error','cannot create service ');
        }
        return redirect()->route('dashboard')->with('success','Service created successfully!');
    }
    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('services.edit', compact('service'));
    }
    
    
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $service = Service::findOrFail($id);
        $service->name = $request->name;
        $service->type = $request->type;

    
        if ($request->hasFile('image')) {
            if ($service->image && Storage::exists($service->image)) {
                Storage::delete($service->image);
            }
    
            $imagePath = $request->file('image')->store('services', 'public');
            $service->image = $imagePath;
        }
    
        $save= $service->save();
        if (!$save) {
            return back()->with('error','Cannot update service ');
        }
        return redirect()->route('dashboard')->with('success','Service updated successfully!');
    
       
    }
    
    
    public function destroy($id)
{
    $service = Service::find($id);

    if (!$service) {
        return redirect()->route('dashboard')->with('error', 'Service not found.');
    }

    if ($service->image && Storage::disk('public')->exists($service->image)) {
        Storage::disk('public')->delete($service->image);
    }

    $service->delete();

    return redirect()->route('dashboard')->with('success', 'Service deleted successfully.');
}
}
