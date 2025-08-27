<?php

namespace App\Http\Controllers;

use App\Models\ServiceEvent;
use App\Models\ServiceType;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index() {
        $services = ServiceType::with('serviceEvents')->get();

        return view('layouts.service', compact('services'));
    }

    public function loadData(Request $request) {
        $services = ServiceType::with('serviceEvents')->get();
        $serviceType = $request->query('service-type');

        $serviceTypeRecord = ServiceEvent::where('service_type_id', '=', $serviceType)->get();
        $serviceTypeName = ServiceType::where('id', '=', $serviceType)->get();
        //dd($serviceTypeName);
        return view('layouts.service', compact('serviceTypeRecord', 'services', 'serviceTypeName'));
    }
}
