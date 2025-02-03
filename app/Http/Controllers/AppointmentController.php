<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    
    public function store(Request $request)
{
    $request->validate([
        'service_id' => 'required|exists:services,id',
        'time' => 'required|date',
    ]);

    $provider = Service::find($request->service_id)->user;

    $appointment = new Appointment();
    $appointment->homeowner_id = Auth::id(); 
    $appointment->provider_id = $provider->id; 
    $appointment->service_id = $request->service_id; 
    $appointment->appointment_time = $request->time; 
    $appointment->status = 'pending'; 
    $appointment->save();

    return redirect()->route('dashboard')->with('success', 'Appointment scheduled successfully!');
}

public function providerAppointments()
{
    $appointments = Appointment::where('provider_id', Auth::id())->get();
    return view('appointments.provider', compact('appointments'));
}

public function accept($id)
{
    $appointment = Appointment::findOrFail($id);
    $appointment->status = 'accepted';
    $appointment->save();

    return redirect()->route('provider.appointments')->with('success', 'Appointment accepted!');
}

public function decline($id)
{
    $appointment = Appointment::findOrFail($id);
    $appointment->status = 'declined';
    $appointment->save();

    return redirect()->route('provider.appointments')->with('success', 'Appointment declined!');
}


public function createAppointment()
{
    $services = Service::all(); 
    return view('appointments.create', compact('services'));
}

}