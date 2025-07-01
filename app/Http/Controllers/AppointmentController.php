<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Contract;
use App\Models\Service;
use App\Models\Damage;
use App\Models\DamageReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    
    public function store(Request $request)
{
    $request->validate([
        'service_id' => 'required|exists:services,id',
        'time' => 'required|date|after:now',  
        'damage_id' => 'required|exists:damages,id',
    ]);

    $provider = Service::find($request->service_id)->user;

    $appointment = new Appointment();
    $appointment->homeowner_id = Auth::id();
    $appointment->provider_id = $provider->id;
    $appointment->service_id = $request->service_id;
    $appointment->damage_id = $request->damage_id;
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

    $providerName = $appointment->provider->name ?? 'Provider';
    $homeownerName = $appointment->homeowner->name ?? 'Homeowner';
    $serviceName = $appointment->service->name ?? 'Service';

    $appointmentTime = $appointment->appointment_time 
        ? date('M d, Y h:i A', strtotime($appointment->appointment_time))
        : 'unscheduled';

    $contractDetails = "
        This Service Agreement is made between {$providerName} and {$homeownerName}.
        
        The Provider agrees to deliver the following service: {$serviceName}.
        The service is scheduled for {$appointmentTime}.

        The Provider commits to executing the service with professionalism, using reasonable care and skill.
        The Homeowner agrees to provide access to the service location and comply with agreed terms.

        This agreement is binding once the Provider accepts the appointment.
    ";

    Contract::create([
        'appointment_id' => $appointment->id,
        'provider_id' => $appointment->provider_id,
        'homeowner_id' => $appointment->homeowner_id,
        'contract_details' => trim($contractDetails),
    ]);

    return redirect()->route('provider.appointments')->with('success', 'Appointment accepted and contract created.');
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
    $appointments = Appointment::where('homeowner_id', auth()->id())->with('service')->latest()->get();

    $damageReportIds = DamageReport::where('user_id', Auth::id())->pluck('id');

    // Get damages linked to those reports
    $damages = Damage::whereIn('damage_report_id', $damageReportIds)->get();
    return view('appointments.create', compact('services', 'appointments', 'damages'));
}

public function showDamageDetails($appointmentId)
{
    // Eager load damage directly, not damageReport
    $appointment = Appointment::with('damage')->findOrFail($appointmentId);

    // Get the damage linked directly to appointment (only one)
    $damage = $appointment->damage;

    // Pass a collection for blade consistency, even if damage is one or null
    $damages = $damage ? collect([$damage]) : collect();

    return view('appointments.damage-details', compact('appointment', 'damages'));
}



public function index()
{
    // Load all appointments with related models including 'damage'
    $appointments = Appointment::with(['homeowner', 'provider', 'service', 'damage'])->get();

    // Pass the appointments to the admin appointments view
    return view('admin.appointments.index', compact('appointments'));
}


public function destroy($id)
{
    $appointment = Appointment::findOrFail($id);
    $appointment->delete();

    return redirect()->route('appointments.index')->with('success', 'Appointment deleted successfully.');
}



}