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
}
